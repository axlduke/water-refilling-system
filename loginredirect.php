<?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  include("controller/AccountController.php");
  include("model/Account.php");
  if($_POST['login'])
  { 
	  $act = new Account();
	  $logcon = new AccountController();
	  $uname=$_POST['cusername'];
	  $upass=$_POST['cpassword'];
	  $act->setUsername($uname);
	  $act->setPassword($upass); 
	  $logcon->Login($act); // call function to login 
    }
?>