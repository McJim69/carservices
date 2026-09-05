<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
	if(isset($_POST["submit"])){	

	$insert = $link->query("INSERT INTO  customers VALUES (0,
		'".$_POST["fullname"]."',
		'".$_POST["position"]."',
		'".$_POST["address"]."',
		'".$_POST["phone"]."',
		'".$_POST["testimony"]."',0)");

		if(($insert)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>

<script> setActive("clients"); </script>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Add Customer</h1>
			<button onClick="history.back()" class="btn btn-primary">
				<i class="fa fa-arrow-left"></i> Back to List
			</button>
		</div>
	</div>
</div>
<!-- Page Header End -->

<form action="#" method="POST" enctype="multipart/form-data">

<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
	<div class="container text-center" style="margin-top:-50px">
		<div class="row justify-content-center">
		
			<div class="col-lg-6" style="border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
				<div class="row">	
					<div class="col-lg-6 form-group mt-3">
						<div class="bg-light text-center">
							<img style="min-height:297px;border-radius:4px;border:1px solid #bbb;width:100%;background:#fff;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;" 
							src="img/user.png" />
						</div>
					</div>
					<div class="col-lg-6 form-group mt-3">
						<div style="min-height:297px;background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;width:100%;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px">
							<div class="form-floating">
								<input type="text" class="form-control" name="fullname" placeholder="Full Name" required >
								<label for="fullname">Full Name</label>
							</div>	
							<div class="form-floating">								
								<input type="text" class="form-control" name="position" placeholder="Position" required >
								<label for="position">Position</label>
							</div>	
							<div class="form-floating">								
								<input type="text" class="form-control" name="address" placeholder="Address" required >
								<label for="address">Address</label>
							</div>
							<div class="form-floating">								
								<input type="text" class="form-control" name="phone" placeholder="Phone Number" required >
								<label for="phone">Phone Number</label>
							</div>
							<div class="form-floating">								
								<textarea type="text" class="form-control" rows="1" name="testimony" placeholder="Testimony"></textarea>
								<label for="testimony">Testimony</label>
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
