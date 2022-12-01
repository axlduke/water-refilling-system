<?php
//this is Schedule model
class Schedule
{
    var $schedule_id;
    var $schedule_date;
    var $schedule_time;
	var $delivery_id;
    
    function __construct()
    {
        $this->schedule_id = 00000000;
        $this->schedule_date = "00:00";
        $this->schedule_time = "00:00";
        $this->delivery_id = 00000000;
    }

    //schedule_id
    function setScheduleId($schedule_id)
    {
        $this->schedule_id = $schedule_id;
    }
    function getScheduleId()
    {
       return $this->schedule_id; 
    }

    //schedule_date
    function setScheduleDate($b_date)
    {
        $this->schedule_date = $schedule_date;
    }
    function getScheduleDate()
    {
       return $this->schedule_date; 
    }
	
	 //schedule_time
    function setScheduleTime($schedule_time)
    {
        $this->schedule_time = $schedule_time;
    }
    function getScheduleTime()
    {
       return $this->schedule_time; 
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