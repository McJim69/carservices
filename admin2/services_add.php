<?php 
	require("header.php");
	require("navbar.php");
	
	if(isset($_POST['submit'])){	
	
		$insert = $link->query("INSERT INTO services VALUES(0, 
			'".$_POST['service_font']."', 
			'".$_POST['service_name']."', 
			'".$_POST['service_qlty']."', 
			'".$_POST['service_expt']."', 
			'".$_POST['service_mdrn']."', 0)") or die(mysqli_error($link));

		if(($insert)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>
<div class="content-wrapper">
	<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> Add Services</h3>
	<form action='#' method='POST' enctype='multipart/form-data'>
	<div class="row">
		<div class='col-xl-4 col-sm-12 grid-margin stretch-card'>
			<div class='card'>
				<div class='card-body'>
					<div class="row">
						<div class='col-lg-12 form-group'>
							<label for='service_name'>Service Name</label>
							<input type='text' class='form-control text-secondary' name='service_name' placeholder='Service Name' required >
						</div>
						<div class='col-lg-12 form-group'>
							<label for='service_qlty'>Quality Tagline</label>
							<input type='text' class='form-control text-secondary' name='service_qlty' placeholder='Quality Tagline' required >
						</div>
						<div class='col-lg-12 form-group'>
							<label for='service_expt'>Expert Tagline</label>
							<input type='text' class='form-control text-secondary' name='service_expt' placeholder='Expert Tagline' required >
						</div>
						<div class='col-lg-12 form-group'>
							<label for='service_mdrn'>Modern Tagline</label>
							<input type='text' class='form-control text-secondary' name='service_mdrn' placeholder='Modern Tagline' required >
						</div>
						<div class='col-lg-12 form-group'>
							<label for='service_font'>Font Awesome Icon</label>
							<input type='text' class='form-control text-secondary' name='service_font' placeholder='Font Awesome Icon' required >
						</div>
						<div class='col-lg-12 form-group' style='margin-bottom:0px'>
							<button class='btn btn-primary btn-block text-secondary' type='SUBMIT' name='submit' style='margin-top:10px;padding:10px'>Submit</button>
						</div>				
					</div>	
				</div>	
			</div>	
		</div>
	</div>
</form>
</div>
			
<?php require("footer.php");?>
