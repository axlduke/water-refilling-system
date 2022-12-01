<?php
//this is account model
class Account
{
    var $account_id;
    var $user_id;
    var $username;
    var $password;
    var $access_level;
    
    function __construct()
    {
        $this->account_id = 00000001;
        $this->user_id = 000000001;
        $this->username = "@123";
        $this->password = "@00000000@";
        $this->access_level = "@admin";
        $this->status = "active";  
    }

    //setter or mutator
    //account_id
    function setAccountId($account_id)
    {
        $this->account_id = $account_id;
    }
    //getter or accessor
    function getAccountId()
    {
       return $this->account_id; 
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
    //username
    function setUsername($username)
    {
        $this->username = $username;
    }
    function getUsername()
    {
       return $this->username; 
    }
    //upass
    function setPassword($password)
    {
        $this->password = $password;
    }
    function getPassword()
    {
       return $this->password; 
    }
    //access_level
    function setAccessLevel($access_level)
    {
        $this->access_level = $access_level;
    }
    function getAccessLevel()
    {
       return $this->access_level; 
    }
}

?>