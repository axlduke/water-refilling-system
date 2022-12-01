<?php
//this is the Maintenance controller
error_reporting(E_ALL & ~E_NOTICE);

class MaintenanceController 

{
    var $con;
    function __construct() //use to initialize variables
    {
		include 'connection.php';
    }

	// show list of maintenance report monitoring
		function ShowMaitenance()
		{
				$sql = "SELECT `maintenance`.`maintenance_id`,
						`maintenance`.`checker`,
						`maintenance`.`check_date`,
						`maintenance`.`machine_name`,
						`maintenance`.`machine_status`,
						`maintenance`.`remarks`
						FROM `maintenance`
						ORDER BY DATE(`maintenance`.`check_date`) DESC";
			
			$result = $this->con->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = array();
				$ctr = 0;
				
				while($row = $result->fetch_assoc())
				{
					$data['maintenance_id'][$ctr] = $row['maintenance_id'];
					$data['checker'][$ctr] = $row['checker'];
					$data['check_date'][$ctr] = $row['check_date'];
					$data['machine_name'][$ctr] = $row['machine_name'];
					$data['machine_status'][$ctr] = $row['machine_status'];
					$data['remarks'][$ctr] = $row['remarks'];
					
					$ctr++;	
					$data['count'] = $ctr;
				}
				
				return $data;
			}
			
			//$this->con->close();
		}
		
		
		function addMaintenanceMonitoring($mt)
		{
			
			$sqlmonitor = "INSERT into maintenance(checker, check_date, machine_name, machine_status, remarks)
				VALUES('".$mt->getChecker()."','".$mt->getCheckDate()."','".$mt->getMachineName()."','".$mt->getMachineStatus()."','".$mt->getRemarks()."')";
				$this->con->query($sqlmonitor);
				
				echo "<script>alert('New Monitoring Added!')</script>";
				echo "<meta http-equiv='refresh'content='0';url=Maintenance_list.php>";
				
				//$this->con->close();	
		}
			

}

?>