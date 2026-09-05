<?php 
	require("header.php");
	require("topbar.php");
	require("navbar.php");
?>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-3.png);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Thank You!</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Thanks</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<!-- Page Header End -->

    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h1 class="mb-4"><?php echo _THANKS1;?></h1>
                    <p class="mb-4"><?php echo _THANKS2;?></p>
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php">Go Back To Home</a>
                </div>
            </div>
        </div>
    </div>
<!-- Thanks End -->

<?php require("footer.php");?>