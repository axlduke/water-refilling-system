<?php
  error_reporting(E_ALL & ~E_NOTICE);
   session_start();
  if($_SESSION['access_level']!='admin'){
    echo "<meta http-equiv='refresh'content='0;url=login.php'>";
  }
  else{
	  
  include("Controller/ProductController.php");
  include("Model/Product.php");
  
  $prodCon = new ProductController();
  $prod= new Product();
		if(isset($_POST['updateprod'])){
			$prod->setProductId($_POST['pid']);
			$prod->setProductName($_POST['supname']);
			$prod->setProductDescription($_POST['pdesc']);
			$prod->setProductCategory($_POST['pcat']);
			$prod->setProductUnit($_POST['punit']);
			$prod->setSellingPrice($_POST['psprice']);
			$prod->setSupplierPrice($_POST['psupprice']);
			$prodCon->updateProduct($prod);
			
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

  <title>Lisay Hardware - Product Info</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark" style="background-image: url('bg12345.jfif');background-repeat: no-repeat; background-size: cover;">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Update Product Information</div>
      <div class="card-body">
        <form action="product_infoEdit.php" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" id="pid1" name="pid1" class="form-control" placeholder="First name" required="required" value="<?php echo $_GET['pid'];?>" disabled>
				  <input type="hidden" name="pid" value="<?php echo $_GET['pid'];?>">
                  <label for="pid1">Product ID</label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-label-group">
                  <input type="text" id="pcat" name="pcat" class="form-control" placeholder="Last name" required="required" value="<?php echo $_GET['pcat'];?>">
                  <label for="pcat">Product Category</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="pdesc" name="pdesc" class="form-control" placeholder="Email address" required="required" value="<?php echo $_GET['pdesc'];?>">
              <label for="pdesc">Product Description</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="number" id="psupprice" name="psupprice" class="form-control" placeholder="Supplier Price" required="required" value="<?php echo $_GET['psupprice'];?>" step='0.01' min='0
				  '>
                  <label for="psupprice">Supplier Price</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="number" id="psprice" name="psprice" class="form-control" placeholder="Selling Price" required="required" step='0.01' min='0' value="<?php echo $_GET['psprice'];?>">
                  <label for="psprice">Selling Price</label>
                </div>
              </div>
            </div>
          </div>
		             <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="supname" name="supname" class="form-control" placeholder="Supplier Name" required="required" value="<?php echo $_GET['psup'];?>" >
                  <label for="supname">Supplier Name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="punit" name="punit" class="form-control" placeholder="Product Unit" required="required" value="<?php echo $_GET['punit'];?>">
                  <label for="punit">Product Unit</label>
                </div>
              </div>
            </div>
          </div>

		  
          <input type="submit" class="btn btn-primary btn-block" value="Update Product Info" name="updateprod">
          <a class="btn btn-danger btn-block" href="product_info.php">Cancel</a>
        </form>
        <div class="text-center">
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script language="javascript">

  </script>
</body>

</html>
