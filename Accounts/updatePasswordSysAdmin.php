<?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  if($_SESSION['access_level']!='sysadmin'){
    echo "<meta http-equiv='refresh'content='0;url=loginSysadmin.php'>";
  }
  else{	  
  include("../Controller/AccountController.php");
  include("../Model/Account.php");
  
  $accCon = new AccountController();
  $acc= new Account();
		if(isset($_POST['changePass'])){
			$acc_id=$_SESSION['account_id'];
			$newPass=$_POST['newpass'];
			$oldpass=$_POST['oldpass'];
			$accCon->changePasswordSysAdmin();
			
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

    <title>Account Change Password</title>
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
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script type="text/javascript">
		function checkPasswordMatch() {
			var password = $("#newpass").val();
			var confirmPassword = $("#cnpass").val();

			if (password != confirmPassword)
				$("#divCheckPasswordMatch").html("Password Status: Do not match!");
			else
				$("#divCheckPasswordMatch").html("Password Status: Verified!");
		}
	</script>

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
							<h1 class="h3 mb-2 text-gray-800">Manage System Admin Password  <img src='../img/password_protect.png' width='40px' height='40px' style="border-radius: 50%"></h1>
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
      <div class="card-header">Change Password</div>
      <div class="card-body">
        <form action="updatePasswordSysAdmin.php" method="POST">
          
          <div class="form-group">
            <div class="form-label-group">
              <label for="oldpass">Old Password</label>
			  <input type="password" id="oldpass" name="oldpass" class="form-control"  required="required" value="" placeholder="enter old password . . ." autocomplete="off" autofocus>
              <p><small><input type="checkbox" onclick="myFunction()"> Show Password </small></p>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <label for="newpass">New Password</label>
			  <input type="password" id="newpass" name="newpass" class="form-control"  required="required" value="" placeholder="enter new password . . ." autocomplete="off"  minlength="8" maxlength="10" >
              
            </div>
          </div>
		  <div class="form-group">
            <div class="form-label-group">
              <label for="cnpass">Confirm New Password</label>
			  <input type="password" id="cnpass" name="cnpass" class="form-control"  required="required" value="" placeholder="confirm new password . . ." autocomplete="off"  minlength="8" maxlength="10" onkeyup="checkPasswordMatch();">
            </div>
			<div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
          </div>
		  <br/>
          <input type="submit" class="btn btn-primary btn-block" value="Change Password now!" name="changePass" id="changePass">
          <a class="btn btn-danger btn-block" href="account_list.php">Cancel</a>
        </form>
		<script type="text/javascript" src="../cpass_jquery.js"></script>
		<script type="text/javascript">
			
			function myFunction() {
			  var x = document.getElementById("oldpass");
			  if (x.type === "password") {
				x.type = "text";
			  } else {
				x.type = "password";
			  }
			} 
		</script>
		
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