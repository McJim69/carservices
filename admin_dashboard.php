<?php
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");		
?>

<script> setActive("dashboard"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Admin Dashboard</h1>
				<a href="admin2">
				<button class="btn btn-primary">
					<i class="fa fa-clone"></i> Dark Theme
				</button>
				</a>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<style>
	.box-img{
		padding: 30px;
		margin-top: -20px;
		background: transparent;
	}
	.box-item:hover{
		padding:5px;
		background: #eee;
		border-radius: 5px;
		border: 1px solid #bbb;
		box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
	}
</style>

<!-- Daschboard Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class='row g-4' style='margin-top:-70px' >

				<?php
					$ex=$link->query("SELECT * FROM dashboard ORDER by dash_title");
							
					while($rs=mysqli_fetch_array($ex)){	
					
					$title = $rs["dash_title"];
					$ddesc = $rs["description"];
					$dlink = $rs["dash_link"];
						
					echo"
					<div class='col-lg-2 col-md-6 col-sm-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>	
						<div class='box-item'>
							<a href='admin_$dlink.php'>
								<div class='position-relative overflow-hidden'>
									<img class='img-fluid box-img' src='img/dashboard/$dlink.png'>								 
									<div class='text-center' style='margin-top:-30px;padding:5px'>
										<h5 class='fw-bold mb-0 text-secondary'>$title</h5>
										<small>$ddesc</small>
									</div>
								</div>
							</a>	
						</div>
					</div> 
					
					";
					}
				?>
			</div>
        </div>
    </div>
<!-- Daschboard End -->

<?php require("admin_footer.php"); ?>
