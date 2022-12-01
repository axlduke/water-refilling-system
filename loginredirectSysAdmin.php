<?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  include("controller/AccountController.php");
  include("model/Account.php");
  if($_POST['login'])
  { 
	  $actSysAdmin = new Account();
	  $logcon = new AccountController();
	  $uname=$_POST['cusername'];
	  $upass=$_POST['cpassword'];
	  $actSysAdmin->setUsername($uname);
	  $actSysAdmin->setPassword($upass); 
	  $logcon->LoginSysAdmin($actSysAdmin); // call function to login 
    }
?>