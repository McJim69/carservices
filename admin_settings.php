<?php
	require("admin_header.php");

	if(!isset($_SESSION['user'])){
		header("location:admin_login.php");
	}	

	require("admin_topbar.php");
	require("admin_navbar.php");	
?>

<script> setActive("settings"); </script>
<script> setActive("system"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">System Settings</h1>
				<button onclick="jump('javascript.history.back();')" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>								
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

<!-- Settings Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class='row g-4' style='margin-top:-70px'>

				<?php
					$ex=$link->query("SELECT * FROM settings ORDER BY set_id limit 6");
							
					while($rs=mysqli_fetch_array($ex)){	
					
					$title = $rs["set_title"];
					$sdesc = $rs["description"];
					$link1= $rs["set_link"];
						
					echo"
					<div class='col-lg-2 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>	
						<div class='box-item'>
							<a href='admin_$link1.php'>
								<div class='position-relative overflow-hidden'>
									<img class='img-fluid box-img' src='img/system/$link1.png?".date("h:i:s")."'>
								</div>						
								<div class='text-center' style='margin-top:-40px;padding:5px'>
									<h4 class='fw-bold mb-0'>$title</h4>
									<small>$sdesc</small>
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
<!-- Settings End -->

<?php require("admin_footer.php");?>