<?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  require "pos_script.php";       
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TPS JC Living Water - Sales</title>

  <link rel="icon" type="image/png" href="img/jc_living_logo.jpg">
  <link href="tps_water_design/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="tps_water_design/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="tps_water_design/css/sb-admin.css" rel="stylesheet">
  <script>
  </script>
  <?php include "time.php";?>

</head>
<body id="page-top" onload="startTime()">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="pos.php"> <img src="tps_water_design/img/jc_living_logo.jpg" width="30px" height="30px" style="border-radius:50%"> JC LIVING WATER - SALES System</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0">
      <i class="fas"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
		
	  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Welcome, Cashier <b style='color:red'><?php echo strtoupper($_SESSION['cashier_name']);?></b>  <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"> <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav" style="background-image: url('adminBG.jpg');background-repeat: no-repeat; background-size: cover; ">
      <li class="nav-item">
        <a class="nav-link">
          <span>
		  <div class="row">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5"><div class="mr-5"><img src="img/jc_living_logo.jpg" width="170px" height="170px" style="border-radius:50%"></div>
				</div>
				<br/>
				<hr>
				<p style="text-align:center"><b ><u>P</u></b>oint <b><u>O</u></b>f <b><u>S</u></b>ales</p>
              </div>
              <a class="card-footer text-white clearfix small z-1">
			  Current Date: <b align="center"><?php echo date('Y-M-d');?></b><br/>
			  Cashier ID: <b align="center"><?php echo $_SESSION["user_id"];?></b><br/>
			  Current Time: <b id="txt"></b>
              </a>
          </div>
          </span>
		</a>
      </li>
     
    </ul>

    <div id="content-wrapper" style="background-image: url('bg_image.png');background-size: cover">

      <div class="container-fluid">

        <div class="card mb-3" >
          <div class="card-header">
            <i class="fas fa-table"></i>
            Sales Transaction # <b> <?php echo $datatc['trCount']+1; ?></b>
			<p></p> 
			<input type="submit" class="btn btn-primary" value="Add Item to Sales" data-toggle="modal" data-target="#addItemModal">
			<?php 
			if($data['salesTotal']!=""){ 
			echo "<input type='submit' class='btn btn-danger' value='Total and Finish Transaction' data-toggle='modal' data-target='#completeTransModal'></div>";
			}
			?>
			
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-collapse" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="20%">QTY</th>
                    <th>Description</th>
					<th>Price</th>
                    <th></th>
                    <th>Total</th>
                    
                  </tr>
                </thead>
                <tfoot>
				<tr>
					<th colspan="2" rowspan="2" width="65%"><marquee style="text-align: center"><h1 style="color:red"> <img src="img/jc_living_logo.jpg" width='100px' height="40px" style="border-radius:10%"> JC Living Water Refilling Station POINT OF SALES System</h1></marquee></th>
					<th  colspan="3">With Vat Sales: &#8369;<?php echo number_format($data['salesTotal']-($data['salesTotal']*.12),2); ?></th>
                </tr>
                <tr>
					
					<th colspan="3">Vat 12%: &#8369;<?php echo (number_format($data['salesTotal']*.12,2)); ?></th>
                </tr>
                  <tr>
					<th colspan="2">Item Count: <?php echo $data['trCount']*1; ?></th>
                    <th colspan="3">Total Sales: &#8369;<?php echo number_format($data['salesTotal']*1,2); ?></th>
                  </tr>
                </tfoot>
                <tbody>
                  
                    <?php
                    for($ctr=0;$ctr<$datatr['count'];$ctr++)
                      {
                      $no=$ctr+1;
                      echo "
                      <tr>
                      <td>".number_format($datatr['qty'][$ctr],0)." </td>
                      <td><a href='manage_delete_item.php?sid=".$datatr['sales_id'][$ctr]."'>".$datatr['product_description'][$ctr]."</a></td>
					  <td>&#8369; ".number_format($datatr['product_price'][$ctr],2)."</td>
                      <td>  </td>
                      <td>&#8369; ".number_format($datatr['salesTotal'][$ctr],2)."</td>
                      
                      </tr>";
                      }
                    ?>
                  
                  
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>

        

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
       <?php
				include "tps_water_footer.php";
		?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
<!-- Add item modal -->
	<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width:150%">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Item to Transaction</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
		<form method="POST" action="pos.php">
        <div class="modal-body">
		 <div class="form-label-group">
			<div class="form-label-group">Complete the Information to Add item<br/><br/></div>
		</div>
		
		<div class="form-group">
            <div class="form-label-group">
              <input type="hidden" id="trans_no" class="form-control" placeholder="Transaction #" required="required"  name="trans_no" value="<?php echo $datatc['trCount']+1; ?>">
              
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="trnoh" class="form-control" placeholder="Transaction #" required="required"  name="trans_noh" value="<?php echo $datatc['trCount']+1; ?>" disabled>
              <label for="trans_noh">Transaction no.</label>
            </div>
         </div>
		<div class="form-group" style="width:100%">
            <div class="form-label-group" style='width:100%'>
              <input list="pid" name="pid" class="form-control" required autofocus=autofocus>
			  <datalist id="pid" name="pid" autofocus=autofocus style="width:150%">
			  <?php
					for($ctr=0;$ctr<$dataprod['count'];$ctr++){
					echo "<option value='".$dataprod['product_id'][$ctr]."' style='width:250%'>".$dataprod['product_description'][$ctr]." [".strToUpper($dataprod['product_name'][$ctr])."] - &#8369;".$dataprod['product_price'][$ctr]."</option>";
					}
			  ?>
			  </datalist>
              <label for="pid">Select Product (Product code)</label>
             
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <input type="number" id="qty" class="form-control" placeholder="Qty" required="required"  name="qty" step="0.01">
              <label for="qty">Qty</label>
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <input type="hidden" class="form-control" placeholder="cashier id" required="required"  name="cashier_id" value="<?php echo $_SESSION['user_id'];?>">
            </div>
         </div>
		<div class="form-group">
            <div class="form-label-group">
              <input type="text" class="form-control" placeholder="Product description" required="required"  name="cashier_idh" value="<?php echo $_SESSION['user_id'];?>" disabled>
              <label for="cashier_idh">Cashier id</label>
            </div>
         </div>
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		  <input type="submit" value="add Item" name="additem" class="btn btn-primary" >
         
        </div>
		</form>
      </div>
    </div>
  </div>
  
  <!-- delete item modal -->
	<div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width:150%">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Remove Item to Transaction</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
		<form method="POST" action="pos.php">
        <div class="modal-body">
		 <div class="form-label-group">
			<div class="form-label-group" style="text-align:center">Authorization<br/><br/></div>
		</div>
		
		<div class="form-group">
            <div class="form-label-group">
              <input type="hidden" id="trans_no" class="form-control" placeholder="Transaction #" required="required"  name="trans_no" value="<?php echo $datatc['trCount']+1; ?>">
            </div>
         </div>
		 <div class="form-group">
            
			<div class="form-label-group">
              <input type="text" id="trnoh" class="form-control" placeholder="Transaction #" required="required"  name="trans_no" value="<?php echo $_GET['pid']; ?>" disabled>
              <label for="trans_noh">Description</label>
            </div>
			</br>
			<div class="form-label-group">
              <input type="text" id="trnoh" class="form-control" placeholder="Transaction #" required="required"  name="trans_noh" value="<?php echo ''; ?>" disabled>
              <label for="trans_noh">Qty</label>
            </div>
			</br>
			
         </div>
		<div class="form-label-group">
			<div class="form-label-group">Enter Username and Password<br/><br/></div>
		</div>
		 <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="username" class="form-control" placeholder="Qty" required="required"  name="username">
              <label for="qty">Username</label>
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="upass" class="form-control" placeholder="Qty" required="required"  name="qty">
              <label for="upass">password</label>
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <input type="hidden" class="form-control" placeholder="cashier id" required="required"  name="cashier_id" value="<?php echo $_SESSION['user_id'];?>">
            </div>
         </div>
		<div class="form-group">
            <div class="form-label-group">
              <input type="text" class="form-control" placeholder="Product description" required="required"  name="cashier_idh" value="<?php echo $_SESSION['user_id'];?>" disabled>
              <label for="cashier_idh">Cashier id</label>
            </div>
         </div>
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		  <input type="submit" value="remove Item" name="removeitem" class="btn btn-primary" >
         
        </div>
		</form>
      </div>
    </div>
  </div>

<!-- complete modal -->
	<div class="modal fade" id="completeTransModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Complete and Finish Transaction</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
		<form method="POST" action="pos.php">
        <div class="modal-body">
		 <div class="form-group">
            <div class="form-row">
            <div class="col-md-5">
                <div class="form-label-group">
					<input type="text" id="trno" class="form-control" placeholder="Product description" required="required"  name="trno" value="<?php echo $datatc['trCount']+1; ?>" readonly>
			  <input type="hidden" name="trans_no" value="<?php echo $datatc['trCount']+1; ?>">
              <label for="trno">Transaction no.</label>                 
                </div>
              </div>
			  <div class="col-md-7">
                <div class="form-label-group">
                 <input type="number" id="csales_total" class="form-control" placeholder="ttrans" required="required"  name="csales_total" value="<?php echo $data['salesTotal']; ?>" readonly>
			  <input type="hidden" name="trans_total" value="<?php echo $data['salesTotal']; ?>">
              <label for="csales_total">Total Transaction</label>
                </div>
              </div>

            </div>
          </div>
		 
		<div class="form-group">
            <div class="form-label-group">
              Transaction type
            </div>
         </div>
		<div class="form-group">
            <div class="form-label-group">
              <select name="sales_status" id="sales_status" class="form-control" required="required" placeholder="ttype">
			  <option value="Cash">Cash</option>
			  <option value="CancelTrans">Cancel Transaction</option>
			  </select>
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              Delivery type
            </div>
         </div>
		<div class="form-group">
            <div class="form-label-group">
              <select name="del_status" id="del_status" class="form-control" required="required" placeholder="ttype">
			  <option value="other">other</option>
			  <option value="pickup">For Pick-up</option>
			  <option value="delivery">For Delivery</option>
			  </select>
            </div>
         </div>
		  
		  <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="remarks" class="form-control" placeholder="Transact by" required="required"  name="remarks">
              <label for="remarks">Remarks</label>
            </div>
         </div>
		  <div class="form-group">
            <div class="form-label-group">
              <input type="date" id="date_sales" class="form-control" placeholder="Transact by" required="required"  name="date_sales" value="<?php echo date("Y-m-d");?>" max='<?php echo date('Y-m-d'); ?>'>
              <label for="date_sales">Transaction Date</label>
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="uids" class="form-control" placeholder="Transact by" required="required"  name="cashier_ids" value="<?php echo $_SESSION['cashier_name'];?>" disabled>
              <label for="uids">Transact by:</label>
            </div>
         </div>
		 <div class="form-group">
            <div class="form-label-group">
              <input type="hidden" id="uid" class="form-control" placeholder="Cashier info" required="required"  name="cashier_id" value="<?php echo $_SESSION['user_id'];?>">
            </div>
         </div>
		 <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		  <input type="submit" value="Complete Transaction" name="AddTransaction" class="btn btn-primary">
         
        </div>
		</form>
      </div>
    </div>
  </div>



  <!-- Bootstrap core JavaScript-->
  <script src="tps_water_design/vendor/jquery/jquery.min.js"></script>
  <script src="tps_water_design/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="tps_water_design/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="tps_water_design/vendor/datatables/jquery.dataTables.js"></script>
  <script src="tps_water_design/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="tps_water_design/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="tps_water_design/js/demo/datatables-demo.js"></script>
  <script language="javascript">
  function showprice(){
	  document.getElementById("ppprice").value=document.getElementById("pid").value;  
  }
  </script>

</body>

</html>
