<?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  if($_SESSION['access_level']!='admin'){
    echo "<meta http-equiv='refresh'content='0;url=loginOwner.php'>";
  }
  else{	  
  include("../Controller/DeliveryController.php");
  include("../Controller/TransactionController.php");
  include("../Model/Delivery.php");
  include("../Model/Transaction.php");
  
  
  $delCon = new DeliveryController();
  $transCon = new TransactionController();
  $trans_no=$_GET['trans_no'];
  $data = $delCon->ShowTransDeliveryDetailed($trans_no);
  
  $trans= new Transaction();
		if(isset($_POST['updatesalesdel'])){
			$trans->setTransNo($_POST['tid']);
			$trans->setRemarks($_POST['remarks']);
			$trans->setDelStatus($_POST['delstatus']);
			$transCon->updateSalesDelivery($trans);
			
			
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

    <title>TPS Product List</title>
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
			include "tps_water_sidebar_delivery_only.php";
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
							<h1 class="h3 mb-2 text-gray-800">Manage Sales Delivery  <img src='delivery_logo.png' width='40px' height='40px' style="border-radius: 50%"></h1>
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
                    <!-- DataTales Example -->

    <div class="card card-register mx-auto mt-6">
      <div class="card-header">Manage Sales Delivery</div>
      <div class="card-body">
        <form action="manage_delivery.php" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
				  <label for="pid1">Transaction ID</label>
				  <input type="text" id="tid1" name="tid1" class="form-control" placeholder="Transaction ID" required="required" value="<?php echo $data['trans_no'];?>" disabled>
				  <input type="hidden" name="tid" value="<?php echo $data['trans_no'];?>">
                </div>
              </div>
			  <div class="col-md-9">
                <div class="form-label-group">
				  <label for="tamount">Total Amount</label>
				  <input type="text" id="tamount" name="tamount" class="form-control" placeholder="Transaction Amount" required="required" value="<?php echo $data['transaction_sales'];?>" disabled>
				
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <label for="remarks">remarks</label>
			  <input type="text" id="remarks" name="remarks" class="form-control" placeholder="Update Remarks . . ." required="required" value="<?php echo $data['remarks'];?>">
              
            </div>
          </div>
		  <div class="form-group">
            <div class="form-label-group">
              <label for="datedel">Date</label>
			  <input type="date" id="datedel" name="datedel" class="form-control" placeholder="Update Remarks . . ." required="required" value="<?php echo $data['s_date'];?>">
              
            </div>
          </div>
         
		  <div class="form-group">
            <div class="form-label-group">
              <label for="delstatus">Status</label>
			  
			  <select name="delstatus" id="delstatus" class="form-control" required="required">
			  <option value="<?php echo $data['del_stat'];?>"><?php echo $data['del_stat'];?></option>
			  <option value="Delivered">Delivered</option>
			  <option value="Cancelled">Cancelled</option>
			  
			  </select>
              
            </div>
          </div>
          <input type="submit" class="btn btn-primary btn-block" value="Update Sales Delivery" name="updatesalesdel">
          <a class="btn btn-danger btn-block" href="delivery_list.php">Cancel</a>
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
                    <a class="btn btn-primary" href="../logoutOwner.php">Logout</a>
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