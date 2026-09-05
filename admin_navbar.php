<!-- Navbar Start -->
    <nav id="navbar" class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="admin_dashboard.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-car me-3"></i><?php echo _TITLE;?></h2>
			<div style="margin-left:10px">
				<?php
					$ex = $link->query("SELECT site_mode FROM siteinfo") or die (mysqli_error($link));
					while($rs=mysqli_fetch_array($ex)){	
						if(($rs[0])!=="Production"){ 
							echo"<small class='blinking text-primary'>"._SMODE."</small>";
						}
					}
				?>
			</div>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="admin_dashboard.php" id="dashboard" class="nav-item nav-link">Dashboard</a>
                <a href="admin_products.php" id="products" class="nav-item nav-link">Products</a>
				<a href="admin_customers.php" id="clients" class="nav-item nav-link">Costumers</a>
				<a href="admin_transactions.php" id="transactions" class="nav-item nav-link">Transaction</a>
				<a href="admin_reports.php" id="reports" class="nav-item nav-link">Reports</a>
				<div class="nav-item dropdown">
					<a id="gallery" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Galleries</a>
					<div class="dropdown-menu fade-up m-0">
						<a href="admin_videos.php" id="videos" class="dropdown-item">Videos</a>
						<a href="admin_pictures.php" id="photos" class="dropdown-item">Photos</a>
					</div>
				</div>
				<div class="nav-item dropdown">
					<a id="system" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Settings</a>
                    <div class="dropdown-menu fade-up m-0">
						<a href="admin_units.php" id="units" class="dropdown-item">Units</a>
						<a href="admin_about.php" id="about" class="dropdown-item">About</a>
						<a href="admin_settings.php" id="settings" class="dropdown-item">System</a>
						<a href="admin_siteinfo.php" id="info" class="dropdown-item">Website</a>
                        <a href="admin_services.php" id="services" class="dropdown-item">Services</a>
						<a href="admin_webmode.php" id="webmode" class="dropdown-item">Webmode</a>
						<a href="admin_categories.php" id="categories" class="dropdown-item">Categories</a>
                        <a href="admin2" class="dropdown-item">Dark Theme</a>
                    </div>
				</div>
				<div class="nav-item dropdown">
					<a id="profile" class="nav-link dropdown" data-bs-toggle="dropdown">
						<span><i class="fa fa-user"></i></span>
						<span><?php echo $_SESSION["user"];?></span> 
					</a>
                    <div class="dropdown-menu fade-up m-0">
						<a href="admin_users_sess.php" id="users" class="dropdown-item">Profile</a>
						<a class="dropdown-item" onclick="sessionEnd()" style='cursor:pointer'>Logout</a>
                    </div>
				</div>	
								
            </div>
        </div>
    </nav>
<!-- Navbar End -->

<script>
	function sessionEnd(){	
		if(confirm("Are you sure you want to Logout?")){
			window.location.href = 'admin_logout.php';
		}
	}
</script>	