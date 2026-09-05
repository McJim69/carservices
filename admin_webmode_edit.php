<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
	if(isset($_POST['upDate'])){	
		$modid = $_POST['mode_id'];
		$mname = $_POST['mode_name'];
		$mdesc = $_POST['description'];
		$ficon = $_POST['fonticon'];

	$update = $link->query("UPDATE site_mode set
		mode_id     = '$modid',
		mode_name   = '$mname',
		description = '$mdesc',
		fonticon    = '$ficon' where mode_id  = '$modid'") or die(mysqli_error($link));

		if(($update)== TRUE){
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
                <h1 class="display-3 text-white mb-3 animated slideInDown">Update Site Mode</h1>
				<button onClick="history.back()" class="btn btn-primary">
					<i class="fa fa-arrow-left"></i> Back
				</button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<?php 
	$mode="";
	if($_GET["site_mode"]!="")
		$mode=" and mode_id='".$_GET["site_mode"]."' ";
												
	$ex = $link->query("select * from site_mode where mode_id=mode_id $mode order by mode_id limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from site_mode t where t.mode_id='$rs[0]' and t.mode_id=t.mode_id ");

		while($rs = mysqli_fetch_array($ex)){	

		echo"
			<form action='#' method='POST' enctype='multipart/form-data'>
				<div class='row justify-content-center' style='margin:5px 5px 50px 5px;padding:10px'>
					<div class='col-lg-4' style='border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;'>
						<div class='row'>
							<div class='form-group mt-3'>
								<div class='text-center bg-light' style='margin-top:-10px'>
									<i class='".$rs["fonticon"]." text-primary' style='margin:10px;font-size:100px'></i>
								</div>
								<div style='background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'>
									<div style='margin:5px' class='form-floating'>
										<input type='hidden' name='mode_id' value='$rs[0]' />
										<input type='text' class='form-control' name='mode_name' value='".$rs["mode_name"]."' placeholder='Mode Name' required >
										<label for='mode_name'>Mode Name</label>
									</div>
									<div style='margin:5px' class='form-floating'>
										<input type='text' class='form-control' name='description' value='".$rs["description"]."' placeholder='Description' required >
										<label for='description'>Description</label>
									</div>									
									<div style='margin:5px' class='form-floating'>
										<input type='text' class='form-control' name='fonticon' value='".$rs["fonticon"]."' placeholder='Font Awesome Icon' required >
										<label for='fonticon'>Font Awesome Icon</label>
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