<!-- Navbar Start -->
<nav id="navbar" class="navbar p-0 fixed-top d-flex flex-row">
	<div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
		<a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
	</div>
	<div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
		<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
			<span class="mdi mdi-menu"></span>
		</button>
		<ul class="navbar-nav w-100">
			<li class="nav-item w-100">
				<?php require("time.php");?>
			</li>
		</ul>
		<ul class="navbar-nav navbar-nav-right">
			<li class="nav-item d-none d-lg-block">
				<a href="index.php" class="btn btn-outline-success">Dashboard</a>
			</li>			
			<li class="nav-item dropdown d-none d-lg-block">
				<a class="nav-link btn btn-outline-success create-new-button" id="addbuttonDropdown" data-toggle="dropdown" aria-expanded="false" href="#">+ Add New</a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="addbuttonDropdown">
					<div class="dropdown-divider"></div>
					<div onClick="jump('transactions_add.php')" class="dropdown-item preview-item">
						<div class="preview-thumbnail">
							<div class="preview-icon bg-dark rounded-circle">
								<i class="mdi mdi-briefcase-check text-primary"></i>
							</div>
						</div>
						<div class="preview-item-content">
							<p class="preview-subject ellipsis mb-1">Transaction</p>
						</div>
					</div>
					<div class="dropdown-divider"></div>
					<div onClick="jump('products_add.php')" class="dropdown-item preview-item">
						<div class="preview-thumbnail">
							<div class="preview-icon bg-dark rounded-circle">
								<i class="mdi mdi-cart text-info"></i>
							</div>
						</div>
						<div class="preview-item-content">
							<p class="preview-subject ellipsis mb-1">Add Product</p>
						</div>
					</div>
					<div class="dropdown-divider"></div>
					<div onClick="jump('products.php')" class="preview-item-content" style="cursor:pointer">
						<p class="text-primary p-3 mb-0">See All Products</p>
					</div>	
					<div onClick="jump('transactions.php')" class="drop preview-item-content" style="cursor:pointer">
						<p  class="text-primary p-3 mb-0">See All Transactions</p>
					</div>
				</div>
			</li>
			<li class="nav-item dropdown d-none d-lg-block">
				<a class="nav-link btn btn-outline-success create-new-button" id="themebuttonDropdown" data-toggle="dropdown" aria-expanded="false" href="#">Themes</a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="themebuttonDropdown">
					<div class="dropdown-divider"></div>
					<a onClick="jump('../admin2')" class="dropdown-item preview-item">
						<div class="preview-thumbnail">
							<div class="preview-icon bg-dark rounded-circle">
								<i class="fa fa-moon text-primary"></i>
							</div>
						</div>
						<div class="preview-item-content">
							<p class="preview-subject ellipsis mb-1">Dark Theme</p>
						</div>
					</a>
					<a onClick="jump('../admin')" class="dropdown-item preview-item">
						<div class="preview-thumbnail">
							<div class="preview-icon bg-dark rounded-circle">
								<i class="fa fa-sun text-primary"></i>
							</div>
						</div>
						<div class="preview-item-content">
							<p class="preview-subject ellipsis mb-1">Light Theme</p>
						</div>
					</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
					<div class="navbar-profile">
						<?php
							echo"<img class='img-xs rounded-circle' ";
							if(file_exists("../img/users/$id.jpg")){
								echo"src='../img/users/$id.jpg?".date('h:i:s')."'>";
							}else{
								echo"src='../img/user.png'>";
							}
						?>                 
						<p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $_SESSION["user"];?></p>
						<i class="mdi mdi-menu-down d-none d-sm-block"></i>
					</div>
				</a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
					<h6 class="p-3 mb-0">Profile</h6>
					<div class="dropdown-divider"></div>
						<a class="dropdown-item preview-item" href="user_profile.php">
						<div class="preview-thumbnail">
							<div class="preview-icon bg-dark rounded-circle">
								<i class="fa fa-user text-success"></i>
							</div>
						</div>
						<div class="preview-item-content">
							<p class="preview-subject mb-1">Profile</p>
						</div>
						</a>
					<div class="dropdown-divider"></div>
					<a onClick="sessionEnd()" class="dropdown-item preview-item">
						<div class="preview-thumbnail">
							<div class="preview-icon bg-dark rounded-circle">
								<i class="mdi mdi-logout text-danger"></i>
							</div>
						</div>
						<div class="preview-item-content">
							<p class="preview-subject mb-1">Log out</p>
						</div>
					</a>
				</div>
			</li>
		</ul>
		<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
			<span class="mdi mdi-format-line-spacing"></span>
		</button>
	</div>
</nav>
<!-- Navbar End -->

<script>
	function sessionEnd(){	
		if(confirm("Are you sure you want to Logout?")){
			window.location.href = 'logout.php';
		}
	}
</script>	