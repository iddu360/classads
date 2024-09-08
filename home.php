<?php
include_once 'includes/dbconfig.php';
include_once 'includes/member.php';
$member = new MEMBER($DB_con);

if(!$member->is_loggedin())
{
 $member->redirect('index.php');
}
$member_id = $_SESSION['member_id'];
$stmt = $DB_con->prepare("SELECT * FROM ad_members WHERE id=:member_id");
$stmt->execute(array(":member_id"=>$member_id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php include('includes/header.php'); ?>
</head>

<body>

  <?php include('includes/menu.php'); ?>


<div class="content">
welcome : <?php print($row['name']); ?>
</div>
</body>
</html>
