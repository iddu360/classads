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


if(isset($_GET['id']))
{
	try
      {
        $id  = $_GET['id'];
		if($category->delete_category($id)) 
            {
                $_SESSION['msg'] = "Category deleted Successfully";
                $member->redirect('displayAllCategories.php');
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
