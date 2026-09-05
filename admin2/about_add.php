<?php 
	require("header.php");
	require("navbar.php");
	
	if(isset($_POST['submit'])){	
	
		$insert = $link->query("INSERT INTO about VALUES(0, '".$_POST['title']."', '".$_POST['description']."', '".$_POST['icon']."')") or die(mysqli_error($link));

		if(($insert)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>
<div class="content-wrapper">
	<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> Add About</h3>
	<form action='#' method='POST' enctype='multipart/form-data'>
	<div class="row">
		<div class='col-xl-4 col-sm-12 grid-margin stretch-card'>
			<div class='card'>
				<div class='card-body'>
					<div class='col-lg-12 form-group'>
						<label for='title'>Title</label>
						<input type='text' class='form-control bg-dark text-secondary' name='title' placeholder='Title' required >
					</div>
					<div class='col-lg-12 form-group'>
						<label for='description'>Description</label>
						<input type='text' class='form-control bg-dark text-secondary' name='description' placeholder='Description' required >
					</div>
					<div class='col-lg-12 form-group'>
						<label for='icon'>Font Awesome Icon</label>
						<input type='text' class='form-control bg-dark text-secondary' name='icon' placeholder='Font Awesome Icon' required >
					</div><br>
					<div class='col-lg-12 form-group'>
						<button class='form-control btn btn-primary btn-block' type='SUBMIT' name='submit'>Submit</button>
					</div>
				</div>	
			</div>	
		</div>
	</div>
</form>
</div>
			
<?php require("footer.php");?>
