<?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  if($_SESSION['access_level']!='admin'){
    echo "<meta http-equiv='refresh'content='0;url=loginOwner.php'>";
  }
  else{	  
  include("../Controller/StocksController.php");
  //include("../Model/Stocks.php");
  
  $stCon = new StocksController();
  $data = $stCon->ShowStocks(); 
  if(isset($_POST['addstock'])){
			$s_name=$_POST['s_name'];
			$s_description=$_POST['s_description'];
			$s_price=$_POST['s_price'];
			$s_unit=$_POST['s_unit'];
			$stCon->addstocks();
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

    <title>Stocks Inventory Report</title>
	<link rel="icon" type="image/png" href="../img/jc_living_logo.jpg">

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
			include "tps_water_sidebar_inventory.php";
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
							<h1 class="h3 mb-2 text-gray-800">Stocks Inventory Information  <img src='inventory_logo.png' width='80px' height='70px' style="border-radius: 50%"></h1>
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
                    <p class="mb-4">Stocks Inventory consist of detailed information about the stocks of the TPS JC Living Water. </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Stocks Inventory Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                                    <thead>
                                        <tr>
                                            <th>Stock Code</th>
                                            <th>Description</th>
                                            <th>Unit</th>
                                            <th>Recent Stocks Delivery</th>
											<th>Last Date of Delivery</th>
											<th>Available Stocks</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                  
										<?php
										for($ctr=0;$ctr<$data['count'];$ctr++)
										  {
										  $no=$ctr+1;
										  echo "
										  <tr>
										  <td>".$data['stocks_id'][$ctr]."</td>
										  <td>".$data['s_description'][$ctr]."</td>
										  <td>".$data['s_unit'][$ctr]."</td>
										  <td>".$data['s_qty'][$ctr]."</td>
										  <td>".$data['mdate'][$ctr]."</td>
										  <td>".$data['s_qty'][$ctr]."</td>
										
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

   <!-- add stocks Modal --> 
  <div class="modal fade" id="addStocksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Stock Information</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
		<form method="POST" action="inventory_list.php">
        <div class="modal-body">
		 <div class="form-label-group">
			<div class="form-label-group">Complete the Information to Add Stock<br/><br/></div>
			</div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="s_name"><b>Stock name</b></label><input type="text" id="s_name" class="form-control" placeholder="Enter stock name . . ." required="required" autofocus="autofocus" name="s_name">
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="s_description"><b>Stock description</b></label>
			  <input type="text" id="s_description" class="form-control" placeholder="Enter stock description . . ." required="required"  name="s_description">
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <label for="s_price"><b>Stock price</b></label>
			  <input type="text" id="s_price" class="form-control" placeholder="Enter Stock price . . ." required="required"  name="s_price">
              
            </div>
         </div>
		 
		 <div class="form-group">
            <div class="form-label-group">
               <label for="s_unit"><b>Stock unit</b></label>
			   <select name="s_unit" id="s_unit" class="form-control" required="required">
			  <option value="">Select Stock unit ...</option>
			  <option value="Liter">liter</option>
			  <option value="Galon">Galon</option>
			  <option value="Jag">Jag</option>
			  <option value="others">Others</option>
			 
			  </select>
             
            </div>
		<br>	
         </div>
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		  <input type="submit" value="add New Stock" name="addstock" class="btn btn-primary" >
         
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