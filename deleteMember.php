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


if(isset($_GET['id']))
{
	try
      {
        $id  = $_GET['id'];
		if($member->delete_member($id)) 
            {
                $_SESSION['msg'] = "Member deleted Successfully";
                $member->redirect('displayAllMembers.php');
            }
         
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  
}

?>
<?php include('includes/header.php'); ?>
<body>

  <?php include('includes/menu.php'); ?>
<br>


</body>
</html>
