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
   	$name = trim($_POST['name']);
   	$address = trim($_POST['address']);
   	$city = trim($_POST['city']);
   	$state = trim($_POST['state']);
   	$phone = trim($_POST['phone']);
   	$status = trim($_POST['status']);
   	$id = $_POST['id'];
      
    if($member->update_member($name,$address,$city,$state,$phone,$status, $id)) 
    {
        $_SESSION['msg'] = "Member updated Successfully";
        $member->redirect('displayAllMembers.php');
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
		$stmt = $DB_con->prepare("SELECT * FROM ad_members WHERE  id=:id LIMIT 1");
          $stmt->execute(array(':id'=>$id));
          $row=$stmt->fetch(PDO::FETCH_ASSOC);
	}
?>
<form action="modifyMember.php" method="post">
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
			<label>Name</label>
		</div>
		<div class="col-md-3">
			<input type="text" name="name" class="form-control" required="required" value="<?php echo $row['name']; ?>" >
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<label>Address</label>
		</div>
		<div class="col-md-3">
			<input type="text" name="address" class="form-control" required="required" value="<?php echo $row['address']; ?>">
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<label>City</label>
		</div>
		<div class="col-md-3">
			<input type="text" name="city" class="form-control" required="required" value="<?php echo $row['city']; ?>">
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<label>State</label>
		</div>
		<div class="col-md-3">
			<input type="text" name="state" class="form-control" required="required" value="<?php echo $row['state']; ?>">
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<label>Phone</label>
		</div>
		<div class="col-md-3">
			<input type="text" name="phone" class="form-control" required="required" value="<?php echo $row['phone']; ?>">
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<label>Status</label>
		</div>
		<div class="col-md-3">
			<select name="status" class="form-control" >
				<option value="Active" <?php if($row['status']=='Active'){echo 'selected';} ?> >Active</option>
				<option value="Inactive" <?php if($row['status']=='Inactive'){echo 'selected';} ?> >Inactive</option>
			</select>
		</div>
		<input type="hidden" name="id" value="<?php echo $id; ?>">
	</div><br>

	

	<div class="row">
		<div class="col-md-2">
			
		</div>
		<div class="col-md-2">
			<input type="submit" name="btnPost" class="btn btn-primary" value="Update">
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
