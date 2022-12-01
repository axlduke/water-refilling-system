<?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  if($_SESSION['access_level']!='admin'){
    echo "<meta http-equiv='refresh'content='0;url=loginOwner.php'>";
  }
  else{	  
  include("../Controller/MaintenanceController.php");
  include("../Model/maintenance.php");
  
  $mtCon = new MaintenanceController();
  $data = $mtCon->ShowMaitenance(); 
  
  $mt= new Maintenance();
		if(isset($_POST['addmonitor'])){
			$mt->setMachineName($_POST['mname']);
			$mt->setChecker($_POST['checker']);
			$mt->setCheckDate($_POST['cdate']);
			$mt->setMachineStatus($_POST['mstat']);
			$mt->setRemarks($_POST['remarks']);
			$mtCon->addMaintenanceMonitoring($mt);
		}
  }        
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TPS Maintenance Monitoring</title>
	<link rel="icon" type="image/png" href="../img/logo_jc_livingwater.png">

    <!-- Custom fonts for this template -->
    <link href="tps_water_design/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="tps_water_design/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="tps_water_design/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" >

        <!-- Sidebar -->
        <?php
			include "tps_water_sidebar_maintenance.php";
		?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
            <div id="content" style="background-image: url('bg_image.png');background-size: cover">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-2">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Page title caption -->
                   
                        <div class="input-group">
                            <!-- set label here for Owner Account -->
							<h1 class="h3 mb-2 text-gray-800">Maintenance Monitoring  Report <img src='maintenance_logo.png'  height='30px' style="border-radius: 35%"></h1>
                        </div>
                   

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                      

                        <!-- Nav Item - Messages -->
                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Owner - <b style='color:red'><?php echo strtoupper($_SESSION['o_name']);?></b> </span>
                                <img class="img-profile rounded-circle"
                                    src="tps_water_design/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" ">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">TPS JC LIVING WATER</h1>
                    <p class="mb-4">Maintenance Monitoring consist of detailed monitoring information about the machines of the TPS JC Living Water. </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Maitenance Report Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
											<th>Date</th>
                                            <th>Machine</th>
                                            <th>Status</th>
                                            <th>Checker</th>
											<th>Remarks</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                  
										<?php
										for($ctr=0;$ctr<$data['count'];$ctr++)
										  {
										  $no=$ctr+1;
										  echo "
										  <tr>
										  <td>".$data['maintenance_id'][$ctr]."</td>
										  <td>".$data['check_date'][$ctr]."</td>
										  <td>".$data['machine_name'][$ctr]."</td>
										  <td>".$data['machine_status'][$ctr]."</td>
										  <td>".$data['checker'][$ctr]."</td>
										  <td>".$data['remarks'][$ctr]."</td>
										  </tr>";
										  }
										?>
									  
									  
									</tbody>
                                </table>
                            </div>
							 
                        </div>
							
                    </div>
							
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
				<?php
					include "tps_water_footer.php";
				?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
		<!-- add monitoring Modal --> 
  <div class="modal fade" id="addMonitorModal" tabindex="-1" role="dialog" aria-labelledby="monitorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="monitorModalLabel">Add Monitoring now!</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
		<form method="POST" action="maintenance_list.php">
        <div class="modal-body">
		 <div class="form-label-group">
			<div class="form-label-group">Complete the Information to Add Monitoring<br/><br/></div>
			</div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="mname"><b>Machine name</b></label><input type="text" id="prod_name" class="form-control" placeholder="Enter machine name . . ." required="required" autofocus="autofocus" name="mname">
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="checker"><b>Checker</b></label>
			  <input type="text" id="prod_desc" class="form-control" placeholder="Enter checker . . ." required="required"  name="checker">
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="cdate"><b>Date </b></label>
			  <input type="date" id="cdate" class="form-control" placeholder="Enter Product price . . ." required="required"  name="cdate" value="<?php echo date("Y-m-d");?>">
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="remarks"><b>Remarks </b></label>
			  <input type="text" id="remarks" class="form-control" placeholder="Enter remarks" required="required"  name="remarks">
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="mstat"><b>Status </b></label>
			  <select name="mstat" id="mstat" class="form-control" required="required">
			  <option value="">Select Status ...</option>
			  <option value="Good Condition">Good Condition</option>
			  <option value="Under Maitenance">Under Maitenance</option>
			  <option value="for replacement">for replacement</option>
              </select>
            </div>
         </div>
		 
		<br>	
         
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		  <input type="submit" value="add Monitoring now!" name="addmonitor" class="btn btn-primary" >
         
        </div>
		</form>
      </div>
    </div>
  </div>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../loginOwner.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
   <?php
		include "tps_water_js.php";
   ?>

</body>

</html>