<?php 
	require("header.php");
	require("navbar.php");
	
	if(isset($_POST['submit'])){	

	$insert = $link->query("INSERT INTO  manufacturer VALUES (0,'".$_POST["name"]."',0)");
	
	$name = $_POST["name"];
	
		if(($insert)== TRUE){
			echo'
			<script type="text/javascript">
				swal({
				  title: "Success!",
				  text: "Manufacturer '.$name.' added successfully!",
				  type: "success"
				}).then(function() {
					window.location.href = "manufacturer_edit.php?manufacturer='.$mfid.'";
				})
			</script>';
			
		}else{
			$error = mysqli_error($link);
			echo'
			<script type="text/javascript">
				jQuery(function validation(){
					swal("ERROR!", "'.$error.'", "warning", {
						button: "Retry",
					});
				});
			</script>';
		}
	}
?>

<div class="content-wrapper">
	<form action='#' method='POST' enctype='multipart/form-data'>
		<div class="row">
			<div class='col-lg-3 grid-margin stretch-card'>
				<div class='card'>
					<div class='card-body'><h3 class="card-title">Add + Manufacturer</h3>
						<div class='text-center'>
							<img src='../img/manufacturer.png' style='width:80%;background:#bbb;padding:22px;border-radius:50%'>
						</div>
						<div class="form-group">
							<div>Brand Name</div>
							<input type='text' class='btn-dark btn-block form-control text-uppercase text-secondary' name='name' placeholder='Brand Name' required >
						</div>	
						<div class='form-group'>
							<button class='btn btn-primary btn-block text-secondary' type='SUBMIT' name='submit' style='margin-top:10px;padding:10px'>Submit</button>
						</div>	
						<div class='form-group' style='margin-top:35px;margin-bottom:0px'>
							<a href='manufacturer_edit.php' class='btn btn-inverse-primary btn-block text-secondary' style='margin-top:10px;padding:10px'>Edit Manufacturer</a>
						</div>	
					</div>	
				</div>	
			</div>

			<?php require("manufacturer1.php");?>

		</div>
	</form>
</div>
			
<?php require("footer.php");?>
