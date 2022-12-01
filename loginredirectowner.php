<?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  include("controller/AccountController.php");
  include("model/Account.php");
  if($_POST['login'])
  { 
	  $actOwner = new Account();
	  $logcon = new AccountController();
	  $uname=$_POST['cusername'];
	  $upass=$_POST['cpassword'];
	  $actOwner->setUsername($uname);
	  $actOwner->setPassword($upass); 
	  $logcon->LoginOwner($actOwner); // call function to login 
    }
?>