<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
	if(isset($_POST['submit'])){	

	$insert = $link->query("INSERT INTO  technicians VALUES (0,
		'".$_POST["fullname"]."',
		'".$_POST["position"]."',
		'".$_POST["facebook"]."',
		'".$_POST["mobphone"]."',0)");

		if(($insert)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>

<script>setActive("team");</script>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Add Technician</h1>
			<div>
				<button onClick="history.back()" class="btn btn-primary">
					<i class="fa fa-arrow-left text-light"></i> Back to List
				</button>
			</div>			
		</div>
	</div>
</div>
<!-- Page Header End -->

<form action="#" method="POST" enctype="multipart/form-data">

<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
	<div class="container text-center" style="margin-top:-50px">
		<div class="row justify-content-center">
			<div class="col-lg-6" style="border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
				<div class="row" style='padding-top:15px'>
					<div>
						<div class='form-floating' style='margin:5px'>
							<div class='btn btn-primary' style='font-size:20px;border-radius:5px;margin-bottom:10px;width:100%'>
								Technician Profile
							</div>
						</div>
						<div class='form-floating' style='margin:5px'>
							<input type='text' class='form-control' name='fullname' placeholder='Full Name' required >
							<label for='fullname'>Full Name</label>
						</div>
						<div class='form-floating' style='margin:5px'>
							<input type='text' class='form-control' name='position' placeholder='Position' required >
							<label for='position'>Position</label>
						</div>
						<div class='form-floating' style='margin:5px'>
							<input type='text' class='form-control' name='facebook' placeholder='Facebook Account' required >
							<label for='facebook'>Facebook Account</label>
						</div>
						<div class='form-floating' style='margin:5px'>
							<input type='text' class='form-control' name='mobphone' placeholder='Cell Phone Number' required >
							<label for='mobphone'>Cell Phone Number</label>
						</div>
					</div>
				</div>
				<div style="margin:20px">
					<button class="btn btn-primary rounded-pill" type="SUBMIT" name="submit" style="width:200px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">SUBMIT</button>
				</div>
			</div>
		</div>
	</div>
</div>	

</form>

<?php require("admin_footer.php");?>