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
	<?php
		
		print "<table class='table table-bordered table-striped'>
		<tr>
			<th>Name</th>
			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>";
		foreach($member->get_all_members() as $row){
			
			$id = $row['id'];
			print '<tr>';
				print '<td>'.$row['name'].'</td>';
				print '<td>'.$row['address'].'</td>';
				print '<td>'.$row['city'].'</td>';
				print '<td>'.$row['state'].'</td>';
				print '<td>'.$row['phone'].'</td>';
				print '<td>'.$row['email'].'</td>';
				print "<td><a href='deleteMember.php?id=$id'>Delete</a></td>";
				print "<td><a href='modifyMember.php?id=$id'>Edit</a></td>";
			print '</tr>';
		}
		
		print "</table>";
	?>
			

</div>

</body>
</html>
