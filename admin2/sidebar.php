<!-- Sidebar -->

<nav id="sidebar" class="sidebar sidebar-offcanvas">
	<div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
		<a class="sidebar-brand brand-logo" href="index.html"><img src="../img/logo.png" alt="logo" /></a>
		<a class="sidebar-brand brand-logo-mini" href="index.html"><img src="../img/logo3.png" alt="logo" /></a>
	</div>
	<ul class="nav">
		<li class="nav-item profile">
			<div class="profile-desc">
				<div class="profile-pic">
					<div class="count-indicator">
					<?php
						$id = $_SESSION["usid"];
						$ex = $link->query("SELECT * FROM users WHERE usrid = $id");
						while($rs=mysqli_fetch_array($ex)){
							echo"<img class='img-xs rounded-circle' ";
							if(file_exists("../img/users/$id.jpg")){
								echo"src='../img/users/$id.jpg?".date('h:i:s')."'>";
							}else{
								echo"src='../img/user.png'>";
							}
						}
					?>                 
					<span class="count bg-success"></span>
					</div>
					<div class="profile-name">
						<h5 class="mb-0 font-weight-normal"><?php echo $_SESSION["user"];?></h5>
						<span><?php echo $_SESSION["type"];?></span>
					</div>
				</div>
				<a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
				<div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
					<a href="user_profile" class="dropdown-item preview-item">
						<div class="preview-thumbnail">
							<div class="preview-icon bg-dark rounded-circle">
								<i class="fa fa-user text-primary"></i>
							</div>
						</div>
						<div class="preview-item-content">
							<p class="preview-subject ellipsis mb-1 text-small">My Account</p>
						</div>
					</a><div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item preview-item">
						<div class="preview-thumbnail">
							<div class="preview-icon bg-dark rounded-circle">
								<i class="mdi mdi-calendar-today text-success"></i>
							</div>
						</div>
						<div class="preview-item-content">
							<p onClick="jump('todo.php')" class="preview-subject ellipsis mb-1 text-small">My To-do List</p>
						</div>
					</a>
				</div>
			</div>
		</li>		
		<li class="nav-item menu-items">
			<a class="nav-link" href="index.php">
				<span class="menu-icon"><i class="mdi mdi-speedometer"></i></span>
				<span class="menu-title">Dashboard</span>
			</a>
		</li>
		<li class="nav-item menu-items">
			<a class="nav-link" data-toggle="collapse" href="#products" aria-expanded="false" aria-controls="ui-basic">
				<span class="menu-icon"><i class="mdi mdi-cart"></i></span>
				<span class="menu-title">Products</span>
				<i class="menu-arrow"></i>
			</a>
            <div class="collapse" id="products">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"> <a class="nav-link" href="products.php">View All Products</a></li>
					<li class="nav-item"> <a class="nav-link" href="products_add.php">Add New Product</a></li>
				</ul>
            </div>
		</li>
		<li class="nav-item menu-items">
			<a class="nav-link" href="customers.php">
				<span class="menu-icon"><i class="mdi mdi-account-multiple"></i></span>
				<span class="menu-title">Customers</span>
			</a>
		</li>		
		<li class="nav-item menu-items">
			<a class="nav-link" href="technicians.php">
				<span class="menu-icon"><i class="fas fa-user-cog"></i></span>
				<span class="menu-title">Technicians</span>
			</a>
		</li>
		<li class="nav-item menu-items">
			<a class="nav-link" data-toggle="collapse" href="#trans" aria-expanded="false" aria-controls="ui-basic">
				<span class="menu-icon"><i class="mdi mdi-wrench"></i></span>
				<span class="menu-title">Transactions</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="trans">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"> <a class="nav-link" href="transactions.php">View All Transactions</a></li>
					<li class="nav-item"> <a class="nav-link" href="transactions_add.php">Add New Transaction</a></li>
				</ul>
            </div>
		</li>
		<li class="nav-item menu-items">
			<a class="nav-link" href="summaries.php">
				<span class="menu-icon"><i class="mdi mdi-calculator"></i></span>
				<span class="menu-title">Sales Report</span>
			</a>
		</li>
		<li class="nav-item menu-items">
			<a class="nav-link" href="manufacturer.php">
				<span class="menu-icon"><i class="fa fa-industry"></i></span>
				<span class="menu-title">Manufacturers</span>
			</a>
		</li>
		<li class="nav-item menu-items">
			<a class="nav-link" href="backup.php">
				<span class="menu-icon"><i class="mdi mdi-backup-restore"></i></span>
				<span class="menu-title">DB Management</span>
			</a>
		</li>
		<li class="nav-item menu-items">
			<a class="nav-link" href="settings.php">
				<span class="menu-icon"><i class="fa fa-cog"></i></span>
				<span class="menu-title">System Settings</span>
			</a>
		</li>
		<li class="nav-item menu-items">
			<a class="nav-link" data-toggle="collapse" href="#gallery" aria-expanded="false" aria-controls="ui-basic">
				<span class="menu-icon"><i class="fas fa-photo-video"></i></span>
				<span class="menu-title">Media Galleries</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="gallery">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"> <a class="nav-link" href="pictures.php">Photos</a></li>
					<li class="nav-item"> <a class="nav-link" href="videos.php">Videos</a></li>
				</ul>
            </div>
		</li>
		<li class="nav-item menu-items">
			<a class="nav-link" href="users.php">
				<span class="menu-icon"><i class="mdi mdi-account-multiple"></i></span>
				<span class="menu-title">System Users</span>
			</a>
		</li>			
		<li class="nav-item menu-items">
			<a class="nav-link" href="downloads.php">
				<span class="menu-icon"><i class="fa fa-download"></i></span>
				<span class="menu-title">Downloads</span>
			</a>
		</li>			
		<li class="nav-item menu-items">
			<a class="nav-link" data-toggle="collapse" href="#themes" aria-expanded="false" aria-controls="ui-basic">
				<span class="menu-icon"><i class="fa fa-sun"></i></span>
				<span class="menu-title">Themes</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="themes">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"> <a class="nav-link" href="../admin2">Dark</a></li>
					<li class="nav-item"> <a class="nav-link" href="../admin">Light</a></li>
				</ul>
            </div>
		</li>
		<li class="nav-item menu-items">
			<a class="nav-link" onClick="return confirm('Are you sure you want to Logout?')" href="logout.php">
				<span class="menu-icon"><i class="mdi mdi-logout"></i></span>
				<span class="menu-title">Logout</span>
			</a>
		</li>			
	</ul>
</nav>