<?php
//this is the ProductController
error_reporting(E_ALL & ~E_NOTICE);

class ProductController 
{
    var $con;
    function __construct() //use to initialize variables
    {
		include 'connection.php';
    }
	function addproduct($prod)
		{
			$check="SELECT * FROM product
					WHERE `product`.`product_name`='".$prod->getProductName()."' AND `product`.`product_description`='".$prod->getProductDescription()."' OR `product`.`product_type`='".$prod->getProductType()."'";
					$result = $this->con->query($check);
			if($result->num_rows > 0)
			{ 
			echo "<script>alert('Duplicate Product')</script>";
			echo "<meta http-equiv='refresh'content='0;url=product_list.php'>";
				
		}else{
					
					$sql = "INSERT into product(product_name, product_type, product_description, product_price)
					VALUES('".$prod->getProductName()."',
					'".$prod->getProductType()."',
					'".$prod->getProductDescription()."',
					'".$prod->getProductPrice()."')";
					$this->con->query($sql);
					
					echo "<script>alert('New Product Was Successfully Added')</script>";
					echo "<meta http-equiv='refresh'content='0;url=product_list.php'>";
					//$this->con->close();
				
			}		
		}
	// show product selling
		function ShowProductSelling()
		{
			$sql = "SELECT `product`.`product_id`, 
					`product`.`product_name`, 
					`product`.`product_description`, 
					`product_selling`.`selling_price`,
					`product_selling`.`sale_price`,
					`supplier`.`supplier_name`
					FROM `product`, `product_selling`,`supplier`
					WHERE `product`.`product_id`=`product_selling`.`product_id`
					AND `product`.`supplier_id`=`supplier`.`supplier_id`";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['product_id'][$ctr] = $row['product_id'];
					$data['product_name'][$ctr] = $row['product_name'];
					$data['product_description'][$ctr] = $row['product_description'];
					$data['supplier_name'][$ctr] = $row['supplier_name'];
					$data['selling_price'][$ctr] = $row['selling_price'];
					$data['sale_price'][$ctr] = $row['sale_price'];
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		
		// show product supplier price
		function ShowProductSupplierPrice()
		{
			$sql = "SELECT `product`.`product_id`, 
					`product`.`product_name`, 
					`product`.`product_description`, 
					`product_supplier`.`supplier_price`,
					`supplier`.`supplier_category`,
					`supplier`.`supplier_name`
					FROM `product`, `product_supplier`,`supplier`
					WHERE `product`.`product_id`=`product_supplier`.`product_id`
					AND `product`.`supplier_id`=`supplier`.`supplier_id`";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['product_id'][$ctr] = $row['product_id'];
					$data['product_name'][$ctr] = $row['product_name'];
					$data['product_description'][$ctr] = $row['product_description'];
					$data['supplier_name'][$ctr] = $row['supplier_name'];
					$data['supplier_price'][$ctr] = $row['supplier_price'];
					$data['supplier_category'][$ctr] = $row['supplier_category'];
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		
		// show product list
		function ShowProductList()
		{
			$sql = "SELECT `product`.`product_id`,
					`product`.`product_name`,
					`product`.`product_price`,
					`product`.`product_type`,
					`product`.`product_description`,
					`product`.`date_added`
					FROM `product`
					ORDER BY `product`.`product_description` ASC";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['product_id'][$ctr] = $row['product_id'];
					$data['product_name'][$ctr] = $row['product_name'];
					$data['product_price'][$ctr] = $row['product_price'];
					$data['product_description'][$ctr] = $row['product_description'];
					$data['product_type'][$ctr] = $row['product_type'];
					$ctr++;
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		
		// show product list count
		function ShowProductListCount()
		{
			$sql = "SELECT `product`.`product_id` AS pid, 
					`product`.`product_name`, 
					`product`.`product_category`, 
					`product`.`product_description`,
					IFNULL(`product`.`old_stocks`,0) AS old_stocks,
					`product`.`supplier_price` AS product_price,
					IFNULL((SELECT SUM(`sales`.`qty`) 
						FROM `sales`
						WHERE `sales`.`product_id`=pid
						),0) AS totalsales
					FROM `product`";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['pid'][$ctr] = $row['pid'];
					$data['product_name'][$ctr] = $row['product_name'];
					$data['product_description'][$ctr] = $row['product_description'];
					$data['supplier_name'][$ctr] = $row['supplier_name'];
					$data['product_category'][$ctr] = $row['product_category'];
					$data['product_price'][$ctr] = $row['product_price'];
					$data['pprice'][$ctr] = $row['pprice'];
					$data['psprice'][$ctr] = $row['psprice'];	
					$data['totalqty'][$ctr] = $row['totalqty'];
					$data['delqty'][$ctr] = $row['delqty'];
					$data['deldate'][$ctr] = $row['deldate'];
					$data['old_stocks'][$ctr] = $row['old_stocks'];
					$data['totaldelqty'][$ctr] = $row['totaldelqty'];
					$data['totalsales'][$ctr] = $row['totalsales'];
					
					$ctr++;
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		
		
		// show product sales
		function ShowProductSales($pid)
		{
			$sql = "SELECT `product`.`product_id` AS pid,  
					IFNULL(`product`.`old_stocks`,0) AS old_stocks,
					`product`.`supplier_price` AS product_price,
					IFNULL((SUM(`sales`.`qty`)),0) AS totalsales
					
					FROM `product`, `sales`,`transactions`
					WHERE `transactions`.`trans_no`=`sales`.`trans_no`
					AND `sales`.`product_id`=`product`.`product_id`
					AND `product`.`product_id`=$pid
					AND `transactions`.`sales_status`!='cancelled'
					GROUP BY `sales`.`product_id`";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['pid'][$ctr] = $row['pid'];
					$data['product_price'][$ctr] = $row['product_price'];
					$data['old_stocks'][$ctr] = $row['old_stocks'];
					$data['totalsales'][$ctr] = $row['totalsales'];
					
					$ctr++;
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		

		
	function ShowProductCount()
		{
			$sql = "SELECT COUNT(`product`.`product_id`) AS prodCount
					FROM `product`";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
					$data = array();
    	        	$row = $result->fetch_assoc();            
    	  			$data['prodCount'] = $row['prodCount'];
				
				return $data;
			}
			
			//$this->con->close();
					
		}	
		// update product info
	function updateProduct($prod)
		{
			$sql = "UPDATE product set product_name='".$prod->getProductName()."',
			product_price='".$prod->getProductPrice()."',
			product_description='".$prod->getProductDescription()."',
			product_type='".$prod->getProductType()."'
			
			where product_id='".$prod->getProductId()."'";
			$this->con->query($sql);
				echo "<script>alert('Product Was Successfully updated')</script>";
				echo "<meta http-equiv='refresh'content='0;url=product_list.php'>";
				//$this->con->close();	
					
		}


		function updateStocks($pr)
		{
			$sql = "UPDATE product set old_stocks='".$pr->getOldStocks()."' 
			where product_id='".$pr->getProductId()."' ";
			
			$this->con->query($sql);
				
				echo "<script>alert('Initial Product Stocks Was Successfully set')</script>";
				echo "<meta http-equiv='refresh'content='0;url=stocks.php'>";
				//$this->con->close();	
					
		}

		// old stocks
		function ShowProductListOld()
		{
			$sql = "SELECT `product`.`product_id` AS pid, 
					`product`.`product_name`, 
					`product`.`product_category`, 
					`product`.`product_description`,
					`product`.`supplier_price` AS product_price,
					`product`.`selling_price` AS price_supplier,  
					IFNULL(`product`.`old_stocks`,0) AS old_stocks
					FROM `product`
					GROUP BY `product`.`product_id`
					ORDER BY `product`.`product_id` ASC	";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['pid'][$ctr] = $row['pid'];
					$data['product_name'][$ctr] = $row['product_name'];
					$data['product_description'][$ctr] = $row['product_description'];
					$data['supplier_name'][$ctr] = $row['supplier_name'];
					$data['product_category'][$ctr] = $row['product_category'];
					$data['product_price'][$ctr] = $row['product_price'];
					$data['price_supplier'][$ctr] = $row['price_supplier'];
					$data['old_stocks'][$ctr] = $row['old_stocks'];
					
					$ctr++;
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		//product_sales
		function ShowTotalSales($prod_id)
		{
			$sql = "SELECT 
					SUM(`sales`.`qty`) AS ptotal
					FROM `sales`
					WHERE `sales`.`product_id`='".$prod_id."'
					";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
					$data = array();
    	        	$row = $result->fetch_assoc();            
    	  			$data['ptotal'] = $row['ptotal'];
				
				return $data;
			}
			
			//$this->con->close();
					
		}
		
		//product_delivery
		function ShowTotalDelivery($prod_id)
		{
			$sql = "SELECT SUM(`delivery`.`qty`) AS totaldelqty
						FROM `delivery`
						WHERE `delivery`.`product_id`='".$prod_id."'
					";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
					$data = array();
    	        	$row = $result->fetch_assoc();            
    	  			$data['totaldelqty'] = $row['totaldelqty'];
				
				return $data;
			}
			
			//$this->con->close();
					
		}

}

?>