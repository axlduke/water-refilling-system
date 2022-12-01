<?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  if($_SESSION['access_level']!='admin'){
    echo "<meta http-equiv='refresh'content='0;url=../loginowner.php'>";
  }
  else{	  
  include("../Controller/TransactionController.php");
  include("../Model/Transaction.php");
  $monthT=$_GET['monthT'];
  $transCon = new transactionController();
  $data = $transCon->ShowSalesTotalTransMD($monthT); 
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

    <title>TPS Sales Report (Monthly-Detailed)</title>
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
			include "tps_water_sidebar_sales.php";
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
							 <h1 class="h3 mb-2 text-gray-800">Sales (Monthly-Detailed) <img src='report_sales.png' width='50px' height='50px' style="border-radius: 50%"></h1>
							
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

                    <!-- Page Heading -->
                    <p class="mb-4">Sales Report consist of detailed sales information  of the TPS JC Living Water. </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Month of :
								
								<?php
								// PHP program to convert number to month name
								// Declare month number and initialize it
								$month_num =$monthT;
								// Use mktime() and date() function to
								// convert number to month name
								$month_name = date("F", mktime(0, 0, 0, $month_num, 10));
								// Display month name
								echo $month_name;
								?>
							</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                                    <thead>
                                        <tr>
											<th>Transaction #</th>
											<th>Total Amount</th>
                                            <th>Date</th>
                                            <th>Cashier info</th>
											<th>Action</th>
											
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody style="font-size: 14px;">
                  
										<?php
										for($ctr=0;$ctr<$data['count'];$ctr++)
										  {
										  $no=$ctr+1;
										  echo "
										  <tr>
										  <td>".$data['trans_no'][$ctr]."</td>
										  <td> &#8369 ".number_format($data['transaction_sales'][$ctr],2)."</td>
										  <td>".$data['s_date'][$ctr]."</td>
										  <td>".$data['cashier_info'][$ctr]."</td>
										  <td><a href='sales_list-detailed.php?trans_no=".$data['trans_no'][$ctr]."'><i class='fas fa-fw fa-table'></i> View Detailed sales</a></td>
										  
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