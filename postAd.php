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


if(isset($_POST['btnPost']))
{
   $description = trim($_POST['description']);
   $register_date = trim($_POST['register_date']);
   $expire_date = trim($_POST['expire_date']);
   $category_id = trim($_POST['category_id']);
   
      try
      {
         if($ad->post_ad($category_id,$description,$register_date,$expire_date)) 
            {
                $_SESSION['msg'] = "Ad Posted Successfully";
                $member->redirect('postAd.php');
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

<form action="postAd.php" method="post">
<div class="col-md-12">
	
	<?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']) ) { ?>
	<div class="alert alert-info">
        <i class="glyphicon glyphicon-log-in"></i> &nbsp; 
        <?php 
        	echo $_SESSION['msg']; 
        	$_SESSION['msg'] = "";
        	?>
    </div>
<?php } ?>

	<div class="row">
		<div class="col-md-2">
			<label>Select Category</label>
		</div>
		<div class="col-md-2">
			<select name="category_id" class="form-control" required="required">
			<?php
		$stmt = $DB_con->prepare("SELECT * FROM ad_category ");
		$stmt->execute();
		print "<option value=''>Select</option>";
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			print "<option value='".$row['id']."'>".$row['category_name']."</option>";
		}
			?>
			</select>
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<label>Enter Description</label>
		</div>
		<div class="col-md-9">
			<input type="text" name="description" class="form-control" required="required">
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<label>Register Date</label>
		</div>
		<div class="col-md-2">
			<input type="text" name="register_date" id="register_date" class="form-control" required="required">
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<label>Expire Date</label>
		</div>
		<div class="col-md-2">
			<input type="text" name="expire_date" id="expire_date" class="form-control" required="required">
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			
		</div>
		<div class="col-md-2">
			<input type="submit" name="btnPost" class="btn btn-primary" value="Post Ad">
		</div>
	</div>

</div>

</form>


<script type="text/javascript">
	$('#register_date').datepicker({
		orientation : 'top'
	});
	$('#expire_date').datepicker({
		orientation : 'top'
	});
</script>
</body>
</html>
