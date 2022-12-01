<?php
session_start();
unset($_SESSION['account_id']); 
unset($_SESSION['access_level']);
unset($_SESSION['status']);
unset($_SESSION['o_name']);
echo "<script>alert('Successfully Logout')</script>";
echo "<meta http-equiv='refresh'content='0;url=loginOwner.php'>";;
?>