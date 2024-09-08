<?php
include_once 'includes/dbconfig.php';

include_once 'includes/member.php';
$member = new MEMBER($DB_con);

include_once 'includes/ad.php';
$ad = new AD($DB_con);

if(!$member->is_loggedin())
{
 $member->redirect('index.php');
}


if(isset($_POST['btnConfirm']))
{
   	$amount = trim($_POST['amount']);
  	$ad_id = $_POST['ad_id'];
  	   
    try
      {
         if($ad->ad_payment($ad_id,$amount)) 
            {
                $_SESSION['msg'] = "Ad Payment Completed Successfully";
                $member->redirect('viewAds.php');
            }
         
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  
}

?>
<?php include('includes/header.php'); ?>
<body>

  <?php include('includes/menu.php'); ?>
<br>

<form action="confirmAdPayment.php" method="post">
<div class="col-md-12">
	
	<?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']) ) { ?>
	<div class="alert alert-info">
        <i class="glyphicon glyphicon-log-in"></i> &nbsp; 
        <?php 
        
        	echo $_SESSION['msg']; ?>
    </div>
<?php } ?>

	<div class="col-md-6">
    <div class="heading">
        <h1>Confirm Payment</h1>
    </div>
    <div class="payment">
        <form>
        <div class="row">	
            <div class="col-md-6">
                <label for="owner">Owner</label>
                <input type="text" class="form-control" id="owner" required="required">
            </div>
            <div class="col-md-3">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv" required="required">
            </div>
        </div>
        
        <div class="row">    
            <div class="col-md-9" id="card-number-field">
                <label for="cardNumber">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" required="required">
            </div>
        </div><br>
        <div class="row">    
            <div class="col-md-3">
               	<label>Expiration Date</label>
            </div>
            
            <div class="col-md-3">
	            <select class="form-control" required="required">
	                <option value="01">January</option>
	                <option value="02">February </option>
	                <option value="03">March</option>
	                <option value="04">April</option>
	                <option value="05">May</option>
	                <option value="06">June</option>
	                <option value="07">July</option>
	                <option value="08">August</option>
	                <option value="09">September</option>
	                <option value="10">October</option>
	                <option value="11">November</option>
	                <option value="12">December</option>
	             </select>
            </div>
            <div class="col-md-3" required="required">
	            <select class="form-control">
	                <option value="16"> 2016</option>
	                <option value="17"> 2017</option>
	                <option value="18"> 2018</option>
	                <option value="19"> 2019</option>
	                <option value="20"> 2020</option>
	                <option value="21"> 2021</option>
	             </select>
           	</div>
            
        </div><br>

        <div class="row">
            <div class="form-group" id="credit_cards">
                <img src="assets/images/visa.jpg" id="visa">
                <img src="assets/images/mastercard.jpg" id="mastercard">
                <img src="assets/images/amex.jpg" id="amex">
            </div>
        </div><br>
        <div class="row">    
            <div class="form-group" id="pay-now">
                <button type="submit" class="btn btn-primary" id="confirm-purchase" name="btnConfirm">Confirm</button>
            </div>
        </div>
        <input type="hidden" name="ad_id" value="<?php echo $_POST['ad_id']; ?>">
        <input type="hidden" name="amount" value="<?php echo $_POST['amount']; ?>">
        </form>
    </div>
</div>

</form>



</body>
</html>
