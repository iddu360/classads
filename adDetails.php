<?php
include_once 'includes/dbconfig.php';

include_once 'includes/member.php';
$member = new MEMBER($DB_con);

include_once 'includes/ad.php';
$ad = new AD($DB_con);

if(!$member->is_loggedin())
{
 //$member->redirect('index.php');
}


?>
<?php include('includes/header.php'); ?>
<body>

  <?php include('includes/menu.php'); ?>
<br>
<?php
    $ads = $ad->find_ad_by_id($_GET['ad_id']);
?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8" align="center"><h2>AD DETAILS</h2></div>
</div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">	
        <table class="table table-bordered">
        
         <tr>
             <td>Category</td>
             <td><?php echo $ads['category_name']; ?></td>
         </tr>

         <tr>
             <td>Description</td>
             <td><?php echo $ads['description']; ?></td>
         </tr>
         
         <tr>
             <td>Posted By</td>
             <td><?php echo $ads['name']; ?></td>
         </tr>

         <tr>
             <td>Poster Email</td>
             <td><?php echo $ads['email']; ?></td>
         </tr>

         <tr>
             <td>Register Date</td>
             <td><?php echo $ads['register_date']; ?></td>
         </tr>

         <tr>
             <td>Expire Date</td>
             <td><?php echo $ads['expire_date']; ?></td>
         </tr>

        </table>		
    </div>
</div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    	<?php $image = $ad->find_ad_image($_GET['ad_id']); 
        if(!empty($image['image']))
            print '<img  src="'.$image['image'].'" height="250" width="100%">';
        ?>
    </div>
</div><br>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <?php 
        $images = $ad->find_all_ad_images($_GET['ad_id']); 
        print "<div class='row'>";
        foreach($images as $row)
        {    
            print '<div class="col-md-2"><img class="img-fluid mx-auto d-block" src="'.$image['image'].'" alt="slide 1"></div>';
        }
        print '</div>';
    ?>
    </div>
</div>

</body>
</html>
