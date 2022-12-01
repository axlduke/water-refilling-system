<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15 ">
                    <i class="fas fa-laugh#"><img src="logo_jc_livingwater.png" width="100px" style="border-radius: 50%"></i>
                </div>
                <div class="sidebar-brand-text mx-3">JC LIVING WATER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

             <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                <font color="yellow">Accounts</font>
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
			 <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProd"
                    aria-expanded="true" aria-controls="collapseProd">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Manage Accounts</span>
                </a>
                <div id="collapseProd" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#" data-toggle="modal" data-target="#addCashierModal">Add Cashier Account</a>
						<a class="collapse-item" href="#" data-toggle="modal" data-target="#addOwnerModal">Add Owner Account</a>
						 <a class="collapse-item" href="account_list.php">view Accounts</a>
                    </div>
                </div>
			<hr class="sidebar-divider d-none d-md-block">
			<div class="sidebar-heading">
			<a class="nav-link" href="updatePasswordSysAdmin.php">
                    
					<span><font color="green"><button>Manage Password</button></font></span>
			</a>
			</div>	 
            
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>