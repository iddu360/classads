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
   	$category_id = $_POST['category_id'];
   	$ad_status	=	trim($_POST['ad_status']);
   	$register_date = trim($_POST['register_date']);
   	$expire_date = trim($_POST['register_date']);
   	$register_date = date('Y-m-d',strtotime($register_date));
   	$expire_date = date('Y-m-d',strtotime($expire_date));

   	$id = $_POST['id'];
   	  
    if($ad->update_ad($id, $category_id, $description, $register_date, $expire_date, $ad_status)) 
    {
        $_SESSION['msg'] = "Ad updated Successfully";
        $member->redirect('displayAllAds.php');
    }
  
}

?>
<?php include('includes/header.php'); ?>
<body>

  <?php include('includes/menu.php'); ?>
<br>
<?php
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$stmt = $DB_con->prepare("SELECT * FROM ad_details WHERE  id=:id LIMIT 1");
          $stmt->execute(array(':id'=>$id));
          $row=$stmt->fetch(PDO::FETCH_ASSOC);
	}
?>
<h1>Edit Existing Ad</h1><hr>
<form action="modifyAd.php" method="post">
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
		$stmt2 = $DB_con->prepare("SELECT * FROM ad_category ");
		$stmt2->execute();
		print "<option value=''>Select</option>";
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
			if($row['category_id'] == $row2['id'])
				print "<option value='".$row2['id']."' selected >".$row2['category_name']."</option>";
			else
				print "<option value='".$row2['id']."'>".$row2['category_name']."</option>";
		}
			?>
			</select>
		</div>
	</div><br>


	<div class="row">
		<div class="col-md-2">
			<label>Description</label>
		</div>
		<div class="col-md-9">
			<input type="text" name="description" class="form-control" required="required" value="<?php echo $row['description']; ?>" >
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<label>Change Ad Status</label>
		</div>
		<div class="col-md-2">
			<select name="ad_status" class="form-control" required="required">
				<option value="Enable" <?php if($row['ad_status'] == 'Enable'){echo 'selected';} ?> >Enable</option>
				<option value="Disable" <?php if($row['ad_status'] == 'Disable'){echo 'selected';} ?> >Disable</option>
			</select>
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<label>Register Date</label>
		</div>
		<div class="col-md-2">
			<input type="text" name="register_date" id="register_date" value="<?php echo date('m/d/Y',strtotime($row['register_date'])) ?>" class="form-control" required="required">
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<label>Expire Date</label>
		</div>
		<div class="col-md-2">
			<input type="text" name="expire_date" id="expire_date" class="form-control" value="<?php echo date('m/d/Y',strtotime($row['expire_date'])) ?>" required="required">
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="button" onclick="javascript:location.href='displayAllAds.php'" class="btn btn-default" value="Cancel">
		</div>
		<div class="col-md-2">
			<input type="submit" name="btnPost" class="btn btn-primary" value="Update Ad">
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
