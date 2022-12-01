<?php
//this is Transaction model
class Transaction
{
    var $csales_id;
	var $trans_no;
	var $csales_total;
	var $sales_status;
	var $customer_id;
	var $cashier_id;
	var $sales_invoice;
	var $date_sales;
	var $del_status;
	var $remarks;
	var $date_del;
        
    function __construct()
    {
        $this->csales_id = 1;
		$this->trans_no=1;
        $this->csales_total=1;
        $this->sales_status="";
        $this->customer_id = 1;
		$this->cashier_id = 1;
		$this->sales_invoice=1;
		$this->date_sales="0000-00-00";
		$this->del_status="other";
		$this->remarks="-";
		$this->date_del="0000-00-00";
    }

    //csales_id
    function setCSalesId($csales_id)
    {
        $this->csales_id = $csales_id;
    }
    function getCSalesId()
    {
        return $this->csales_id;
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
    //setter or mutator
    //csales_total
    function setCSalesTotal($csales_total)
    {
        $this->csales_total = $csales_total;
    }
    //getter or accessor
    function getCSalesTotal()
    {
       return $this->csales_total; 
    }
    //sales_status
    function setSalesStatus($sales_status)
    {
        $this->sales_status = $sales_status;
    }
    //getter or accessor
    function getSalesStatus()
    {
       return $this->sales_status; 
    }

	//customer_id
    function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }
    function getCustomerId()
    {
       return $this->customer_id; 
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
	
	//sales_invoice
    function setSalesInvoice($sales_invoice)
    {
        $this->sales_invoice = $sales_invoice;
    }
    function getSalesInvoice()
    {
       return $this->sales_invoice; 
    }
	//date_sales
    function setDateSales($date_sales)
    {
        $this->date_sales = $date_sales;
    }
    function getDateSales()
    {
       return $this->date_sales; 
    }
	//del_status
    function setDelStatus($del_status)
    {
        $this->del_status = $del_status;
    }
    function getDelStatus()
    {
       return $this->del_status; 
    }
	//remarks
    function setRemarks($remarks)
    {
        $this->remarks = $remarks;
    }
    function getRemarks()
    {
       return $this->remarks; 
    }
	//date_del
    function setDateDel($date_del)
    {
        $this->date_del = $date_del;
    }
    function getDateDel()
    {
       return $this->date_del; 
    }

}

?>