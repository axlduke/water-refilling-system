<?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  if($_SESSION['access_level']!='sysadmin'){
    echo "<meta http-equiv='refresh'content='0;url=loginSysadmin.php'>";
  }
  else{	  
  include("../Controller/AccountController.php");
  include("../Model/Account.php");
  
  $acctCon = new AccountController();
  $data = $acctCon->ShowAccountList(); 
  		if(isset($_POST['addCashAcct'])){
			$cash_name=$_POST['cash_name'];
			$cash_bdate=$_POST['cash_bdate'];
			$access_level='cashier';
			$acctCon->addAccountCashier();
		}
		
		if(isset($_POST['addOwnerAcct'])){
			$o_name=$_POST['o_name'];
			$access_level='owner';
			$acctCon->addAccountOwner();
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

    <title>TPS User Account List</title>
	<link rel="icon" type="image/png" href="../img/jc_living_logo.png">

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
			include "tps_water_sidebar_account.php";
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
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <!-- set label here for Owner Account -->
							<h1 class="h3 mb-2 text-gray-800">User Account Information  <img src='../img/uaccount_logo.png' width='50px' height='50px' style="border-radius: 50%"></h1>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                      

                        <!-- Nav Item - Messages -->
                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">SysAdmin - <b style='color:red'><?php echo strtoupper($_SESSION['user_id']);?></b> </span>
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
                    <p class="mb-4">User Account Information of the TPS JC Living Water. </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Account Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Access Level</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                  
										<?php
										for($ctr=0;$ctr<$data['count'];$ctr++)
										  {
										  $no=$ctr+1;
										  echo "
										  <tr>
										  <td>".$no."</td>
										  <td>".$data['username'][$ctr]."</td>";
										  if ($data['access_level'][$ctr]=='sysadmin'){
												echo "<td><b style='color:blue'>".strtoupper($data['access_level'][$ctr])."</b></td>";
											}
											else{
												echo "<td>".$data['access_level'][$ctr]."</td>";
											}
										  echo "<td>".$data['status'][$ctr]."</td>
										  <td>";
										  if ($data['access_level'][$ctr]=='sysadmin'){
											  echo "<b style='color:red'>System Admin Account</b></td>";}
										  else{
											  echo "<a href='account_list_info_detailed.php?acct_id=".$data['account_id'][$ctr]."'>View info</a></td>";
										  }
										  
										  echo "</tr>";
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
	
	<!-- add Cashier Modal --> 
  <div class="modal fade" id="addCashierModal" tabindex="-1" role="dialog" aria-labelledby="cashierModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cashierModalLabel">Add New Cashier User Account </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
		<form method="POST" action="account_list.php">
        <div class="modal-body">
		 <div class="form-label-group">
			<div class="form-label-group">Complete the Information to Add User Account<br/><br/></div>
			</div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="cash_name">Full Name</label>
			  <input type="text" id="cash_name" class="form-control" placeholder="Full name" required="required" autofocus="autofocus" name="cash_name">
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="cash_bdate">Birthdate</label>
			  <input type="date" id="cash_bdate" class="form-control" placeholder="Birthdate" required="required" autofocus="autofocus" name="cash_bdate">
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="access_level">Access Level</label>
			  <input type="text" id="access_level" class="form-control" placeholder="Cashier" required="required"  name="access_level" value="Cashier" disabled>
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="uname">Username and Password</label>
			  <input type="text" id="uname" class="form-control" placeholder="Auto-generated" required="required"  name="uname" disabled>
              
            </div>
         </div>
		 
		 <div class="form-group">
            <div class="form-label-group">
              <label for="date_added">Date Added</label>
			  <input type="text" id="date_added" class="form-control" placeholder="Auto-generated " required="required"  name="date_added" disabled value="<?php echo date("Y-m-d");?>">
              
            </div>
         </div>
		<div class="form-group">    
         </div>
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		  <input type="submit" value="add Account" name="addCashAcct" class="btn btn-primary" >
         
        </div>
		</form>
      </div>
    </div>
  </div>
  
  <!-- add Owner Modal --> 
  <div class="modal fade" id="addOwnerModal" tabindex="-1" role="dialog" aria-labelledby="ownerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ownerModalLabel">Add New Owner User Account </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
		<form method="POST" action="account_list.php">
        <div class="modal-body">
		 <div class="form-label-group">
			<div class="form-label-group">Complete the Information to Add Owner User Account<br/><br/></div>
			</div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="o_name">Full Name</label>
			  <input type="text" id="o-name" class="form-control" placeholder="Full name" required="required" autofocus="autofocus" name="o_name">
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="pprice">Access Level</label>
			  <input type="text" id="pprice" class="form-control" placeholder="Cashier" required="required"  name="prod_desc" value="Admin/Owner" disabled>
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="Username">Username</label>
			  <input type="text" id="Username" class="form-control" placeholder="Auto-generated" required="required"  name="prod_unit" disabled>
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="pdesc">Password</label>
			  <input type="text" id="pdesc" class="form-control" placeholder="Auto-generated " required="required"  name="prod_cat" disabled>
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="pdesc">Date Added</label>
			  <input type="text" id="pdesc" class="form-control" placeholder="Auto-generated " required="required"  name="prod_cat" disabled value="<?php echo date("Y-m-d");?>">
              
            </div>
         </div>
		<div class="form-group">    
         </div>
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		  <input type="submit" value="add Owner Account" name="addOwnerAcct" class="btn btn-primary" >
         
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
                    <a class="btn btn-primary" href="../logoutsysadmin.php">Logout</a>
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