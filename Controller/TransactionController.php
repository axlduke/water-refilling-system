<?php
//this is the Transaction controller
error_reporting(E_ALL & ~E_NOTICE);

class TransactionController 
{
    var $con;
    function __construct() //use to initialize variables
    {
		include 'connection.php';
    }
	function addTransaction($str)
		{
			$sStat= $str->getSalesStatus();
			if($sStat=="Cancel"){
				$css="cancelled";
				$datePayment=$str->getDateSales();
			}
			else{
				$css="Cash";
				$datePayment=$str->getDateSales();
			}
			
			$remarks=$_POST['remarks'];
			$sql = "INSERT INTO transactions
					(trans_no, csales_total, sales_status, cashier_id, date_sales, remarks, del_status)
				VALUES('".$str->getTransNo()."','".$str->getCSalesTotal()."','".$str->getSalesStatus()."','".$str->getCashierId()."','".$str->getDateSales()."','".$remarks."','".$str->getDelStatus()."')";
				$this->con->query($sql);
				
				echo "<script>alert('Transaction Complete!')</script>";
				echo "<meta http-equiv='refresh'content='0;url=POS.php'>";
			
		}
	function addPayment($str)
		{
			
			$css="payment";
			$remarks=$_POST['remarks'];
			$payment_status=$_POST['payment_status'];
			$si=$_POST['si'];
			$sql = "INSERT into transactions(trans_no, csales_total, sales_status, customer_id, cashier_id, date_sales, date_payment, remarks, sales_invoice, payment_status)
				VALUES('".$str->getTransNo()."','".$str->getCSalesTotal()."','".$css."','".$str->getCustomerId()."','".$str->getCashierId()."','".$str->getDateSales()."','".$str->getDateSales()."', '".$remarks."','".$si."','".$payment_status."')";
				$this->con->query($sql);
			if($si>0){
				$sqlupdate = "UPDATE transactions set remarks='".$remarks."'
				where sales_invoice='".$si."' ";
				$this->con->query($sqlupdate);	
			}
				
				echo "<script>alert('payment Complete!')</script>";
				echo "<meta http-equiv='refresh'content='0;url=POS.php'>";
		}
		// transaction report daily
		function ShowSalesTotalTrans()
		{
				$sql = "SELECT `transactions`.`csales_id`,
						`transactions`.`trans_no`,
						`transactions`.`csales_total`,
						DATE(`transactions`.`date_sales`) AS s_date,
						`transactions`.`cashier_id` AS cashier_info,
						`transactions`.`sales_status`
						FROM `transactions`
						WHERE DATE(`transactions`.`date_sales`) = CURDATE() AND YEAR((`transactions`.`date_sales`))=YEAR((CURDATE()))
						GROUP BY `transactions`.`trans_no`,`transactions`.`trans_no`
						ORDER BY `transactions`.`date_sales` DESC, `transactions`.`csales_id` DESC";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['trans_no'][$ctr] = $row['trans_no'];
					$data['transaction_sales'][$ctr] = $row['csales_total'];
					$data['s_date'][$ctr] = $row['s_date'];
					$data['cashier_info'][$ctr] = $row['cashier_info'];
					$data['status'][$ctr] = $row['sales_status'];
					$ctr++;	
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		
		// show sales per receipt or transaction
		function ShowSalesTotalTransMonthly()
		{
				$sql = "SELECT `transactions`.`trans_no`,
						SUM(`transactions`.`csales_total`) AS transaction_sales,
						MONTH(`transactions`.`date_sales`) AS s_month,
						`transactions`.`cashier_id` AS cashier_info,
						YEAR(`transactions`.`date_sales`) AS s_year
						FROM `transactions`
						GROUP BY MONTH(`transactions`.`date_sales`)
						ORDER BY s_month ASC";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['trans_no'][$ctr] = $row['trans_no'];
					$data['transaction_sales'][$ctr] = $row['transaction_sales'];
					$data['s_month'][$ctr] = $row['s_month'];
					$data['s_year'][$ctr] = $row['s_year'];
					$data['cashier_info'][$ctr] = $row['cashier_info'];
					$ctr++;
					$data['count'] = $ctr;
				}
				return $data;
			}
			
			//$this->con->close();
		}
		// delivery sales
		function ShowSalesTotalDelivery($monthT)
		{
				$sql = "SELECT 
						SUM(`transactions`.`csales_total`) AS delivery_sales,
						MONTH(`transactions`.`date_sales`) AS s_month,
						`transactions`.`cashier_id` AS cashier_info,
						YEAR(`transactions`.`date_sales`) AS s_year
						FROM `transactions`
						WHERE `transactions`.`del_status`='delivery' AND MONTH(`transactions`.`date_sales`)=$monthT
						GROUP BY MONTH(`transactions`.`date_sales`), `transactions`.`del_status`='delivery'
						ORDER BY s_month DESC";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data1 = array();
				$ctr1 = 0;
				
				while($row = $result->fetch_assoc())
				{
					
					$data1['delivery_sales'][$ctr1] = $row['delivery_sales'];
					$data1['s_month'][$ctr1] = $row['s_month'];
					$data1['s_year'][$ctr1] = $row['s_year'];
					$data1['cashier_info'][$ctr1] = $row['cashier_info'];
					$ctr1++;
					$data1['count'] = $ctr1;
				}
				return $data1;
			}
			
			//$this->con->close();
		}
		
		// pick-up sales
		function ShowSalesTotalPickup()
		{
				$sql = "SELECT YEAR(`transactions`.`date_sales`) AS s_year,
							MONTH(`transactions`.`date_sales`) AS s_month,
							(SELECT SUM(`transactions`.`csales_total`)
							FROM `transactions`
							WHERE `transactions`.`del_status`='pickup' AND MONTH(`date_sales`)=s_month) AS pickup_sales,
							(SELECT SUM(`transactions`.`csales_total`)
							FROM `transactions`
							WHERE `transactions`.`del_status`='delivery'
							AND MONTH(`date_sales`)=s_month) AS delivery_sales,
							`transactions`.`cashier_id` AS cashier_info
						FROM `transactions`
						GROUP BY MONTH(`date_sales`)
						ORDER BY s_month DESC";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					
					$data['pickup_sales'][$ctr] = $row['pickup_sales'];
					$data['delivery_sales'][$ctr] = $row['delivery_sales'];
					$data['s_month'][$ctr] = $row['s_month'];
					$data['s_year'][$ctr] = $row['s_year'];
					$data['cashier_info'][$ctr] = $row['cashier_info'];
					$ctr++;
					$data['count'] = $ctr;
				}
				return $data;
			}
			
			//$this->con->close();
		}
		// transaction report monthly detailed
		function ShowSalesTotalTransMD($monthT)
		{
				$sql = "SELECT `transactions`.`csales_id`,
						`transactions`.`trans_no`,
						SUM(`transactions`.`csales_total`) AS csales_total,
						DATE(`transactions`.`date_sales`) AS s_date,
						`transactions`.`cashier_id` AS cashier_info,
						`transactions`.`sales_status`
						FROM `transactions`
						WHERE MONTH(`transactions`.`date_sales`) = $monthT AND YEAR((`transactions`.`date_sales`))=YEAR((CURDATE()))
						GROUP BY `transactions`.`date_sales`,`transactions`.`trans_no`
						ORDER BY `transactions`.`date_sales` ASC";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['trans_no'][$ctr] = $row['trans_no'];
					$data['transaction_sales'][$ctr] = $row['csales_total'];
					$data['s_date'][$ctr] = $row['s_date'];
					$data['cashier_info'][$ctr] = $row['cashier_info'];
					$data['status'][$ctr] = $row['sales_status'];
					$ctr++;	
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		function ShowSalesTotalTransGMonth($monthT)
		{
				$sql = "SELECT `transactions`.`csales_id`,
						`transactions`.`trans_no`,
						SUM(`transactions`.`csales_total`) AS tsales,
						DATE(`transactions`.`date_sales`) AS s_date,
						`transactions`.`cashier_id` AS cashier_info,
						`transactions`.`sales_status`
						FROM `transactions`
						WHERE MONTH(`transactions`.`date_sales`) = $monthT AND YEAR((`transactions`.`date_sales`))=YEAR((CURDATE()))
						GROUP BY `transactions`.`date_sales`
						ORDER BY `transactions`.`date_sales` ASC";
			
			$result2 = $this->con->query($sql);
			
			if($result2->num_rows > 0)
			{
				$data2 = array();
				$ctr2 = 0;
				
				while($row2 = $result2->fetch_assoc())
				{
					$data2['trans_no'][$ctr2] = $row2['trans_no'];
					$data2['transaction_sales'][$ctr2] = $row2['tsales'];
					$data2['s_date'][$ctr2] = $row2['s_date'];
					$data2['cashier_info'][$ctr2] = $row2['cashier_info'];
					$data2['status'][$ctr2] = $row2['sales_status'];
					$ctr2++;	
					$data2['count'] = $ctr2;
				}
				
				return $data2;
			}
			
			//$this->con->close();
		}
		// transaction report monthly detailed graph
		function ShowSalesTotalTransMDG($monthT)
		{
				$sql = "SELECT `transactions`.`csales_id`,
						`transactions`.`trans_no`,
						SUM(`transactions`.`csales_total`) AS csales_total,
						DATE(`transactions`.`date_sales`) AS s_date,
						`transactions`.`cashier_id` AS cashier_info,
						`transactions`.`sales_status`
						FROM `transactions`
						WHERE MONTH(`transactions`.`date_sales`) = $monthT AND YEAR((`transactions`.`date_sales`))=YEAR((CURDATE()))
						GROUP BY `transactions`.`date_sales`
						ORDER BY `transactions`.`date_sales` ASC";
			
			$result2 = $this->con->query($sql);
			
			if($result2->num_rows > 0)
			{
				$data2 = array();
				$ctr2 = 0;
				
				while($row = $result2->fetch_assoc())
				{
					$data2['transaction_sales'][$ctr2] = $row['csales_total'];
					$data2['s_date'][$ctr2] = $row['s_date'];
					$ctr2++;	
					$data2['count'] = $ctr2;
				}
				
				return $data2;
			}
			
			//$this->con->close();
		}
		function ShowTransMonthlyGraph()
		{
				$sql = "SELECT 
						SUM(`transactions`.`csales_total`) AS transaction_sales,
						MONTH(`transactions`.`date_sales`) AS s_month,
						YEAR(`transactions`.`date_sales`) AS s_year
						FROM `transactions`
						GROUP BY MONTH(`transactions`.`date_sales`)
						ORDER BY `transactions`.`date_sales`";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['transaction_sales'][$ctr] = $row['transaction_sales'];
					$data['s_month'][$ctr] = $row['s_month'];
					$data['s_year'][$ctr] = $row['s_year'];
					$ctr++;
					$data['count'] = $ctr;
				}
				return $data;
			}
			
			//$this->con->close();
		}
	
	// show sales per receipt or transaction
		function ShowSalesTotalTransYearly()
		{
				$sql = "SELECT `transactions`.`trans_no`,
						SUM(`transactions`.`csales_total`) AS transaction_sales,
						YEAR(`transactions`.`date_sales`) AS s_year,
						MONTH(`transactions`.`date_sales`) AS s_month,
						`transactions`.`cashier_id` AS cashier_info
						FROM `transactions`
						GROUP BY YEAR(`transactions`.`date_sales`)
						ORDER BY `transactions`.`date_sales`";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['trans_no'][$ctr] = $row['trans_no'];
					$data['transaction_sales'][$ctr] = $row['transaction_sales'];
					$data['s_year'][$ctr] = $row['s_year'];
					$data['s_month'][$ctr] = $row['s_month'];
					$data['cashier_info'][$ctr] = $row['cashier_info'];
					$ctr++;
					$data['count'] = $ctr;
				}
				return $data;
			}
			
			//$this->con->close();
		}// show sales per receipt
		function ShowSalesTotal()
		{
				$sql = "SELECT `cash_sales`.`trans_no`, 
				`cash_sales`.`csales_total`,
				`cash_sales`.`sales_status`, 
				DATE(`cash_sales`.`date_sales`) AS tdate
				FROM `cash_sales`
				WHERE DATE(date_sales)=CURDATE()";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['trans_no'][$ctr] = $row['trans_no'];
					$data['csales_total'][$ctr] = $row['csales_total'];
					$data['sales_status'][$ctr] = $row['sales_status'];
					$data['tdate'][$ctr] = $row['tdate'];
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
		}
	// sales detailed
	
	function ShowSalesDetailed()
		{
				$sql = "SELECT `sales`.`trans_no`, `product`.`product_name`, `sales`.`product_price`, `sales`.`qty`, `sales`.`date_sales`
				FROM `sales`, `product`
				WHERE `product`.`product_id`=`sales`.`product_id`
				and DATE(date_sales)=CURDATE()";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['trans_no'][$ctr] = $row['trans_no'];
					$data['product_name'][$ctr] = $row['product_name'];
					$data['product_price'][$ctr] = $row['product_price'];
					$data['qty'][$ctr] = $row['qty'];
					$data['date_sales'][$ctr] = $row['date_sales'];
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}

	function ShowTransTotal($transno)
		{
				$sql = "SELECT `sales`.`trans_no`, 
						SUM(`sales`.`qty`) AS trCount,
						SUM((`sales`.`product_price`*`sales`.`qty`)) AS salesTotal 
						FROM `product`, `sales`
						WHERE `product`.`product_id`=`sales`.`product_id`  
						and `sales`.`trans_no`='$transno'";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
					$data = array();
    	        	$row = $result->fetch_assoc();            
    	  			$data['salesTotal'] = $row['salesTotal'];
					$data['trCount'] = $row['trCount'];
				
				return $data;
			}
			
			//$this->con->close();
		}
		
	function ShowTrCount()
		{
			$sql = "SELECT COUNT(`transactions`.`trans_no`) AS trCount
					FROM `transactions`";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
					$data = array();
    	        	$row = $result->fetch_assoc();            
    	  			$data['trCount'] = $row['trCount'];
				
				return $data;
			}
			
			//$this->con->close();
					
		}

		
		// update Sales Delivery
	function updateSalesDelivery($trans)
		{
			$sql = "UPDATE transactions set remarks='".$trans->getRemarks()."', del_stat='".$trans->getDelStatus()."'
			where trans_no='".$trans->getTransNo()."'";
			
			$this->con->query($sql);
				
				echo "<script>alert('Sales Delivery Was Successfully Updated')</script>";
				echo "<meta http-equiv='refresh'content='0;url=delivery_list.php'>";
				//$this->con->close();	
					
		}	
		
	
	
		
		// for delivery
	
	function ShowTransDelivery()
		{
				$sql = "SELECT `transactions`.`trans_no`,
						`transactions`.`csales_total`,
						`transactions`.`date_sales`,
						`transactions`.`sales_status`,
						`transactions`.`customer_id`,
						`transactions`.`sales_invoice`,
						`transactions`.`remarks`,
						`transactions`.`del_status`
						FROM `transactions`
						WHERE `transactions`.`del_status`='delivery' AND `transactions`.`date_sales`=CURDATE()";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['trans_no'][$ctr] = $row['trans_no'];
					$data['csales_total'][$ctr] = $row['csales_total'];
					$data['date_sales'][$ctr] = $row['date_sales'];
					$data['sales_status'][$ctr] = $row['sales_status'];
					$data['customer_id'][$ctr] = $row['customer_id'];
					$data['sales_invoice'][$ctr] = $row['sales_invoice'];
					$data['remarks'][$ctr] = $row['remarks'];
					$data['del_status'][$ctr] = $row['del_status'];
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		

}

?>