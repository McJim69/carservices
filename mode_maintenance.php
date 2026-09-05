<?php
	require("header_mode.php");
	require("topbar.php");
	require("navbar.php");
?>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Maintenance</h1>
                <h4 class="text-white animated slideInDown">Website is under maintenance. We'll be back very soon.</h4>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
	<div class="container text-center" style="margin-top:-60px">
		<div class="row justify-content-center" style="margin:20px">
			<a class="btn btn-primary rounded-pill py-3 px-5" href="admin/" style="width:250px">Admin Login</a>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-5">
				<div class="row">
					<img src="img/maintenance.webp?<?php echo date("h:i:s");?>">
				</div>
			</div>
		</div>
	</div>
</div>

<?php require("footer.php");?>