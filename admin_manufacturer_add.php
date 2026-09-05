<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
	if(isset($_POST['submit'])){	

	$insert = $link->query("INSERT INTO  manufacturer VALUES (0,'".$_POST["name"]."',0)");

		if(($insert)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>

<script>setActive("brand");</script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Add Manufacturer</h1>
				<button style="width:150px" onClick="jump('admin_manufacturer.php')" type="button" class="btn btn-primary rounded-pill"> Back to List </button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<form action="#" method="POST" enctype="multipart/form-data">

<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
	<div class="container text-center" style="margin-top:-50px">
		<div class="row justify-content-center">
			<div class="col-lg-4" style="border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
				<div class="row">
					<div class="col-lg-12 form-group mt-3">
						<div style="background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;width:100%;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px">
							<div class="form-floating">
								<input type='text' class='form-control text-uppercase' name='name' placeholder='Brand Name' required >
								<label for='name'>Manufacturer Brand Name</label>
							</div>	
						</div>
					</div>
					<div class="col" style="margin:20px">
						<button class="btn btn-primary rounded-pill" type="SUBMIT" name="submit" style="width:100px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">SUBMIT</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

</form>

<?php require("admin_footer.php"); ?>
