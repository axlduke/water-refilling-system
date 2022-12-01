<?php
//this is Delivery model
class Delivery
{
    var $delivery_id;
    var $schedule_id;
    var $sales_id;
	var $amount;
	var $customer;
	var $location;
    
    function __construct()
    {
        $this->delivery_id = 00000001;
        $this->schedule_id = 000000001;
        $this->sales_id = 000000001;
        $this->amount = 0.00;
		$this->customer = "@00000000@";
		$this->location = "@00000000@";
    }

    //delivery_id
    function setDeliveryId($delivery_id)
    {
        $this->delivery_id = $delivery_id;
    }
    function getDeliveryId()
    {
       return $this->delivery_id; 
    }


}

?>