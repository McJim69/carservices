<?php 
	require("header.php");
	require("navbar.php");

	$rqry = $link->query("SELECT MAX(tech_id) FROM technicians");
	$resu = $rqry->fetch_array();
	$rsid = $resu[0]+1;

	if(isset($_POST["submit"])){	

	$name = $_POST["fullname"];

	$insert = $link->query("INSERT INTO  technicians VALUES (
		'".$rsid."',
		'".$_POST["fullname"]."',
		'".$_POST["position"]."',
		'".$_POST["facebook"]."',
		'".$_POST["mobphone"]."',0)");

		if(($insert)== TRUE){

			echo'
			<script type="text/javascript">
				swal({
				  title: "Success!",
				  text: "Technician '.$name.' added successfully!",
				  type: "success"
				}).then(function() {
					window.location.href = "technicians_edit.php?technicians='.$rsid.'";
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
	<h2 class="card-title">Add Technician &nbsp; 
		<a href='technicians.php' title='Back' class='btn btn-sm btn-outline-info'> 
			<i class='mdi mdi-arrow-left'></i>Back
		</a>
		<a href='technicians_add.php' title='Refresh' class='btn btn-sm btn-outline-info'>
			<i class='mdi mdi-magnify'></i>Refresh
		</a>
	</h2> 
	<div class="row">			
		<div class="col-lg-4">
			<div class="card">
				<div class="card-body" style="color:#bbb">
					<form action="#" method="POST" enctype="multipart/form-data">
						<div class='row-lg-12'>
							<div class='form-group'>
								<label for='fullname'>Full Name</label>
								<input type='text' class='form-control text-secondary' name='fullname' placeholder='Full Name' required >
							</div>
							<div class='form-group'>
								<label for='position'>Position</label>
								<input type='text' class='form-control text-secondary' name='position' placeholder='Position' required >
							</div>
							<div class='form-group'>
								<label for='facebook'>Facebook Account</label>
								<input type='text' class='form-control text-secondary' name='facebook' placeholder='Facebook Account' required >
							</div>
							<div class='form-group'>
								<label for='mobphone'>Cell Phone Number</label>
								<input type='text' class='form-control text-secondary' name='mobphone' placeholder='Cell Phone Number' required >
							</div>
							<div class="form-group" style="margin-bottom:0">
								<button class="btn btn-outline-info btn-block" type="SUBMIT" name="submit" style="padding:10px">Submit</button>
							</div>
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>

<?php require("footer.php");?>
