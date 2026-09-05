<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
	if(isset($_POST['upDate'])){	
		$service_idno = $_POST['service_idno'];
		$service_name = $_POST['service_name'];
		$service_qlty = $_POST['service_qlty'];
		$service_expt = $_POST['service_expt'];
		$service_mdrn = $_POST['service_mdrn'];
		$service_font = $_POST['service_font'];

	$update = $link->query("UPDATE services set
		service_idno = '$service_idno',
		service_name = '$service_name',
		service_qlty = '$service_qlty',
		service_expt = '$service_expt',
		service_mdrn = '$service_mdrn',
		service_font = '$service_font' where service_idno  = '$service_idno'") or die(mysqli_error($link));

		if(($update)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>

<script> setActive("system"); </script>
<script> setActive("services"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Update Services</h1>
				<button onClick="history.back()" class="btn btn-primary">
					<i class="fa fa-arrow-left"></i> Back
				</button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<?php 
	$serve="";
	if($_GET["services"]!="")
		$serve=" and service_idno='".$_GET["services"]."' ";
												
	$ex = $link->query("select * from services where service_idno=service_idno $serve order by service_idno limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from services t where t.service_idno='$rs[0]' and t.service_idno=t.service_idno ");

		while($rs = mysqli_fetch_array($ex)){	

		echo"
			<form action='#' method='POST' enctype='multipart/form-data'>
				<div class='row justify-content-center' style='margin:5px 5px 50px 5px;padding:10px'>
					<div class='col-lg-4' style='border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;'>
						<div class='row'>
							<div class='form-group mt-3'>
								<div class='text-center bg-light' style='margin-top:-10px'>
									<i class='".$rs["service_font"]." text-primary' style='margin:10px;font-size:100px'></i>
								</div>
								<div style='background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'>
									<div style='margin:5px' class='form-floating'>
										<input type='hidden' name='service_idno' value='$rs[0]' />
										<input type='text' class='form-control' name='service_name' value='".$rs["service_name"]."' placeholder='Service Name' required >
										<label for='service_name'>Service Name</label>
									</div>
									<div style='margin:5px' class='form-floating'>
										<input type='text' class='form-control' name='service_qlty' value='".$rs["service_qlty"]."' placeholder='Quality Tagline' required >
										<label for='service_qlty'>Quality Tagline</label>
									</div>
									<div style='margin:5px' class='form-floating'>
										<input type='text' class='form-control' name='service_expt' value='".$rs["service_expt"]."' placeholder='Expert Tagline' required >
										<label for='service_expt'>Expert Tagline</label>
									</div>
									<div style='margin:5px' class='form-floating'>
										<input type='text' class='form-control' name='service_mdrn' value='".$rs["service_mdrn"]."' placeholder='Modern Tagline' required >
										<label for='service_mdrn'>Modern Tagline</label>
									</div>
									<div style='margin:5px' class='form-floating'>
										<input type='text' class='form-control' name='service_font' value='".$rs["service_font"]."' placeholder='Font Awesome Icon' required >
										<label for='service_font'>Font Awesome Icon</label>
									</div>
								</div>
								<div class='text-center' style='margin:20px'>
									<button class='btn btn-primary rounded-pill' type='SUBMIT' name='upDate' style='width:200px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;'>SAVE & UPDATE</button>
								</div>
							</div>					
						</div>
					</div>
				</div>
			</form>
		  ";
		}		
	}			
?>			

<?php require("admin_footer.php");?>