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


if(isset($_POST['btnUpload']))
{
   	$ad_id = $_POST['ad_id'];
  	   
    try
      {
        $target_dir = "images/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
		    //echo "File is an image - " . $check["mime"] . ".";
		    $uploadOk = 1;
		} else {
		    $_SESSION['msg'] = "File is not an image.";
		    $uploadOk = 0;
		}

		// Check if file already exists
		if (file_exists($target_file)) {
		    $_SESSION['msg'] = "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		
		// Check file size
		/*if ($_FILES["fileToUpload"]["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}*/
		
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    $_SESSION['msg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    $_SESSION['msg'] = "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        $_SESSION['msg'] = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
		        $_SESSION['msg'] = "Sorry, there was an error uploading your file.";
		    }
		}

        if($uploadOk == 1){
        	if($ad->post_image($ad_id,$target_file)) 
            {
                $_SESSION['msg'] = "Ad Image Added Successfully";
                $member->redirect('addImage.php');
            }
	
        }
                  
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  
}

if(isset($_GET['ad_id']))
{
	$ad_id = $_GET['ad_id'];
}
else
{
	$ad_id = $_POST['ad_id'];
}
?>
<?php include('includes/header.php'); ?>
<body>

  <?php include('includes/menu.php'); ?>
<br>

<form action="addImage.php" method="post" enctype="multipart/form-data">
<div class="row">    
    <div class="col-md-3">Select image to upload:</div>
    <div class="col-md-3"><input type="file" name="fileToUpload" id="fileToUpload" class="form-control"></div>
<input type="hidden" name="ad_id" value="<?php echo $ad_id; ?>">
    <div class="col-md-3"><input type="submit" class="btn btn-primary" value="Upload Image" name="btnUpload"></div>
</div>
</form>



</body>
</html>
