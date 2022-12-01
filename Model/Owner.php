<?php
//this is Owner model
class Owner
{
    var $owner_id;
    var $o_name;
    
    function __construct()
    {
        $this->owner_id = 00000001;
        $this->o_name = "@oname";
    }

    //owner_id
    function setOwnerId($owner_id)
    {
        $this->owner_id = $owner_id;
    }
    function getOwnerId()
    {
       return $this->owner_id; 
    }

    //o_name
    function setOName($o_name)
    {
        $this->o_name = $o_name;
    }
    function getOName()
    {
       return $this->o_name; 
    }

}

?>