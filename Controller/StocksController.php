<?php
//this is the Stocks controller
error_reporting(E_ALL & ~E_NOTICE);

class StocksController 

{
    var $con;
    function __construct() //use to initialize variables
    {
		include 'connection.php';
    }

	// show list and description of Stocks (select query) 
		function ShowStocks()
		{
				$sql = "SELECT  `stocks`.`stocks_id` AS st_id, 
							IFNULL((SELECT SUM(`stocks_delivery`.`qty`) 
							FROM `stocks_delivery`
							WHERE `stocks_delivery`.`stocks_id`=st_id),0) AS s_qty,
							IFNULL((SELECT MAX(`stocks_delivery`.`sd_date`)
							FROM `stocks_delivery`
							WHERE `stocks_delivery`.`stocks_id`=st_id),'-') AS mdate,
							`stocks`.`s_description`,
							`stocks`.`s_name`,
							`stocks`.`s_price`,
							`stocks`.`s_unit`,
							`stocks`.`brand`
							FROM `stocks`
							
							GROUP BY `stocks`.`stocks_id`";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['brand'][$ctr] = $row['brand'];
					$data['mdate'][$ctr] = $row['mdate'];
					$data['stocks_id'][$ctr] = $row['st_id'];
					$data['s_description'][$ctr] = $row['s_description'];
					$data['s_name'][$ctr] = $row['s_name'];
					$data['s_price'][$ctr] = $row['s_price'];
					$data['s_unit'][$ctr] = $row['s_unit'];
					$data['s_qty'][$ctr] = $row['s_qty'];
					
					$ctr++;	
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		
		// add stocks (insert query)
		function addstocks()
		{
			$s_name=$_POST['s_name'];
			$s_description=$_POST['s_description'];
			$s_price=$_POST['s_price'];
			$s_unit=$_POST['s_unit'];
			
			$sqlAddStocks = "INSERT into stocks(s_name, s_description, s_price,  s_unit)
				VALUES('".$s_name."','".$s_description."','".$s_price."','".$s_unit."')";
				$this->con->query($sqlAddStocks);
				
				echo "<script>alert('New Stocks information Added!')</script>";
				echo "<meta http-equiv='refresh'content='0';url=inventory_list.php>";
				
				//$this->con->close();	
		}
			

}

?>