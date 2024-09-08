<?php
require_once 'includes/dbconfig.php';

include_once 'includes/member.php';
$member = new MEMBER($DB_con);

  $member->logout();
  $member->redirect('userLogin.php');


