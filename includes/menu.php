<?php 
  if(isset($_GET['lang']))
    $lang = $_GET['lang'];
  else
    $lang = 'en';

  if($lang == 'en')
    include('langEN.php');
  if($lang == 'fr')
    include('langFR.php');
  
?>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
<!-- Navbar links -->
  <div align="right" class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php"><?php print $menu['home']; ?></a>
      </li>

      <?php if(!empty($_SESSION['type_of_user']) && $_SESSION['type_of_user'] == 'admin' ) { ?>
      <li class="nav-item">
        <a class="nav-link" href="displayAllMembers.php"><?php print $menu['member']; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="displayAllCategories.php"><?php print $menu['category']; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="displayAllAds.php"><?php print $menu['ad']; ?></a>
      </li> 
    <?php } ?>

      <?php if(!empty($_SESSION['type_of_user']) && $_SESSION['type_of_user'] == 'member' ) { ?>
      
      <li class="nav-item">
        <a class="nav-link" href="postAd.php"><?php print $menu['post_ad']; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="viewAds.php"><?php print $menu['view_ad']; ?></a>
      </li> 
    <?php } ?>
      
    <?php 
      if(!$member->is_loggedin())
      { ?>
       <li class="nav-item">
        <a class="nav-link" href="userLogin.php"><?php print $menu['login']; ?></a>
      </li> 
    <?php  } else { 
    ?>
      <li class="nav-item">
        <a class="nav-link" href="userLogout.php"><?php print $menu['logout']; ?></a>
      </li> 
    <?php } ?>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo basename($_SERVER['PHP_SELF']); ?>?lang=fr">French</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo basename($_SERVER['PHP_SELF']); ?>?lang=en">English</a>
    </li> 
    </ul>
    
  </div> 


</nav>