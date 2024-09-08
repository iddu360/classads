<?php
require_once 'includes/dbconfig.php';

include_once 'includes/member.php';
$member = new MEMBER($DB_con);

if($member->is_loggedin()!="")
{
    $member->redirect('home.php');
}

if(isset($_POST['btn-signup']))
{
   $name = trim($_POST['name']);
   $address = trim($_POST['address']);
   $city = trim($_POST['city']);
   $state = trim($_POST['state']);
   $phone = trim($_POST['phone']);
   $email = trim($_POST['email']);
   $password = trim($_POST['password']); 
   $cpassword = trim($_POST['cpassword']); 
   
 
   if($name=="") {
      $error[] = "provide Name !"; 
   }
   else if($email=="") {
      $error[] = "provide email id !"; 
   }
   else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Please enter a valid email address !';
   }
   else if($password=="") {
      $error[] = "provide password !";
   }
   else if(strlen($password) < 6){
      $error[] = "Password must be atleast 6 characters"; 
   }
   else if( $password != $cpassword ){
      $error[] = "Confirm Password does not match"; 
   }

   else
   {
      try
      {
         $stmt = $DB_con->prepare("SELECT email FROM ad_members WHERE email=:email ");
         $stmt->execute(array(':email'=>$email));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['email']==$email) {
            $error[] = "sorry username already taken !";
         }
         
         else
         {
            if($member->register($name,$address,$city,$state,$phone, $email, $password)) 
            {
                $member->redirect('userRegistration.php?joined');
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  } 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />

<link rel="stylesheet" href="includes/style.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post">
            <h2>Register</h2><hr />
            <?php
            if(isset($error))
            {
               foreach($error as $error)
               {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
               }
            }
            else if(isset($_GET['joined']))
            {
                 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='userLogin.php'>login</a> here
                 </div>
                 <?php
            }
            ?>
            <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?php if(isset($error)){echo $name;}?>" required />
            </div>

            <div class="form-group">
            <input type="text" class="form-control" name="address" placeholder="Enter Address" value="<?php if(isset($error)){echo $address;}?>" />
            </div>

            <div class="form-group">
            <input type="text" class="form-control" name="city" placeholder="Enter City" value="<?php if(isset($error)){echo $city;}?>" />
            </div>

            <div class="form-group">
            <input type="text" class="form-control" name="state" placeholder="Enter State" value="<?php if(isset($error)){echo $state;}?>" />
            </div>

            <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="Enter Phone" value="<?php if(isset($error)){echo $phone;}?>" />
            </div>

            <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="Enter Email" value="<?php if(isset($error)){echo $email;}?>" />
            </div>

            <div class="form-group">
             <input type="password" class="form-control" name="password" placeholder="Enter Password" />
            </div>

            <div class="form-group">
             <input type="password" class="form-control" name="cpassword" placeholder="Enter Confirm Password" />
            </div>

  

            

            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">
                 <i class="glyphicon glyphicon-open-file"></i>&nbsp;Register
                </button>
            </div>
            <br />
            <label>have an account ! <a href="userLogin.php">Log In</a></label>
        </form>
       </div>
</div>

</body>
</html>
