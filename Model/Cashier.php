<?php
//this is Cashier model
class Cashier
{
    var $cashier_id;
    var $b_date;
    var $address;
	var $cashier_name;
    
    function __construct()
    {
        $this->cashier_id = 00000001;
        $this->b_date = 000000001;
        $this->cashier_name = "@123";
        $this->address = "@00000000@";
    }

    //account_id
    function setAccountId($account_id)
    {
        $this->account_id = $account_id;
    }
    function getAccountId()
    {
       return $this->account_id; 
    }

    //b_date
    function setBDate($b_date)
    {
        $this->b_date = $b_date;
    }
    function getBDate()
    {
       return $this->b_date; 
    }

}

?>