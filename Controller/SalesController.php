<?php
// controller
error_reporting(E_ALL & ~E_NOTICE);

class SalesController 
{
    var $con;
    function __construct() //use to initialize variables
    {
		include 'connection.php';
    }

	function addSales($sl)
		{
			$prodid=$sl->getProductId();
			$qty=$sl->getQty();
			//echo $pprice=$sl->getProductPrice();
			
				$sqlcheck="SELECT `product`.`product_id`, `product`.`product_name`,
				`product`.`product_description`,
				`product`.`product_price`,
				`product`.`product_type`				
				FROM `product`
				WHERE  `product`.`product_id`='".$sl->getProductId()."'";
				$resultc = $this->con->query($sqlcheck);
				
				if($resultc->num_rows > 0)
				{
					$data = array();
						$rowc = $resultc->fetch_assoc();            
						$data['product_price'] = $rowc['product_price'];
						$pprice=$rowc['product_price'];
						
				$sql = "INSERT INTO sales(trans_no, product_id, 
						product_price, no_item, 
						user_id, sales_total)
				VALUES('".$sl->getTransNo()."','".$sl->getProductId()."','".$data['product_price']."','".$sl->getQty()."','".$sl->getCashierId()."','".$data['product_price']*$sl->getQty()."')";
				$this->con->query($sql);
				
				//echo "<script>alert('Item Successfully Added')</script>";
				echo "<meta http-equiv='refresh'content='0;url=POS.php'>";
				//$this->con->close();
				}
			
				
		}
		
		// transaction count
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
		
			//delete item from sales
	function deleteSales($sales)
		{
				$uname=$_POST['uname'];
				$upass=$_POST['upass'];
				$sid = $_POST['sales_id'];

				$sql = "SELECT `account`.`username`,
						`account`.`password`,
						`account`.`status`,
						`account`.`access_level`,
						`account`.`status`
						FROM `account`,`owner` 
						WHERE `account`.`username`='$uname'
						AND `account`.`password`='$upass'
						AND `owner`.`owner_id`=`account`.`user_id`";
			
				$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
				{
					$sid = $_POST['sales_id'];
					$sqlDel = "DELETE FROM sales WHERE sales_id = '".$sid."'";
					$this->con->query($sqlDel);
					echo "<script>alert('Item Successfully removed!')</script>";
					echo "<meta http-equiv='refresh'content='0;url=POS.php'>";
				}
				else{
					echo "<script>alert('Access Denied!')</script>";
					echo "<meta http-equiv='refresh'content='0;url=POS.php'>";
				}
				
						
				//$this->conn->close();
		}
		
	// show sales per receipt or transaction
		function ShowSalesTotalTrans()
		{
				$sql = "SELECT `sales`.`trans_no`,
						SUM(`sales`.`sales_total`) AS transaction_sales,
						DATE(`sales`.`sales_date`) AS s_date,
						`sales`.`user_id` AS cashier_info
						FROM `sales`
						WHERE MONTH(`sales`.`sales_date`) = MONTH(CURDATE()) AND YEAR((`sales`.`sales_date`))=YEAR((CURDATE()))
						GROUP BY `sales`.`trans_no`
						ORDER BY `sales`.`sales_date`
						 DESC";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['trans_no'][$ctr] = $row['trans_no'];
					$data['transaction_sales'][$ctr] = $row['transaction_sales'];
					$data['s_date'][$ctr] = $row['s_date'];
					$data['cashier_info'][$ctr] = $row['cashier_info'];
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		
		// show sales per receipt or transaction
		function ShowSalesTotalTransDetailed($trans_no)
		{
				$sql = "SELECT `sales`.`trans_no`,
						`sales`.`product_id`,
						`sales`.`product_price`,
						`product`.`product_description`,
						`sales`.`no_item`,
						(`sales`.`sales_total`) AS transaction_sales,
						DATE(`sales`.`sales_date`) AS s_date,
						`sales`.`user_id` AS cashier_info
						FROM `sales`,`product`
						WHERE `sales`.`trans_no`='$trans_no' 
						AND `product`.`product_id`=`sales`.`product_id`
						ORDER BY `sales`.`sales_date`
						DESC";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['trans_no'][$ctr] = $row['trans_no'];
					$data['transaction_sales'][$ctr] = $row['transaction_sales'];
					$data['s_date'][$ctr] = $row['s_date'];
					$data['cashier_info'][$ctr] = $row['cashier_info'];
					$data['product_id'][$ctr] = $row['product_id'];
					$data['product_price'][$ctr] = $row['product_price'];
					$data['product_description'][$ctr] = $row['product_description'];
					$data['no_item'][$ctr] = $row['no_item'];
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
				$sql = "SELECT `sales`.`trans_no`,
						SUM(`sales`.`sales_total`) AS transaction_sales,
						MONTH(`sales`.`sales_date`) AS s_month,
						`sales`.`user_id` AS cashier_info,
						YEAR(`sales`.`sales_date`) AS s_year
						FROM `sales`
						WHERE MONTH(`sales`.`sales_date`) = MONTH(CURDATE()) AND YEAR((`sales`.`sales_date`))=YEAR((CURDATE()))
						GROUP BY MONTH(`sales`.`sales_date`)
						ORDER BY `sales`.`sales_date`";
			
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
	// show sales per receipt or transaction
		function ShowSalesTotalTransYearly()
		{
				$sql = "SELECT `sales`.`trans_no`,
						SUM(`sales`.`sales_total`) AS transaction_sales,
						YEAR(`sales`.`sales_date`) AS s_year,
						`sales`.`user_id` AS cashier_info
						FROM `sales`
						GROUP BY YEAR(`sales`.`sales_date`)
						ORDER BY `sales`.`sales_date`";
			
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
					$data['cashier_info'][$ctr] = $row['cashier_info'];
					$ctr++;
					$data['count'] = $ctr;
				}
				return $data;
			}
			
			//$this->con->close();
		}
	// show sales per receipt or transaction
		function ShowSalesTotal()
		{
				$sql = "SELECT `transactions`.`trans_no`, 
				`transactions`.`csales_total`,
				`transactions`.`sales_status`, 
				`transactions`.`cod_sales_stat`, 
				date(`transactions`.`date_sales`) as date_sales, 
				`transactions`.`customer_id` AS cuid,
				`transactions`.`remarks`,
				(SELECT `customer`.`cu_name` 
				FROM `customer`
				WHERE `customer`.`customer_id`=cuid) AS cu_name,
				`transactions`.`sales_invoice`,
				DATE(`transactions`.`date_sales`) AS tdate
				FROM `transactions`
				WHERE DATE(date_sales)=CURDATE()
				ORDER BY `transactions`.`sales_invoice` DESC";
			
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
					$data['customer_id'][$ctr] = $row['cuid'];
					$data['sales_invoice'][$ctr] = $row['sales_invoice'];
					$data['cu_name'][$ctr] = $row['cu_name'];
					$data['cod_sales_stat'][$ctr] = $row['cod_sales_stat'];
					$data['date_sales'][$ctr] = $row['date_sales'];
					$data['remarks'][$ctr] = $row['remarks'];
					
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		
		// show sales monthly
		function ShowSalesTotalMonthly()
		{
				$sql = "SELECT `transactions`.`trans_no`, 
						`transactions`.`csales_total`,
						`transactions`.`sales_status`,
						`transactions`.`remarks`,				
						`transactions`.`cod_sales_stat`, 
						date(`transactions`.`date_sales`) as date_sales, 
						date(`transactions`.`date_payment`) as date_payment, 
						`transactions`.`customer_id` AS cuid,
						(SELECT `customer`.`cu_name` 
						FROM `customer`
						WHERE `customer`.`customer_id`=cuid) AS cu_name,
						`transactions`.`sales_invoice`,
						DATE(`transactions`.`date_sales`) AS tdate
				FROM `transactions`
				WHERE MONTH(date_sales)=MONTH(CURDATE())
				ORDER BY `transactions`.`sales_invoice` DESC";
			
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
					$data['customer_id'][$ctr] = $row['cuid'];
					$data['sales_invoice'][$ctr] = $row['sales_invoice'];
					$data['cu_name'][$ctr] = $row['cu_name'];
					$data['cod_sales_stat'][$ctr] = $row['cod_sales_stat'];
					$data['date_sales'][$ctr] = $row['date_sales'];
					$data['date_payment'][$ctr] = $row['date_payment'];
					$data['remarks'][$ctr] = $row['remarks'];
					
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		
		// show sales yearly
		function ShowSalesTotalYearly()
		{
				$sql = "SELECT `transactions`.`trans_no`,
				`transactions`.`csales_id`,
				`transactions`.`csales_total`,
				`transactions`.`sales_status`,
				`transactions`.`remarks`,				
				`transactions`.`cod_sales_stat`, 
				DATE(`transactions`.`date_sales`) AS date_sales, 
				DATE(`transactions`.`date_payment`) AS date_payment, 
				`transactions`.`customer_id` AS cuid,
				(SELECT `customer`.`cu_name` 
				FROM `customer`
				WHERE `customer`.`customer_id`=cuid) AS cu_name,
				`transactions`.`sales_invoice`,
				DATE(`transactions`.`date_sales`) AS tdate
				FROM `transactions`
				WHERE YEAR(date_sales)=YEAR(CURDATE())
				
				ORDER BY `transactions`.`sales_invoice` DESC";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['csales_id'][$ctr] = $row['csales_id'];
					$data['trans_no'][$ctr] = $row['trans_no'];
					$data['csales_total'][$ctr] = $row['csales_total'];
					$data['sales_status'][$ctr] = $row['sales_status'];
					$data['tdate'][$ctr] = $row['tdate'];
					$data['customer_id'][$ctr] = $row['cuid'];
					$data['sales_invoice'][$ctr] = $row['sales_invoice'];
					$data['cu_name'][$ctr] = $row['cu_name'];
					$data['cod_sales_stat'][$ctr] = $row['cod_sales_stat'];
					$data['date_sales'][$ctr] = $row['date_sales'];
					$data['date_payment'][$ctr] = $row['date_payment'];
					$data['remarks'][$ctr] = $row['remarks'];
					
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		
		
		// show Payment sales Daily
		function ShowSalesTotalPaymentDaily($datefrom,$dateto)
		{
				$sql = "SELECT `transactions`.`trans_no`, 
				`transactions`.`csales_total`,
				`transactions`.`sales_status`, 
				`transactions`.`cod_sales_stat`, 
				`transactions`.`remarks`,
				`transactions`.`customer_id` AS cuid,
				(SELECT `customer`.`cu_name` 
				FROM `customer`
				WHERE `customer`.`customer_id`=cuid) AS cu_name,
				`transactions`.`sales_invoice`,
				DATE(`transactions`.`date_sales`) AS tdate
				FROM `transactions`
				WHERE `transactions`.`sales_status`='payment'
				AND DATE(`transactions`.`date_sales`) BETWEEN '$datefrom' AND '$dateto'
				ORDER BY `transactions`.`sales_invoice` DESC";
			
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
					$data['customer_id'][$ctr] = $row['cuid'];
					$data['sales_invoice'][$ctr] = $row['sales_invoice'];
					$data['cu_name'][$ctr] = $row['cu_name'];
					$data['cod_sales_stat'][$ctr] = $row['cod_sales_stat'];
					$data['remarks'][$ctr] = $row['remarks'];
					
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
// show cash sales Daily
		function ShowSalesTotalCashDaily($datefrom,$dateto)
		{
				$sql = "SELECT `transactions`.`trans_no`, 
				`transactions`.`csales_total`,
				`transactions`.`sales_status`, 
				`transactions`.`cod_sales_stat`, 
				`transactions`.`remarks`,
				`transactions`.`customer_id` AS cuid,
				(SELECT `customer`.`cu_name` 
				FROM `customer`
				WHERE `customer`.`customer_id`=cuid) AS cu_name,
				`transactions`.`sales_invoice`,
				DATE(`transactions`.`date_sales`) AS tdate
				FROM `transactions`
				WHERE `transactions`.`sales_status`='cash'
				AND DATE(`transactions`.`date_sales`) BETWEEN '$datefrom' AND '$dateto'
				ORDER BY `transactions`.`sales_invoice` DESC";
			
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
					$data['customer_id'][$ctr] = $row['cuid'];
					$data['sales_invoice'][$ctr] = $row['sales_invoice'];
					$data['cu_name'][$ctr] = $row['cu_name'];
					$data['cod_sales_stat'][$ctr] = $row['cod_sales_stat'];
					$data['remarks'][$ctr] = $row['remarks'];
					
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}

	// sales detailed
	
	function ShowSalesDetailed()
		{
				$si=$_GET['si'];
				$sql = "SELECT `sales`.`trans_no`, 
				`product`.`product_name`, 
				`sales`.`product_price`, 
				`sales`.`qty`, 
				`sales`.`date_sales`,
				`transactions`.`sales_invoice`,
				`product`.`product_description`
				FROM `sales`, `product`, `transactions`
				WHERE `product`.`product_id`=`sales`.`product_id`
				AND DATE(`transactions`.date_sales)=CURDATE()
				AND `transactions`.`sales_status`='Cash'
				AND `transactions`.`trans_no`=`sales`.`trans_no`
				AND `transactions`.`sales_invoice`='$si'";
			
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
					$data['sales_invoice'][$ctr] = $row['sales_invoice'];
					$data['product_description'][$ctr] = $row['product_description'];
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		
		
		// show sales detailed payment
		function ShowSalesDetailedPayment()
		{
				$sql = "SELECT `sales`.`trans_no`, `product`.`product_name`, `sales`.`product_price`, `sales`.`qty`, `sales`.`date_sales`
				FROM `sales`, `product`, `transactions`
				WHERE `product`.`product_id`=`sales`.`product_id`
				AND DATE(`transactions`.date_sales)=CURDATE()
				AND `transactions`.`sales_status`='payment'
				AND `transactions`.`trans_no`=`sales`.`trans_no`";
			
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
		
	function ShowSalesSum()
		{
			$sql = "SELECT SUM(`transactions`.`csales_total`) AS cashSales, CURDATE() AS datetoday
					FROM `transactions`
					WHERE DATE(date_sales)=CURDATE() AND `transactions`.`sales_status`!='cod'";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
					$data = array();
    	        	$row = $result->fetch_assoc();            
    	  			$data['cashSales'] = $row['cashSales'];
				
				return $data;
			}
			
			//$this->con->close();
					
		}
		
	
		
		// total Cash sales
		
		function ShowTotalCash($sdatefrom,$sdateto)
		{
			$sdatefrom=$_POST['sdatefrom'];
			$sdateto=$_POST['sdateto'];
			$sql = "SELECT SUM(`transactions`.`csales_total`) AS cashSales, CURDATE() AS datetoday
					FROM `transactions`
					WHERE DATE(date_sales) BETWEEN '$sdatefrom' AND '$sdateto' 
					AND `transactions`.`sales_status`='cash'";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
					$data = array();
    	        	$row = $result->fetch_assoc();            
    	  			$data['cashSales'] = $row['cashSales'];
				
				return $data;
			}
			
			//$this->con->close();
					
		}
		


	// sales detailed
	function ShowSalesDetailedTrans($transno)
		{
				$sql = "SELECT `sales`.`trans_no`,
						`sales`.`sales_id`,
						`sales`.`product_price`, 
						`product`.`product_description`, 
						`product`.`product_name`, 
						`sales`.`product_id`,
						`sales`.`no_item`,
						DATE(`sales`.`sales_date`) AS transDate,
						(`sales`.`product_price`*`sales`.`no_item`) AS salesTotal 
						FROM `product`, `sales`
						WHERE `product`.`product_id`=`sales`.`product_id`
						AND `sales`.`trans_no`='$transno'
						order by `sales`.`sales_id` ASC";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['trans_no'][$ctr] = $row['trans_no'];
					$data['product_id'][$ctr] = $row['product_id'];
					$data['product_description'][$ctr] = $row['product_description'];
					$data['product_name'][$ctr] = $row['product_name'];
					$data['product_price'][$ctr] = $row['product_price'];
					$data['qty'][$ctr] = $row['no_item'];
					$data['transDate'][$ctr] = $row['transDate'];
					$data['salesTotal'][$ctr] = $row['salesTotal'];
					$data['sales_id'][$ctr] = $row['sales_id'];

					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
	// sales detailed
	function ShowTransTotal($transno)
		{
				$sql = "SELECT `sales`.`trans_no`, 
						SUM(`sales`.`no_item`) AS trCount,
						SUM((`sales`.`product_price`*`sales`.`no_item`)) AS salesTotal 
						FROM `product`, `sales`
						WHERE `product`.`product_id`=`sales`.`product_id`  
						AND `sales`.`trans_no`='$transno'";
			
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
		
		// show sales detailed info
	function ShowSalesDetailedPOS($sales_id)
		{
				$sql = "SELECT `sales`.`sales_id`,
						`sales`.`no_item`,
						`sales`.`product_id`,
						`sales`.`product_price`,
						`sales`.`sales_total`,
						`sales`.`trans_no`,
						`product`.`product_description`
						FROM `product`, `sales`
						WHERE `sales`.`product_id`=`product`.`product_id`
						AND `sales`.`sales_id`='$sales_id'";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
					$data = array();
    	        	$row = $result->fetch_assoc();            
    	  			$data['sales_id'] = $row['sales_id'];
					$data['no_item'] = $row['no_item'];
					$data['product_price'] = $row['product_price'];
					$data['sales_total'] = $row['sales_total'];
					$data['trans_no'] = $row['trans_no'];
					$data['product_description'] = $row['product_description'];
				
				return $data;
			}
			
			//$this->con->close();
		}
	// show sales daily	
	function ShowSalesDaily()
		{
				$sql = "SELECT `transactions`.`trans_no` AS trno, 
				(SELECT `transactions`.`csales_total`
				FROM `transactions` 
				WHERE `transactions`.`trans_no`=trno AND `transactions`.`sales_status`='cash') AS cashTotal,
				(SELECT `transactions`.`csales_total`
				FROM `transactions` 
				WHERE `transactions`.`trans_no`=trno AND `transactions`.`sales_status`='credit') AS creditTotal,
				(SELECT `transactions`.`csales_total`
				FROM `transactions` 
				WHERE `transactions`.`trans_no`=trno AND `transactions`.`sales_status`='payment') AS codTotal,
				`transactions`.`sales_status`,
				DATE(`transactions`.`date_sales`) AS transdate,
				`transactions`.`sales_invoice`
				FROM `transactions`
				WHERE MONTH(`transactions`.`date_sales`)= MONTH(CURDATE())";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['trno'][$ctr] = $row['trno'];
					$data['cashTotal'][$ctr] = $row['cashTotal'];
					$data['creditTotal'][$ctr] = $row['creditTotal'];
					$data['codTotal'][$ctr] = $row['codTotal'];
					$data['sales_status'][$ctr] = $row['sales_status'];
					$data['transdate'][$ctr] = $row['transdate'];
					$data['sales_invoice'][$ctr] = $row['sales_invoice'];
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
	

	//daily
	function ShowTotalSalesPaymentDaily()
		{
				$sql = "SELECT 	`transactions`.`sales_status`,
						SUM(`transactions`.`csales_total`) AS slpaymentTotal 
						FROM `transactions`
						WHERE `transactions`.`date_sales`= CURDATE() AND `transactions`.`sales_status`='payment'
						GROUP BY `transactions`.`sales_status`";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
					$datapayment = array();
    	        	$row = $result->fetch_assoc();            
    	  			$datapayment['slpaymentTotal'] = $row['slpaymentTotal'];
				
				return $datapayment;
			}
			
			//$this->con->close();
		}

	function ShowSalesPerDay()
		{
				$sql = "SELECT  `transactions`.`sales_invoice`,
				`transactions`.`sales_status`,
				SUM(`transactions`.`csales_total`) AS salesT,
				DATE(`transactions`.`date_sales`) AS transdate
				
				FROM `transactions`
				WHERE DAY(`transactions`.`date_sales`)= DAY(CURDATE()) AND 
				YEAR(`transactions`.`date_sales`)= YEAR(CURDATE())
				GROUP BY DAY(`transactions`.`date_sales`), `transactions`.`sales_status`";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['sales_invoice'][$ctr] = $row['sales_invoice'];
					$data['salesT'][$ctr] = $row['salesT'];
					$data['sales_status'][$ctr] = $row['sales_status'];
					$data['transdate'][$ctr] = $row['transdate'];
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
//per month
function ShowSalesPerMonth()
		{
				$sql = "SELECT  `transactions`.`sales_invoice`,
				`transactions`.`sales_status`,
				SUM(`transactions`.`csales_total`) AS salesT,
				MONTH(`transactions`.`date_sales`) AS transmonth,
				YEAR(`transactions`.`date_sales`) AS transyear
				
				FROM `transactions`
				WHERE 
				YEAR(`transactions`.`date_sales`)= YEAR(CURDATE())
				AND `transactions`.`sales_status`!='Cancelled'
				GROUP BY MONTH(`transactions`.`date_sales`), `transactions`.`sales_status`
				";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['sales_invoice'][$ctr] = $row['sales_invoice'];
					$data['salesT'][$ctr] = $row['salesT'];
					$data['sales_status'][$ctr] = $row['sales_status'];
					$data['transmonth'][$ctr] = $row['transmonth'];
					$data['transyear'][$ctr] = $row['transyear'];
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
//per year

function ShowSalesPerYear()
		{
				$sql = "SELECT  `transactions`.`sales_status`,
				SUM(`transactions`.`csales_total`) AS salesT,
				YEAR(`transactions`.`date_sales`) AS transyear
				FROM `transactions`
				WHERE
				YEAR(`transactions`.`date_sales`)= YEAR(CURDATE())
				GROUP BY YEAR(`transactions`.`date_sales`), `transactions`.`sales_status`";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['salesT'][$ctr] = $row['salesT'];
					$data['sales_status'][$ctr] = $row['sales_status'];
					$data['transyear'][$ctr] = $row['transyear'];
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
	
	

		
		function ShowSalesTr()
		{
				$si=$_GET['si'];
				$sql = "SELECT `sales`.`trans_no`,  
				SUM(`sales`.`product_price`*`sales`.`qty`) AS salesTotal, 	
				`transactions`.`sales_invoice`,
				DATE(`sales`.`date_sales`) AS date_sales
				
			
				FROM `sales`, `product`, `transactions`
				WHERE `product`.`product_id`=`sales`.`product_id`
				AND (`transactions`.`sales_status`!='payment' and `transactions`.`sales_status`!='Cancelled') 
				AND `transactions`.`trans_no`=`sales`.`trans_no`
				GROUP BY `transactions`.`sales_invoice`
				ORDER BY `transactions`.`sales_invoice` ASC";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['trans_no'][$ctr] = $row['trans_no'];
					$data['salesTotal'][$ctr] = $row['salesTotal'];
					$data['date_sales'][$ctr] = $row['date_sales'];
					$data['sales_invoice'][$ctr] = $row['sales_invoice'];
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}



}

?>