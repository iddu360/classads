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
        <h1>Amount</h1>
    </div>
    <div class="payment">
        <form action="confirmAdPayment.php" method="post">
        <div class="row">	
            
            <div class="col-md-3">
                <label for="cvv">Amount</label>
                <input type="text" class="form-control" name="amount" required="required">
            </div>
        </div><br>
        
        
        <div class="row">    
            <div class="form-group" id="pay-now">
                <button type="submit" class="btn btn-primary" id="confirm-purchase" name="btnPayment">Confirm Payment</button>
            </div>
        </div>
        <input type="hidden" name="ad_id" value="<?php echo $_GET['ad_id']; ?>">
        </form>
    </div>
</div>

</form>



</body>
</html>
