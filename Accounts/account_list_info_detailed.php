<?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  if($_SESSION['access_level']!='sysadmin'){
    echo "<meta http-equiv='refresh'content='0;url=loginsysadmin.php'>";
  }
  else{	  
  include("../Controller/AccountController.php");
 
  $acctCon = new AccountController();
  $acct_id=$_GET['acct_id'];
  $data = $acctCon->ShowAccountinfo($acct_id); 
  
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

    <title>TPS Account Info</title>
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
			include "tps_water_sidebar_account_cpass.php";
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
                    
                        <div class="input-group">
                            <!-- set label here for Owner Account -->
							<h1 class="h3 mb-2 text-gray-800">Detailed Account Information  <img src='../img/uaccount_logo.png' width='50px' height='50px' style="border-radius: 50%"></h1>
                   

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
                    <!-- DataTales Example -->

    <div class="card card-register mx-auto mt-6">
      <div class="card-header">Detailed Account Information</div>
      <div class="card-body">
        <form action="product_infoEdit.php" method="POST">
          
		  <div class="form-group">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
				  <label for="pid1">Account ID: </label>
				 <label><b style='color:blue'> <?php echo $data['account_id'];?></b>
                </div>
              </div>
			  
            </div>
          </div><div class="form-group">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
				  <label for="pid1">Username: </label>
				 <label><b style='color:blue'> <?php echo $data['username'];?></b>
                </div>
              </div>
			  
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <label for="pname">Password: </label>
			 <label><b style='color:blue'> <?php echo $data['password'];?></b>
              
            </div>
          </div>
		  <div class="form-group">
            <div class="form-label-group">
              <label for="pname">Access Level: </label>
			 <label><b style='color:blue'> <?php echo $data['access_level'];?></b>
              
            </div>
          </div>
		   
          
          <a class="btn btn-danger btn-block" href="account_list.php">Back to Account list</a>
        </form>
        <div class="text-center">
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
	
	<!-- add product Modal --> 
  <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Product Information</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
		<form method="POST" action="product_list.php">
        <div class="modal-body">
		 <div class="form-label-group">
			<div class="form-label-group">Complete the Information to Add Product<br/><br/></div>
			</div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="prod_name"><b>Product name</b></label><input type="text" id="prod_name" class="form-control" placeholder="Enter product name . . ." required="required" autofocus="autofocus" name="prod_name">
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="prod_desc"><b>Product description</b></label>
			  <input type="text" id="prod_desc" class="form-control" placeholder="Enter product description . . ." required="required"  name="prod_desc">
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="prod_price"><b>Product price</b></label>
			  <input type="text" id="prod_price" class="form-control" placeholder="Enter Product price . . ." required="required"  name="prod_price">
              
            </div>
         </div>
		 
		 <div class="form-group">
            <div class="form-label-group">
               <label for="prod_type"><b>Product type</b></label>
			   <select name="prod_type" id="prod_type" class="form-control" required="required">
			  <option value="">Select Product type ...</option>
			  <option value="With Bottle">With Bottle</option>
			  <option value="Refill">Refill</option>
			  <option value="others">Others</option>
			 
			  </select>
             
            </div>
		<br>	
         </div>
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		  <input type="submit" value="add Product" name="addprod" class="btn btn-primary" >
         
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
                    <a class="btn btn-primary" href="../logoutSysAdmin.php">Logout</a>
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