<?php
include_once 'includes/dbconfig.php';

include_once 'includes/member.php';
$member = new MEMBER($DB_con);

include_once 'includes/category.php';
$category = new CATEGORY($DB_con);

if(!$member->is_loggedin())
{
 $member->redirect('index.php');
}


if(isset($_POST['btnPost']))
{
   	$category_name = trim($_POST['category_name']);
   	$id = $_POST['id'];
   	  
    if($category->update_category($id, $category_name)) 
    {
        $_SESSION['msg'] = "Category updated Successfully";
        $member->redirect('displayAllCategories.php');
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
		$stmt = $DB_con->prepare("SELECT * FROM ad_category WHERE  id=:id LIMIT 1");
          $stmt->execute(array(':id'=>$id));
          $row=$stmt->fetch(PDO::FETCH_ASSOC);
	}
?>
<form action="modifyCategory.php" method="post">
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
			<label>Category Name</label>
		</div>
		<div class="col-md-3">
			<input type="text" name="category_name" class="form-control" required="required" value="<?php echo $row['category_name']; ?>" >
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
		</div>
		<div class="col-md-2">
			<input type="submit" name="btnPost" class="btn btn-primary" value="Update Category">
		</div>
	</div>

</div>

</form>

</body>
</html>
