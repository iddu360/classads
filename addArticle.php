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


if(isset($_POST['btnArticle']))
{
   	$name = trim($_POST['name']);
  	$price = $_POST['price'];
  	$quantity = $_POST['quantity'];
  	$ad_id = $_POST['ad_id'];
  	   
    try
      {
         if($ad->post_article($ad_id,$name,$price,$quantity)) 
            {
                $_SESSION['msg'] = "Article Added Successfully";
                $member->redirect('addArticle.php');
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

<form action="addArticle.php" method="post">
<div class="col-md-12">
	
	<?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']) ) { ?>
	<div class="alert alert-info">
        <i class="glyphicon glyphicon-log-in"></i> &nbsp; 
        <?php 
        
        	echo $_SESSION['msg']; ?>
    </div>
<?php } ?>

	<div class="row">
		<div class="col-md-2">
			<label>Name</label>
		</div>
		<div class="col-md-9">
			<input type="text" name="name" class="form-control" required="required">
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<label>Price</label>
		</div>
		<div class="col-md-2">
			<input type="text" name="price" class="form-control" required="required">
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<label>Quantity</label>
		</div>
		<div class="col-md-2">
			<input type="text" name="quantity" class="form-control" required="required">
		</div>
		<input type="hidden" name="ad_id" value="<?php echo $_GET['ad_id'] ?>">
	</div><br>

	<div class="row">
		<div class="col-md-2">
			
		</div>
		<div class="col-md-2">
			<input type="submit" name="btnArticle" class="btn btn-primary" value="Add Article">
		</div>
	</div>

</div>

</form>



</body>
</html>
