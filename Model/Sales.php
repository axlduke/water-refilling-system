<?php
//this is Sales model
class Sales
{
    var $sales_id;
    var $product_id;
    var $no_item;
	var $sales_total;
	var $user_id;
	var $trans_no;
	var $qty;
	var $cashier_id;
	var $product_price;
    
    function __construct()
    {
        $this->sales_id = 00000000;
        $this->product_id = 00000000;
        $this->no_item = 000000000;
        $this->sales_total = 0000000;
        $this->user_id = 0000000;
		$this->qty = 1;
		$this->trans_no=1;
		$this->cashier_id = 1;
		$this->product_price=1;
    }

    //sales_id
    function setSalesId($sales_id)
    {
        $this->sales_id = $sales_id;
    }
    function getSalesId()
    {
       return $this->sales_id; 
    }

    //product_id
    function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }
    function getProductId()
    {
       return $this->product_id; 
    }
	
	//no_item
    function setNoItem($no_item)
    {
        $this->no_item = $no_item;
    }
    function getNoItem()
    {
       return $this->no_item; 
    }
	
	//sales_total
    function setSalesTotal($sales_total)
    {
        $this->sales_total = $sales_total;
    }
    function getSalesTotal()
    {
       return $this->sales_total; 
    }
	
	//user_id
    function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    function getUserId()
    {
       return $this->user_id; 
    }
	//trans_no
    function setTransNo($trans_no)
    {
        $this->trans_no = $trans_no;
    }
	
    function getTransNo()
    {
        return $this->trans_no;
    }
	//qty
    function setQty($qty)
    {
        $this->qty = $qty;
    }
    function getQty()
    {
       return $this->qty; 
    }
	//cashier_id
    function setCashierId($cashier_id)
    {
        $this->cashier_id = $cashier_id;
    }
    function getCashierId()
    {
       return $this->cashier_id; 
    }
	//product_price
    function setProductPrice($product_price)
    {
        $this->product_price = $product_price;
    }
    //getter or accessor
    function getProductPrice()
    {
       return $this->product_price; 
    }

}

?>