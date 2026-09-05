<?php
	require("header.php");
	require("topbar.php");
	require("navbar.php");	
?>

<script> setActive("link"); </script>
<script> setActive("downloads"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Downloadables</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page"><a href="download" style="color:#eee">Download</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<!-- Downloads Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4" style="min-height:200px;margin-top:-70px">
				<?php
					$ex=$link->query("SELECT * FROM downloads ORDER BY did");
					while($rs=mysqli_fetch_array($ex)){
					$file=$rs["filename"];
					$filename=preg_replace("/\\.[^.\\s]{3,4}$/", "", $file);

					echo"
						<div class='col-lg-3 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>				
							<div class='box-item'>
								<a href='download/$file'>
								<div class='position-relative overflow-hidden'>
									<img src='img/download_now.png' class='img-fluid bg-light' alt='Download' width='100%' style='padding:20px'>
								</div>
								</a>
								<div class='bg-light text-center p-4'>
									<h5 class='fw-bold mb-0 text-capitalize'>$filename</h5>
									<small>$file</small>
								</div>
							</div>					
						</div>";
					} 
				?>
            </div>
        </div>
    </div>
<!-- Downloads End -->

<?php require("footer.php"); ?>

