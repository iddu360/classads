<?php
require_once 'includes/dbconfig.php';

include_once 'includes/member.php';
$member = new MEMBER($DB_con);

if($member->is_loggedin()!="")
{
 $member->redirect('home.php');
}

if(isset($_POST['btn-userLogin']))
{
 $email = $_POST['email'];
 $password = $_POST['password'];
  
 if($member->login($email,$password))
 {
  $member->redirect('home.php');
 }
 else
 {
  $error = "Wrong Details !";
 } 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login : cleartuts</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="includes/style.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post">
            <h2>Log in.</h2><hr />
            <?php
            if(isset($error))
            {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                  </div>
                  <?php
            }
            ?>
            <div class="form-group">
             <input type="text" class="form-control" name="email" placeholder="E mail ID" required />
            </div>
            <div class="form-group">
             <input type="password" class="form-control" name="password" placeholder="Your Password" required />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" name="btn-login" class="btn btn-block btn-primary">
                 <i class="glyphicon glyphicon-log-in"></i>&nbsp;Log in
                </button>
            </div>
            <br />
            <label>Don't have account yet ! <a href="userRegistration.php">Register</a></label>
        </form>
       </div>
</div>

</body>
</html>
