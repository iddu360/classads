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

<form action="postAd.php" method="post">
<div class="col-md-12">
	
	<?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']) ) { ?>
	<div class="alert alert-info">
        <i class="glyphicon glyphicon-log-in"></i> &nbsp; 
        <?php 
        
        	echo $_SESSION['msg']; ?>
    </div>
<?php } ?>

	<?php
		$member_id = $_SESSION['member_id'];
		
		$stmt = $DB_con->prepare("SELECT d.id, c.category_name, d.description, d.register_date, d.expire_date, d.ad_type, d.ad_status FROM ad_details d, ad_category c WHERE d.category_id = c.id  and d.member_id=:member_id ");
		$stmt->execute(array(':member_id'=>$member_id ));
		print "<table class='table table-bordered table-striped'>
		<tr>
			<th>Description</th>
			<th>Category Name</th>
			<th>Register Date</th>
			<th>Expire Date</th>
			<th>Ad Status</th>
			<th>Ad Type</th>
			<th>Add Article</th>
			<th>View Article</th>
			<th>Add Image</th>
			<th>Payment</th>
		</tr>";
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			
			$ad_id = $row['id'];
			print '<tr>';
				print '<td>'.$row['description'].'</td>';
				print '<td>'.$row['category_name'].'</td>';
				print '<td>'.$row['register_date'].'</td>';
				print '<td>'.$row['expire_date'].'</td>';
				print '<td>'.$row['ad_status'].'</td>';
				print '<td>'.$row['ad_type'].'</td>';
				print "<td><a href='addArticle.php?ad_id=$ad_id'>Add Article</a></td>";
				print "<td><a href='viewArticles.php?ad_id=$ad_id'>View Article</a></td>";
				if($row['ad_status'] == 'Paid')
					print "<td><a href='addImage.php?ad_id=$ad_id'>Add Image</a></td>";
				else
					print '<td></td>';
				
				print "<td><a href='adPayment.php?ad_id=$ad_id'>Pay</a></td>";
			print '</tr>';
		}
		
		print "</table>";
	?>
			

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
