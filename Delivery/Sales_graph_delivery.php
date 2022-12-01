<?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  if($_SESSION['access_level']!='admin'){
    echo "<meta http-equiv='refresh'content='0;url=../loginowner.php'>";
  }
  else{	  
  include("../Controller/TransactionController.php");
  include("../Model/Transaction.php");
  
  $transCon = new TransactionController();
  $data = $transCon->ShowSalesTotalPickup(); 
  //$data1= $transCon->ShowSalesTotalTransMD($monthT);
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

    <title>TPS Sales Graph Report - <?php echo date("Y");?></title>
	<link rel="icon" type="image/png" href="../img/logo_jc_livingwater.png">

    <!-- Custom fonts for this template -->
    <link href="tps_water_design/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="fontFamily.css"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="tps_water_design/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="tps_water_design/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<script>
		<!--
		function timedRefresh(timeoutPeriod) {
			setTimeout("location.reload(true);",timeoutPeriod);
		}

		window.onload = timedRefresh(30000);

		//   -->
	</script>

	<script type="text/javascript" src="../graph/jquery.js"></script>
		<script type="text/javascript">
$(function () {
    // On document ready, call visualize on the datatable.
    $(document).ready(function() {

        Highcharts.visualize = function(table, options) {
            // the categories
            options.xAxis.categories = [];
            $('tbody th', table).each( function(i) {
                options.xAxis.categories.push(this.innerHTML);
            });
    
            // the data series
            options.series = [];
            $('tr', table).each( function(i) {
                var tr = this;
                $('th, td', tr).each( function(j) {
                    if (j > 0) { // skip first column
                        if (i == 0) { // get the name and init the series
                            options.series[j - 1] = {
                                name: this.innerHTML,
                                data: []
                            };
                        } else { // add values
                            options.series[j - 1].data.push(parseFloat(this.innerHTML));
                        }
                    }
                });
            });
    
            var chart = new Highcharts.Chart(options);
        }
    
        var table = document.getElementById('datatable'),
        options = {
            chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'Sales report: Delivery over Pickup Year <?php echo date("Y");?>'
            },
			
            xAxis: {
            },
            yAxis: {
                title: {
                    text: 'Total Sales'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                         this.x.toUpperCase() +': Php '+ this.y;
                }
            },
			
        };
    
        Highcharts.visualize(table, options);
    });
    
});
		</script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" >

        <!-- Sidebar -->
        <?php
			include "tps_water_sidebar_delivery.php";
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
							 <h1 class="h3 mb-2 text-gray-800">Delivery Sales Graph Report <img src='delivery_logo.png' width='50px' height='50px' style="border-radius: 50%"></h1>
							
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
                    <p class="mb-4">Sales Delivery Graph Report consist of detailed sales information  of the TPS JC Living Water. </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"> Sales Delivery Report (Graph Representation)
							<button onclick="toggle(this);" class="btn btn-warning" type="button" >Show table</button>

						<script>
						  let toggle = button => {
							let element = document.getElementById("datatable");
							let hidden = element.getAttribute("hidden");

							if (hidden) {
							   element.removeAttribute("hidden");
							   button.innerText = "Hide table";
							} else {
							   element.setAttribute("hidden", "hidden");
							   button.innerText = "Show table";
							}
						  }
						</script>
						</h6>
                        </div>
                       

					   <div class="card-body">
                            <div class="table-responsive">
                                
								<script src="../graph/highcharts.js"></script>
								<script src="../graph/exporting.js"></script>

							
						<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto">
						</div>

						
							
								<table id="datatable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0" hidden=hidden> 
									<thead>
										<tr style="color:black; background-color:#DCDCDC">
											<th>Month</th>
											<th>Pick-up Sales</th>
											<th>Delivery Sales</th>
										</tr>
									</thead>
									<tbody>
										<?php
												for($ctr=0;$ctr<$data['count'];$ctr++)
												  {
												  $no=$ctr+1;
												  echo "
												  <tr>";
												  $month_num =$data['s_month'][$ctr];
													// Use mktime() and date() function to
													// convert number to month name
													$month_name = date("F", mktime(0, 0, 0, $month_num, 10));
													// Display month name
													//echo $month_name;
												  echo "<th>".$month_name."</th>";
												  
												  echo "<td>".number_format($data['pickup_sales'][$ctr],2)."</td>";
												  echo "<td>".number_format($data['delivery_sales'][$ctr],2)."</td>";
												  //$data1 = $transCon->ShowSalesTotalDelivery($month_num);
												 
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