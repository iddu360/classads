<?php
include_once 'includes/dbconfig.php';

include_once 'includes/member.php';
$member = new MEMBER($DB_con);

include_once 'includes/ad.php';
$ad = new CATEGORY($DB_con);

if(!$member->is_loggedin())
{
 $member->redirect('index.php');
}


if(isset($_GET['id']))
{
	try
      {
        $id  = $_GET['id'];
		if($ad->delete_ad($id)) 
            {
                $_SESSION['msg'] = "Ad deleted Successfully";
                $member->redirect('displayAllAds.php');
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
