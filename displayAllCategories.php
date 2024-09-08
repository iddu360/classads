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


?>
<?php include('includes/header.php'); ?>
<body>

  <?php include('includes/menu.php'); ?>
<br>


<div class="col-md-6">
	<?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']) ) { ?>
	<div class="alert alert-info">
        <i class="glyphicon glyphicon-log-in"></i> &nbsp; 
        <?php 
        	echo $_SESSION['msg']; 
        	$_SESSION['msg'] = "";
        	?>
    </div>
<?php } ?>
	<?php
		
		print "<a class='btn btn-primary' href='addCategory.php'>Add New Category</a><br><br>";
		print "<table class='table table-bordered table-striped'>
		<tr>
			<th>Category Name</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>";
		foreach($category->get_all_categories() as $row){
			
			$id = $row['id'];
			print '<tr>';
				print '<td>'.$row['category_name'].'</td>';
				
				print "<td><a href='deleteCategory.php?id=$id'>Delete</a></td>";
				print "<td><a href='modifyCategory.php?id=$id'>Edit</a></td>";
			print '</tr>';
		}
		
		print "</table>";
	?>
			

</div>

</body>
</html>
