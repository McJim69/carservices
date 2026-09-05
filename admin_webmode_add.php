<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
	if(isset($_POST['submit'])){	
	
		$insert = $link->query("INSERT INTO site_mode VALUES(0, '".$_POST['mode_name']."', '".$_POST['description']."', '".$_POST['fonticon']."')") or die(mysqli_error($link));

		if(($insert)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>

<script> setActive("system"); </script>
<script> setActive("categories"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Add Web Mode</h1>
				<button onClick="history.back()" class="btn btn-primary">
					<i class="fa fa-arrow-left"></i> Back
				</button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<!-- Add About Start -->
	<form action='#' method='POST' enctype='multipart/form-data'>
		<div class='row justify-content-center' style='margin:5px 5px 50px 5px;padding:10px'>
			<div class='col-lg-4' style='border:1px solid #bbb;background:#eee;border-radius:5px;'>
				<div class='row'>
					<div class='form-group mt-3'>
						<div style='background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'>
							<div class='text-center' style='margin:20px'>
								<div class='text-center'>
									<h3 class='text-primary text-uppercase'>Add Web Mode</h3>
								</div>
							</div>
							<div style='margin:5px' class='form-floating'>
								<input type='text' class='form-control' name='mode_name' placeholder='Mode Name' required >
								<label for='mode_name'>Mode Name</label>
							</div>
							<div style='margin:5px' class='form-floating'>
								<textarea type='text' class='form-control' name='description' placeholder='Description' required ></textarea>
								<label for='description'>Description</label>
							</div>
							<div style='margin:5px' class='form-floating'>
								<input type='text' class='form-control' name='fonticon' placeholder='Font Awesome Icon' required >
								<label for='fonticon'>Font Awesome Icon</label>
							</div>
						</div>
						<div class='text-center' style='margin:20px'>
							<button class='btn btn-primary rounded-pill' type='SUBMIT' name='submit' style='width:100px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;'>Submit</button>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</form>
<!-- Add About End -->

<?php require("admin_footer.php");?>