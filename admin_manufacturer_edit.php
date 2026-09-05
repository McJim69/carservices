<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
	if(isset($_POST['upDate'])){	
		$mfid  = $_POST['mfid'];
		$name  = $_POST['name'];

	$update = $link->query("UPDATE manufacturer set
		mfid = '$mfid',
		name = '$name' where mfid = '$mfid'");

		if(($update)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>

<script> setActive("brand"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Update Manufacturer</h1>
				<button onClick="history.back()" class="btn btn-primary">
					<i class="fa fa-arrow-left"></i> Back
				</button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<?php 

	$cust="";
	if($_GET["manufacturer"]!="")
		$cust=" and mfid='".$_GET["manufacturer"]."' ";
												
	$ex = $link->query("select * from manufacturer where mfid=mfid $cust order by mfid limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from manufacturer t where t.mfid='$rs[0]' and t.mfid=t.mfid ");

	while($rs = mysqli_fetch_array($ex)){	

	if(isset($_POST["b_upImg_$rs[0]"])){
		move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "img/manufacturer/$rs[0].png");
		$link->query("update manufacturer set logo=1 where mfid='$rs[0]'");
		jump("");
	}						

	echo"
	<form action='#' method='POST' enctype='multipart/form-data'>
		<div class='container-xxl py-5 wow fadeInUp' data-wow-delay='0.1s'>
			<div class='container text-center' style='margin-top:-50px'>
				<div class='row justify-content-center'>
					<div class='col-lg-6' style='border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;'>
						<div class='row'>
							<div class='col-lg-6 form-group mt-3'>
								<div class='row-lg-12' style='min-height:150px;background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'>
									<div class='form-floating'>
										<img style='width:100%' ";
										if(file_exists("img/manufacturer/$rs[0].png")){		
											echo" src='img/manufacturer/$rs[0].png?".date("h:i:s")."' />";
										}else{
											echo" src='img/logo1.png' />";
										}
										echo"
									</div>
								</div>
								<div style='margin:20px'>
									<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
									<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
									<input class='btn btn-primary rounded-pill' value='Change Logo' onclick=\"$('#b_file_$rs[0]').click();\" style='width:160px; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;'/>
								</div>
							</div>
							<div class='col-lg-6 form-group mt-3'>
								<div class='row-lg-12' style='min-height:150px;background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'>
									<div class='form-floating'>	
										<input type='hidden' class='form-control' name='mfid' value='$rs[0]' />
										<input type='text' class='form-control text-uppercase' name='name' value='".$rs["name"]."' placeholder='Brand Name' required >
										<label for='name'>Brand Name</label>
									</div>
								</div>
								<div style='margin:20px'>
									<button class='btn btn-primary rounded-pill' type='SUBMIT' name='upDate' style='width:160px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;'>Update</button>
								</div>
							</div>
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

<?php require("admin_footer.php"); ?>
