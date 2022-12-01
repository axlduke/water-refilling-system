<?php
//this is Product model
class Product
{
    var $product_id;
    var $product_name;
    var $product_price;
    var $product_type;
    var $product_description;
    
    function __construct()
    {
        $this->product_id = 00000001;
        $this->product_name = "@pname";
		$this->product_price = "@pprice";
		$this->product_type = "@ptype";
		$this->product_description = "@pdesc";
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

    //product_name
    function setProductName($product_name)
    {
        $this->product_name = $product_name;
    }
    function getProductName()
    {
       return $this->product_name; 
    }
	
	 //product_price
    function setProductPrice($product_price)
    {
        $this->product_price = $product_price;
    }
    function getProductPrice()
    {
       return $this->product_price; 
    }
	
	//product_type
    function setProductType($product_type)
    {
        $this->product_type = $product_type;
    }
    function getProductType()
    {
       return $this->product_type; 
    }
	
	//product_description
    function setProductDescription($product_description)
    {
        $this->product_description = $product_description;
    }
    function getProductDescription()
    {
       return $this->product_description; 
    }
	

}

?>