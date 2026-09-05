<?php 
	require("header.php");
	require("navbar.php");
		
	if(isset($_POST['submit'])){	

	$insert = $link->query("INSERT INTO  pictures VALUES (0,'".$_POST["title"]."','".$_POST["description"]."',0)");

		if(($insert)== TRUE){
			echo"<script>window.location.href = 'pictures.php';</script>";
		}
	}
?>
<div class="content-wrapper">
	<div class="row">
		<div class='col-xl-3 col-lg-3 col-sm-6 grid-margin stretch-card'>
			<div class='card'>
				<div class='card-body'>
					<h4 class="card-title">Galleries 
						<small><i class='fa fa-arrow-right'></i></small> Pictures 
						<small><i class='fa fa-arrow-right'></i></small> Add
					</h4>
					<div class="row">
						<div class='col-lg-12'>
							<div class='text-center'>
								<div class='text-center'>
									<h3 class='text-primary text-uppercase'>Add Picture</h3>
								</div>
							</div>
							<form action='#' method='POST' enctype='multipart/form-data'>
							<div class='form-group'>
								<div>Title</div>
								<input type='text' class='form-control text-secondary' name='title' placeholder='Title' required >
							</div>
							<div class='form-group'>
								<div>Description</div>
								<input type='text' class='form-control text-secondary' name='description' placeholder='Description' required >
							</div>
							<div class='text-center' style='margin-top:20px;margin-bottom:0'>
								<button class='btn btn-primary btn-block' type='SUBMIT' name='submit' style='padding:10px'>Submit</button>
							</div>
							</form>
						</div>		
					</div>	
				</div>	
			</div>	
		</div>

		<?php require("pictures1.php");?>

	</div>

</div>

<?php require("footer.php");?>
