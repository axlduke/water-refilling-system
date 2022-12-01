<?php
//this is the account controller
error_reporting(E_ALL & ~E_NOTICE);
class AccountController 
{
    var $con;
    function __construct() //use to initialize variables
    {
		include 'connection.php';
    }
	//cashier login
   	function Login($act)
		{
			$username = $act->getUsername();
			$password = $act->getPassword();
			$sql = "SELECT `account`.`user_id`,
					`account`.`username`,
					`account`.`password`,
					`account`.`access_level`,
					`account`.`user_id`,
					`account`.`status`,
					`cashier`.`cashier_name`,
					`cashier`.`cashier_id`
					FROM `account`,`cashier`
					WHERE `account`.`user_id`=`cashier`.`cashier_id` 
					AND account.username = '".$username."' 
					AND account.password = '".$password."'
					AND account.access_level='cashier'";			
			$result = $this->con->query($sql);			
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				while($row = $result->fetch_assoc())
				{
					$data['user_id'][$ctr] = $row['user_id'];
					$data['username'][$ctr] = $row['username'];
					$data['password'][$ctr] = $row['password'];
					$data['access_level'][$ctr] = $row['access_level'];
					$data['status'][$ctr] = $row['status'];
					$data['cashier_name'][$ctr] = $row['cashier_name'];
					
					if($data['access_level'][$ctr]=="cashier" AND $data['status'][$ctr]=="active"){
						$_SESSION['access_level']=$row['access_level'];
						$_SESSION['user_id']=$row['user_id'];
						$_SESSION['username']=$row['username'];
						$_SESSION['cashier_name']=$row['cashier_name'];
						echo "<script>alert('Successfully Login')</script>";
						echo "<meta http-equiv='refresh'content='0;url=pos.php'>";			
					}
					else{
						echo "<script>alert('Unknown Account or not Active Account!')</script>";
						echo "<meta http-equiv='refresh'content='0;url=login.php'>";						
					}
					$ctr++;		
					$data['count'] = $ctr;
				}		
				return $data;
			}
			else
			{
				echo "<script>alert('Login Failed')</script>";
		
				echo "<meta http-equiv='refresh'content='0;url=login.php'>";	
			}
			//$this->con->close();
		}
	// owner login
	function LoginOwner($actOwner)
		{
			$username = $actOwner->getUsername();
			$password = $actOwner->getPassword();
			$sql = "SELECT `account`.`account_id`,
					`account`.`user_id`,
					`account`.`username`,
					`account`.`password`,
					`account`.`status`,
					`account`.`access_level`,
					`account`.`date_added`,
					`owner`.`owner_id`,
					`owner`.`o_name`
					FROM `owner`,`account`
					WHERE `account`.`user_id`=`owner`.`owner_id`
					AND account.username = '".$username."' 
					AND account.password = '".$password."'
					AND account.access_level='admin'";			
			$result = $this->con->query($sql);			
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				while($row = $result->fetch_assoc())
				{
					$data['user_id'][$ctr] = $row['user_id'];
					$data['username'][$ctr] = $row['username'];
					$data['password'][$ctr] = $row['password'];
					$data['access_level'][$ctr] = $row['access_level'];
					$data['status'][$ctr] = $row['status'];
					$data['o_name'][$ctr] = $row['o_name'];
					
					if($data['access_level'][$ctr]=="admin" AND $data['status'][$ctr]=="active"){
						$_SESSION['access_level']=$row['access_level'];
						$_SESSION['user_id']=$row['user_id'];
						$_SESSION['account_id']=$row['account_id'];
						$_SESSION['username']=$row['username'];
						$_SESSION['o_name']=$row['o_name'];
						echo "<script>alert('Successfully Login')</script>";
						echo "<meta http-equiv='refresh'content='0;url=product/product_list.php'>";			
					}
					else{
						echo "<script>alert('Unknown Account or not Active Account!')</script>";
						echo "<meta http-equiv='refresh'content='0;url=loginOwner.php'>";						
					}
					$ctr++;		
					$data['count'] = $ctr;
				}		
				return $data;
			}
			else
			{
			  echo "<script>alert('Login Failed')</script>";
		
		      echo "<meta http-equiv='refresh'content='0;url=loginOwner.php'>";	
			}
			//$this->con->close();
		}	
   		//system admin login
	function LoginSysAdmin($actSysAdmin)
		{
			$username = $actSysAdmin->getUsername();
			$password = $actSysAdmin->getPassword();
			$sql = "SELECT `account`.`account_id`,
					`account`.`user_id`,
					`account`.`username`,
					`account`.`password`,
					`account`.`status`,
					`account`.`access_level`,
					`account`.`date_added`
					FROM `account`
					where account.username = '".$username."' 
					AND account.password = '".$password."'
					AND account.access_level='sysadmin'";			
			$result = $this->con->query($sql);			
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				while($row = $result->fetch_assoc())
				{
					$data['user_id'][$ctr] = $row['user_id'];
					$data['username'][$ctr] = $row['username'];
					$data['password'][$ctr] = $row['password'];
					$data['access_level'][$ctr] = $row['access_level'];
					$data['status'][$ctr] = $row['status'];
					
					if($data['access_level'][$ctr]=="sysadmin" AND $data['status'][$ctr]=="active"){
						$_SESSION['access_level']=$row['access_level'];
						$_SESSION['user_id']=$row['user_id'];
						$_SESSION['account_id']=$row['account_id'];
						$_SESSION['username']=$row['username'];
						
						echo "<script>alert('Successfully Login')</script>";
						echo "<meta http-equiv='refresh'content='0;url=accounts/account_list.php'>";			
					}
					else{
						echo "<script>alert('Unknown Account or not Active Account!')</script>";
						echo "<meta http-equiv='refresh'content='0;url=loginSysAdmin.php'>";						
					}
					$ctr++;		
					$data['count'] = $ctr;
				}		
				return $data;
			}
			else
			{
			  echo "<script>alert('Login Failed')</script>";
		
		      echo "<meta http-equiv='refresh'content='0;url=loginSysAdmin.php'>";	
			}
			//$this->con->close();
		}
	// add account Cashier	
	function addAccountCashier()
		{
			//echo $acc->getUserId();
			$cash_name=$_POST['cash_name'];
			$cash_bdate=$_POST['cash_bdate'];
			$sqlcheck="SELECT `cashier`.`cashier_id`,
						`cashier`.`cashier_name`,
						`cashier`.`b_date`
						FROM `cashier`
						WHERE `cashier`.`cashier_name`='$cash_name'
						AND `cashier`.`b_date`='$cash_bdate'";
			$resultcheck = $this->con->query($sqlcheck);

			if($resultcheck->num_rows < 0)
			{
				echo "<script>alert('Username and Password Already Exist!')</script>";
				echo "<meta http-equiv='refresh'content='0;url=account_list.php'>";

			}else{
				//insert cashier information
				$sqlCash = "INSERT INTO `cashier` (`cashier`.`cashier_id`, `cashier`.`cashier_name`, `cashier`.`b_date`, `cashier`.`address`)
				VALUES(NULL,'$cash_name','$cash_bdate', 'Albay')";
				$this->con->query($sqlCash);		
				$last_id =  mysqli_insert_id($this->con);	
				//insert cashier username and password
				$user_id=$last_id;
				
				$cash_name=$user_id;
				$access_level='Cashier';
				$resinfo = $cash_name."".$access_level;
				$pass = array(); //remember to declare $pass as an array
				$alphaLength = strlen($resinfo) - 1; //put the length -1 in cache
				for ($i = 0; $i < 8; $i++) {
					$n = rand(0, $alphaLength);
					$pass[] = $resinfo[$n];
				}
				$Gpassword = implode($pass); //turn the array into a string
				$_SESSION['username']=$last_id;
				$_SESSION['password']=$Gpassword;
				$_SESSION['ac_level']='cashier';
				$sqlAcct = "INSERT into account(user_id, username, password, access_level, status)
				VALUES('$user_id','$user_id','$Gpassword', 'cashier','active')";
				$this->con->query($sqlAcct);
				
				echo "<script>alert('Account Was Successfully Added')</script>";
				echo "<meta http-equiv='refresh'content='0;url=account_list_information.php'>";
				//$this->con->close();
			}				
		}
		
		//Add Owner Account
	
	function addAccountOwner()
		{
			//echo $acc->getUserId();
			echo $owner_name=$_POST['o_name'];
			$sqlcheck="SELECT `owner`.`owner_id`,
						`owner`.`o_name`
						FROM `owner`
						WHERE `owner`.`o_name`='$owner_name'";
			$resultcheck = $this->con->query($sqlcheck);

			if($resultcheck->num_rows < 0)
			{
				echo "<script>alert('Owner name Already Exist!')</script>";
				echo "<meta http-equiv='refresh'content='0;url=account_list.php'>";

			}else{
				//insert cashier information
				$sqlCash = "INSERT INTO `owner` (`owner`.`owner_id`, `owner`.`o_name`)
				VALUES(NULL,'$owner_name')";
				$this->con->query($sqlCash);		
				$last_id =  mysqli_insert_id($this->con);	
				//insert cashier username and password
				$user_id=$last_id;
				
				$own_name=$user_id;
				$access_level='Owner';
				$resinfo = $own_name."".$access_level;
				$pass = array(); //remember to declare $pass as an array
				$alphaLength = strlen($resinfo) - 1; //put the length -1 in cache
				for ($i = 0; $i < 8; $i++) {
					$n = rand(0, $alphaLength);
					$pass[] = $resinfo[$n];
				}
				$Gpassword = implode($pass); //turn the array into a string
				$_SESSION['username']=$last_id;
				$_SESSION['password']=$Gpassword;
				$_SESSION['ac_level']='owner';
				$sqlAcct = "INSERT into account(user_id, username, password, access_level, status)
				VALUES('$user_id','$user_id','$Gpassword', 'admin','active')";
				$this->con->query($sqlAcct);
				
				echo "<script>alert('Account Was Successfully Added')</script>";
				echo "<meta http-equiv='refresh'content='0;url=account_list_information.php'>";
				//$this->con->close();
			}				
		}
		
		// add account
		function addAccount($acc)
		{
			//echo $acc->getUserId();
			$sqlcheck="SELECT * FROM account
						WHERE `account`.`username`='".$acc->getUsername()."' AND `account`.`password`='".$acc->getPassword()."'";
			$resultcheck = $this->con->query($sqlcheck);

			if($resultcheck->num_rows > 0)
			{
				echo "<script>alert('Username and Password Already Exist!')</script>";
				echo "<meta http-equiv='refresh'content='0;url=account_info.php'>";

			}else{
			$sql = "INSERT into account(user_id, username, password, access_level)
				VALUES('".$acc->getUserId()."','".$acc->getUsername()."', '".$acc->getPassword()."', '".$acc->getAccessLevel()."')";
				$this->con->query($sql);
				
				echo "<script>alert('Account Was Successfully Added')</script>";
				echo "<meta http-equiv='refresh'content='0;url=account_info.php'>";
				//$this->con->close();
			}				
		}
		
	function ShowAccountList()
		{
			$sql = "SELECT `account`.`account_id`, 
					`account`.`username`,
					`account`.`password`,
					`account`.`access_level`,
					`account`.`status`
					FROM `account`
					Order by `account`.`access_level` ASC";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['account_id'][$ctr] = $row['account_id'];
					$data['username'][$ctr] = $row['username'];
					$data['password'][$ctr] = $row['password'];
					$data['access_level'][$ctr] = $row['access_level'];
					$data['status'][$ctr] = $row['status'];
					
					$ctr++;
					
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
	// show account info detailed

	function ShowAccountinfo($acct_id)
		{
			$sql = "SELECT `account`.`account_id`, 
					`account`.`username`,
					`account`.`password`,
					`account`.`access_level`,
					`account`.`status`
					FROM `account`
					WHERE `account`.`account_id`='$acct_id'";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
					$data = array();
    	        	$row = $result->fetch_assoc();            
    	  			$data['account_id'] = $row['account_id'];
					$data['username'] = $row['username'];
					$data['password'] = $row['password'];
					$data['access_level'] = $row['access_level'];
					$data['status'] = $row['status'];
				
				return $data;
			}
			
			//$this->con->close();
					
		}	
	
	function updateAccount($act)
    {
		//$a_id=$act -> getAid();
        $sqlUpd = "UPDATE account SET  ac_name='" . $act->getAcName() . "', company ='" . $act->getCompany() . "'
        ,  username = '" . $act->getUsername() . "',  password = '" . $act->getPassword() . "',  status = '" . $act->getStatus() . "',
		access_level = '" . $act->getAccessLevel() . "' WHERE a_id ='" .$act -> getAid(). "' ";
        
		$this->con->query($sqlUpd);
		
		echo "<script>alert('One Record Was Successfully Updated')</script>";
		echo "<meta http-equiv='refresh'content='0;url=Uaccounts.php'>";
        //$this->con->close();
    }
	
	function activeDeactiveAccount()
    {
		//$a_id=$act -> getAid();
		$acc_id = $_GET['acc_id'];
		$status = $_GET['stat'];
		if($status=='active'){
			$stat='not active';
		}
		else{
			$stat='active';
		}
		$sqlUpd = "UPDATE account SET  status='$stat'
					WHERE account_id ='" .$acc_id."' ";
		$this->con->query($sqlUpd);
		
		//echo "<script>alert('Status Was Successfully Updated')</script>";
		echo "<meta http-equiv='refresh'content='0;url=index_admin.php'>";
		
		
        //$this->con->close();
    }

	//change password owner
	function changePasswordOwner()
    {
		//acc_id=$_SESSION['account_id'];
		//$newPass=$_POST['newpass'];
		//$oldpass=$_POST['oldpass'];
		$account_id=$_SESSION['account_id'];
		$oldpass=$_POST['oldpass'];
		$newpass=$_POST['newpass'];
		
		$sqlcheckpass = "SELECT `account`.`account_id`, 
					`account`.`username`,
					`account`.`password`,
					`account`.`access_level`,
					`account`.`status`
					FROM `account`
					WHERE `account`.`account_id`='$account_id' AND `account`.`password`='$oldpass'";
			
			$result = $this->con->query($sqlcheckpass);
			
			if($result->num_rows > 0)
			{
				
				 $sqlUpd = "UPDATE account SET  `account`.`password`='".$newpass."'
				 WHERE `account`.`account_id` ='" .$account_id."'";
        
				$this->con->query($sqlUpd);
				
				echo "<script>alert('Password Was Successfully Updated')</script>";
				echo "<meta http-equiv='refresh'content='0;url=../product/product_list.php'>";
			}
			else{
				echo "<script>alert('old Password was incorrect, check the password try it again')</script>";
				echo "<meta http-equiv='refresh'content='0;url=../product/product_list.php'>";
				//$this->con->close();
			}
			//echo "<script>alert('nothing happened')</script>";
			//echo "<meta http-equiv='refresh'content='0;url=../product/product_list.php'>";
    }
	
	//change password System Admin
	function changePasswordSysAdmin()
    {
		//acc_id=$_SESSION['account_id'];
		//$newPass=$_POST['newpass'];
		//$oldpass=$_POST['oldpass'];
		$account_id=$_SESSION['account_id'];
		$oldpass=$_POST['oldpass'];
		$newpass=$_POST['newpass'];
		
		$sqlcheckpass = "SELECT `account`.`account_id`, 
					`account`.`username`,
					`account`.`password`,
					`account`.`access_level`,
					`account`.`status`
					FROM `account`
					WHERE `account`.`account_id`='$account_id' AND `account`.`password`='$oldpass'";
			
			$result = $this->con->query($sqlcheckpass);
			
			if($result->num_rows > 0)
			{
				
				 $sqlUpd = "UPDATE account SET  `account`.`password`='".$newpass."'
				 WHERE `account`.`account_id` ='" .$account_id."'";
        
				$this->con->query($sqlUpd);
				
				echo "<script>alert('Password Was Successfully Updated')</script>";
				echo "<meta http-equiv='refresh'content='0;url=account_list.php'>";
			}
			else{
				echo "<script>alert('old Password was incorrect, check the password try it again')</script>";
				echo "<meta http-equiv='refresh'content='0;url=account_list.php'>";
				//$this->con->close();
			}
			//echo "<script>alert('nothing happened')</script>";
			//echo "<meta http-equiv='refresh'content='0;url=../product/product_list.php'>";
    }
			
}

?>