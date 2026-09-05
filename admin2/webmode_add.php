<?php 
	require("header.php");
	require("navbar.php");
		
	if(isset($_POST['submit'])){	
	
		$insert = $link->query("INSERT INTO site_mode VALUES(0, '".$_POST['mode_name']."', '".$_POST['description']."', '".$_POST['fonticon']."')") or die(mysqli_error($link));

		if(($insert)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>
<div class="content-wrapper">
	<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> Webmode</h3>
	<form action='#' method='POST' enctype='multipart/form-data'>
	<div class="row">
		<div class='col-xl-4 col-sm-12 grid-margin stretch-card'>
			<div class='card'>
				<div class='card-body'>
					<div class="row">
						<div class='col-lg-12'>
							<div class='text-center'>
								<div class='text-center'>
									<h3 class='text-primary text-uppercase'>Add Web Mode</h3>
								</div>
							</div>
							<div class='form-group'>
								<label for='mode_name'>Mode Name</label>
								<input type='text' class='form-control text-secondary' name='mode_name' placeholder='Mode Name' required >
							</div>
							<div class='form-group'>
								<label for='description'>Description</label>
								<input type='text' class='form-control text-secondary' name='description' placeholder='Description' required >
							</div>
							<div class='form-group'>
								<label for='fonticon'>Font Awesome Icon</label>
								<input type='text' class='form-control text-secondary' name='fonticon' placeholder='Font Awesome Icon' required >
							</div>
							<div class='text-center' style='margin-top:20px;margin-bottom:0'>
								<button class='btn btn-primary btn-block' type='SUBMIT' name='submit' style='padding:10px'>Submit</button>
							</div>
						</div>		
					</div>	
				</div>	
			</div>	
		</div>
	</div>
</form>

</div>

<?php require("footer.php");?>
