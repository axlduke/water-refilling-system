<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15 ">
                    <i class="fas fa-laugh#"><img src="logo_jc_livingwater.png" width="100px" style="border-radius: 50%"></i>
                </div>
                <div class="sidebar-brand-text mx-3">JC LIVING WATER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

             <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                 <a class="nav-link" href="../product/product_list.php">
                    
					<span><font color="yellow"><img src='../img/productbw.png' width='25px' height='25px' style="border-radius: 10%"> PRODUCT</font></span></a>
            </div>
           <!-- Divider -->
            <hr class="sidebar-divider">
			<div class="sidebar-heading">
                 <a class="nav-link" href="../sales/sales_list.php">
                   
					<span><font color="yellow"><img src='../img/report_sales.png' width='25px' height='25px' style="border-radius: 10%"> SALES</font></span>
					</a>
            </div>
			<hr class="sidebar-divider">
			<div class="sidebar-heading">
                <font color="yellow">
				<img src='../img/inventory_logo.png' width='35px' height='35px' style="border-radius: 50%"> INVENTORY</font>
            </div>
			<li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDaily"
                    aria-expanded="true" aria-controls="collapseDaily">
                    <i class="fas fa-fw"></i><i class="fas fa-fw fa-table"></i>
                    <span>Manage stocks</span>
                </a>
                <div id="collapseDaily" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
						<h6 class="collapse-header">View Stocks</h6>
                        <a class="collapse-item" href="" data-toggle="modal" data-target="#addStocksModal">Add</a>
                        <a class="collapse-item" href="inventory_list.php">View</a>
                        <a class="collapse-item" href="#">Print</a>
                    </div>
                </div>
            </li>
			
            
			
            <hr class="sidebar-divider">
			<div class="sidebar-heading">
               <a class="nav-link" href="../delivery/delivery_list.php">
                   
					<span><font color="yellow">
					<img src='../img/delivery_logo.png' width='25px' height='25px' style="border-radius: 10%"> DELIVERY</font></span>
					</a>
            </div>
			
			<hr class="sidebar-divider">
			<div class="sidebar-heading">
                <a class="nav-link" href="../maintenance/maintenance_list.php">
					<span><font color="yellow">
					<img src='../img/maintenance_logo.png' width='25px' height='25px' style="border-radius: 10%"> MAINTENANCE</font></span>
					</a>
            </div>
			<hr class="sidebar-divider d-none d-md-block">
			<div class="sidebar-heading">
			<a class="nav-link" href="../accounts/updatePasswordOwner.php">
                    <i class="fas fa-fw"></i><i class="fas fa-fw"></i>
					<span><font color="green"><button>Manage Password</button></font></span>
			</a>
			</div><!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
			
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>