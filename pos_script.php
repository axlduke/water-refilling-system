<?php
	if($_SESSION['access_level']!='cashier'){
    echo "<meta http-equiv='refresh'content='0;url=login.php'>";
  }
  else{
  include("Controller/ProductController.php");
  include("Controller/SalesController.php");
  include("Controller/transactionController.php");
  include("Model/Sales.php");
  include("Model/Transaction.php");
    
  $prodCon = new ProductController();
  $slCon = new SalesController();
  $strCon = new TransactionController();


  $dataprod = $prodCon->ShowProductList(); 
  $datatc = $slCon->ShowTrCount();
  $transno=$datatc['trCount']+1;
  $datatr = $slCon->ShowSalesDetailedTrans($transno); 
  $data = $slCon->ShowTransTotal($transno);
  
  // add item to transaction
  if(isset($_POST['additem'])){
	 $sl= new Sales();
	 $sl->setTransNo($_POST['trans_no']);
	 $sl->setProductId($_POST['pid']);
	 $sl->setQty($_POST['qty']);
	 $sl->setCashierId($_POST['cashier_id']);
	 $slCon->addSales($sl);
	 }
  
  // complete transaction
  if(isset($_POST['AddTransaction'])){
	 $str= new Transaction();
	 $str->setTransNo($_POST['trans_no']);
	 $str->setCSalesTotal($_POST['csales_total']);
	 $str->setSalesStatus($_POST['sales_status']);
	 $str->setCashierId($_POST['cashier_id']);
	 $str->setDateSales($_POST['date_sales']);
	 $str->setDelStatus($_POST['del_status']);
	 $remarks=$_POST['remarks'];
	 $strCon->addTransaction($str);
	 } 
	 
 } 
 ?>