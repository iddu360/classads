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
<div class="col-md-8">
	
	<?php
		$ad_id = $_GET['ad_id'];
		
		$stmt = $DB_con->prepare("SELECT * FROM ad_article WHERE ad_id=:ad_id ");
		$stmt->execute(array(':ad_id'=>$ad_id ));
		print "<table class='table table-bordered table-striped'>
		<tr>
			<th class='col-md-6'>Name</th>
			<th class='col-md-2'>Price</th>
			<th class='col-md-2'>Quantity</th>
			<th></th>
			<th></th>
		</tr>";
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			
			$article_id = $row['id'];
			print '<tr>';
				print '<td>'.$row['name'].'</td>';
				print '<td>'.$row['price'].'</td>';
				print '<td>'.$row['quantity'].'</td>';
				print "<td><a href='addArticle.php?ad_id=$ad_id'>Add Article</a></td>";
				print "<td><a href='view-article.php?ad_id=$ad_id'>View Article</a></td>";
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
