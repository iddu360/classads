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
   	  
    if($category->add_cateogry($category_name)) 
    {
        $_SESSION['msg'] = "Category added Successfully";
        $member->redirect('displayAllCategories.php');
    }
  
}

?>
<?php include('includes/header.php'); ?>
<body>

  <?php include('includes/menu.php'); ?>
<br>

<form action="addCategory.php" method="post">
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
			<input type="text" name="category_name" class="form-control" required="required" >
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-2">
			
		</div>
		<div class="col-md-2">
			<input type="submit" name="btnPost" class="btn btn-primary" value="Add Category">
		</div>
	</div>

</div>

</form>

</body>
</html>
