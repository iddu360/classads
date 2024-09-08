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

<h1>Show All Ads</h1><hr>
<div class="col-md-10">
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
		
		//print "<a class='btn btn-primary' href='addCategory.php'>Add New Category</a><br><br>";
		print "<table class='table table-bordered table-striped'>
		<tr>
			<th>Member Name</th>
			<th>Member Email</th>
			<th>Description</th>
			<th>Category</th>
			<th>Register Date</th>
			<th>Expire Date</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>";
		foreach($ad->get_all_ads() as $row){
			
			$id = $row['id'];
			print '<tr>';
				print '<td>'.$row['name'].'</td>';
				print '<td>'.$row['email'].'</td>';

				print '<td>'.$row['description'].'</td>';
				print '<td>'.$row['category_name'].'</td>';
				print '<td>'.$row['register_date'].'</td>';
				print '<td>'.$row['expire_date'].'</td>';
				print "<td><a href='deleteAd.php?id=$id'>Delete</a></td>";
				print "<td><a href='modifyAd.php?id=$id'>Edit</a></td>";
			print '</tr>';
		}
		
		print "</table>";
	?>
			

</div>

</body>
</html>
