<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include("Controller/SalesController.php");
	include("Model/Sales.php");
	//echo $pid;
	$slCon = new SalesController();
	
	$sales_id = $_POST['sales_id'];
	$uname = $_POST['uname'];
	$upass = $_POST['upass'];
		
	if(isset($_POST['deletesalesitem'])){
		$slCon->deleteSales($sales);
	}
?>