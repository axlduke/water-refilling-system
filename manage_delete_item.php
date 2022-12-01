<?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  if($_SESSION['access_level']!='cashier'){
    echo "<meta http-equiv='refresh'content='0;url=login.php'>";
  }
  else{	  
  include("Controller/SalesController.php");
  include("Controller/TransactionController.php");
  include("Model/Sales.php");
  include("Model/Transaction.php");
  
  
  $salesCon = new SalesController();
  $transCon = new TransactionController();
  $sales_id=$_GET['sid'];
  $data = $salesCon->ShowSalesDetailedPOS($sales_id);
  
  /*$trans= new Transaction();
		if(isset($_POST['updatesalesdel'])){
			$trans->setTransNo($_POST['tid']);
			$trans->setRemarks($_POST['remarks']);
			$trans->setDelStatus($_POST['delstatus']);
			$transCon->updateSalesDelivery($trans);
			
			
		}
		*/
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

    <title>TPS Delete Item</title>
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
			include "tps_water_sidebar.php";
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
							<h1 class="h3 mb-2 text-gray-800">Removing Item From Sales <img src='img/jc_living_logo.png' width='60px' height='40px' style="border-radius: 10%"></h1>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Cashier - <b style='color:red'><?php echo strtoupper($_SESSION['cashier_name']);?></b> </span>
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
                <div class="container-fluid">
                    

    <div class="card card-register mx-auto mt-2">
      <div class="card-header">Delete Item from Sales</div>
      <div class="card-body">
        <form action="deletePOS.php" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
				  <label for="pid1">Transaction ID</label>
				  <input type="text" id="tid1" name="tid1" class="form-control" placeholder="Transaction ID" required="required" value="<?php echo $data['trans_no'];?>" disabled>
				  <input type="hidden" name="sales_id" value="<?php echo $data['sales_id'];?>">
                </div>
              </div>
			  <div class="col-md-8">
                <div class="form-label-group">
				  <label for="tamount">Total</label>
				  <input type="text" id="tamount" name="tamount" class="form-control" placeholder="Transaction Amount" required="required" value="<?php echo $data['sales_total'];?>" disabled>
				
                </div>
              </div>
            </div>
          </div>
		   <div class="form-group">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
				  <label for="pid1">QTY</label>
				  <input type="text" id="tid1" name="tid1" class="form-control" placeholder="Transaction ID" required="required" value="<?php echo $data['no_item'];?>" disabled>
				  <input type="hidden" name="tid" value="<?php echo $data['no_item'];?>">
                </div>
              </div>
			  <div class="col-md-4">
                <div class="form-label-group">
				  <label for="tamount">Product Description</label>
				  <input type="text" id="tamount" name="tamount" class="form-control" placeholder="Transaction Amount" required="required" value="<?php echo $data['product_description'];?>" disabled>
				
                </div>
              </div>
			  <div class="col-md-4">
                <div class="form-label-group">
				  <label for="tamount">Product Price</label>
				  <input type="text" id="tamount" name="tamount" class="form-control" placeholder="Transaction Amount" required="required" value="<?php echo $data['product_price'];?>" disabled>
				
                </div>
              </div>
			  
            </div>
          </div>
		   <center><label for="remarks"><strong>Enter Username and Password</strong></label></center>
          <div class="form-group">
            <div class="form-label-group">
              <label for="uname">Username</label>
			  <input type="text" id="uname" name="uname" class="form-control" placeholder="enter Username . . ." required="required" value="">
              
            </div>
          </div>
		  <div class="form-group">
            <div class="form-label-group">
              <label for="upass">Password</label>
			  <input type="password" id="upass" name="upass" class="form-control" placeholder="enter Password . . ." required="required" value="">
              
            </div>
          </div>
         
		  <div class="form-group">
            <div class="form-label-group">
              
              
            </div>
          </div>
          <input type="submit" class="btn btn-primary btn-block" value="Remove Item now!" name="deletesalesitem">
          <a class="btn btn-danger btn-block" href="pos.php">Cancel</a>
        </form>
        <div class="text-center">
        </div>
      </div>
    </div>
  </div>
  </div>
  

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
				<?php
					//include "tps_water_footer.php";
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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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