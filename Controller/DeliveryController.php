<?php
//this is the Supplier controller
error_reporting(E_ALL & ~E_NOTICE);

class DeliveryController 

{
    var $con;
    function __construct() //use to initialize variables
    {
		include 'connection.php';
    }

	// show delivery info daily
		function ShowTransDelivery()
		{
				$sql = "SELECT `transactions`.`csales_id`,
						`transactions`.`trans_no`,
						`transactions`.`csales_total`,
						DATE(`transactions`.`date_sales`) AS s_date,
						`transactions`.`cashier_id` AS cashier_info,
						`transactions`.`del_status`,
						`transactions`.`remarks`,
						`transactions`.`del_stat`
						FROM `transactions`
						WHERE `transactions`.`date_sales` = CURDATE() AND `transactions`.`del_status`='delivery'
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
					$data['del_status'][$ctr] = $row['del_status'];
					$data['remarks'][$ctr] = $row['remarks'];
					$data['del_stat'][$ctr] = $row['del_stat'];
					$ctr++;	
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		
		// show delivery detailed
		function ShowTransDeliveryDetailed($trans_no)
		{
				$sql = "SELECT `transactions`.`csales_id`,
						`transactions`.`trans_no`,
						`transactions`.`csales_total`,
						DATE(`transactions`.`date_sales`) AS s_date,
						`transactions`.`cashier_id` AS cashier_info,
						`transactions`.`del_status`,
						`transactions`.`remarks`,
						`transactions`.`del_stat`
						FROM `transactions`
						WHERE `transactions`.`trans_no`='$trans_no'
						AND `transactions`.`del_status`='delivery'
						ORDER BY `transactions`.`date_sales` DESC, `transactions`.`csales_id` DESC";
			
			$result = $this->con->query($sql);
			if($result->num_rows > 0)
			{
					$data = array();
    	        	$row = $result->fetch_assoc();
					$data['trans_no'] = $row['trans_no'];
					$data['transaction_sales'] = $row['csales_total'];
					$data['s_date'] = $row['s_date'];
					$data['cashier_info'] = $row['cashier_info'];
					$data['del_status'] = $row['del_status'];
					$data['remarks'] = $row['remarks'];
					$data['del_stat'] = $row['del_stat'];	
				return $data;
			}
			
			//$this->con->close();
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
		// monthly delivery
		function ShowDeliveryTransMonthly()
		{
				$sql = "SELECT `transactions`.`trans_no`,
						SUM(`transactions`.`csales_total`) AS transaction_sales,
						MONTH(`transactions`.`date_sales`) AS s_month,
						YEAR(`transactions`.`date_sales`) AS s_year,
						`transactions`.`cashier_id` AS cashier_info,
						`transactions`.`date_sales` AS s_date,
						`transactions`.`del_stat`,
						`transactions`.`del_status`,
						`transactions`.`remarks`
						FROM `transactions`
						WHERE
						`transactions`.`del_status`='delivery'
						GROUP BY MONTH(`transactions`.`date_sales`) 
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
					$data['s_month'][$ctr] = $row['s_month'];
					$data['s_year'][$ctr] = $row['s_year'];
					$data['s_date'][$ctr] = $row['s_date'];
					$data['cashier_info'][$ctr] = $row['cashier_info'];
					$data['del_stat'][$ctr] = $row['del_stat'];
					$data['del_status'][$ctr] = $row['del_status'];
					$data['remarks'][$ctr] = $row['remarks'];
					
					$ctr++;
					$data['count'] = $ctr;
				}
				return $data;
			}
			
			//$this->con->close();
		}
		
		function addDelivery()
		{
			
			$trno=$_POST['trno'];
			$drsi=$_POST['drsi'];
			$drsino=$_POST['drsino'];
			$prodid=$_POST['prodid'];
			$prodprice=$_POST['prodprice'];
			$qty=$_POST['qty'];
			$produnit=$_POST['produnit'];
			$poid=$_POST['po_id'];
			
			$sql = "INSERT into delivery(tr_number, product_id, product_price, qty, product_unit, dr_si_no, dr_si, po_id)
				VALUES('".$trno."','".$prodid."','".$prodprice."','".$qty."','".$produnit."','".$drsino."','".$drsi."','".$poid."')";
				$this->con->query($sql);
				
			$sqlupdate="update po set po.status='delivered', product_price='".$prodprice."' WHERE po.po_id='$poid' ";
				$this->con->query($sqlupdate);
				echo "<script>alert('New Delivery Added!')</script>";
				echo "<meta http-equiv='refresh'content='0;url=delivery_detailed.php?tr_no=".$trno."'>";
				
				//$this->con->close();	
		}
		

}

?>