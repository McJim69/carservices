<?php 
	require("header.php");
	require("navbar.php");
		
	if(isset($_POST['submit'])){	
	
		$insert = $link->query("INSERT INTO units VALUES(0, '".$_POST['unit_name']."', '".$_POST['description']."')") or die(mysqli_error($link));

		if(($insert)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>
<div class="content-wrapper">
	<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> Add Units</h3>
	<form action='#' method='POST' enctype='multipart/form-data'>
	<div class="row">
		<div class='col-xl-4 col-sm-12 grid-margin stretch-card'>
			<div class='card'>
				<div class='card-body'>
					<div class="row">
						<div class='col-lg-12'>
							<div class='form-group'>
								<label for='unit_name'>Unit Name</label>
								<input type='text' class='form-control text-secondary' name='unit_name' placeholder='units Name' required >
							</div>
							<div class='form-group'>
								<label for='description'>Description</label>
								<input type='text' class='form-control text-secondary' name='description' placeholder='Description' required >
							</div>
							<div class='form-group' style='margin-top:20px;margin-bottom:0'>
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
