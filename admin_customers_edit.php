<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
	if(isset($_POST['upDate'])){	
		$cid 	   = $_POST['cid'];
		$fullname  = $_POST['fullname'];
		$position  = $_POST['position'];
		$address   = $_POST['address'];
		$phone 	   = $_POST['phone'];
		$testimony = $_POST['testimony'];

	$update = $link->query("UPDATE customers set
		cid  	  = '$cid',
		fullname  = '$fullname',
		position  = '$position',
		address   = '$address',
		phone 	  = '$phone',
		testimony = '$testimony' where cid = '$cid'");

		if(($update)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>

<script> setActive("clients"); </script>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Update Customer</h1>
			<div>
				<button onClick="history.back()" class="btn btn-primary">
					<i class="fa fa-arrow-left"></i> Back
				</button>
			</div>			
		</div>
	</div>
</div>
<!-- Page Header End -->

<form action='#' method='POST' enctype='multipart/form-data'>

<?php
	$cust="";
	if($_GET["customers"]!="")
		$cust=" and cid='".$_GET["customers"]."' ";
												
	$ex = $link->query("select * from customers where cid=cid $cust order by cid limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from customers t where t.cid='$rs[0]' and t.cid=t.cid ");

	while($rs = mysqli_fetch_array($ex)){	

	if(isset($_POST["b_upImg_$rs[0]"])){
		move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "img/customers/$rs[0].jpg");
		$link->query("update customers set photo_id=1 where cid='$rs[0]'");
		jump("");

		$origFile="img/customers/$rs[0].jpg";
		$destFile="img/customers/resized/$rs[0].jpg";
					
		$source = imagecreatefromjpeg($origFile);
		list($width, $height) = getimagesize($origFile);

		$newWidth = 300;
		$newHeight = 300;

		$thumb = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		imagejpeg($thumb, $destFile, 80);
	}						

	echo"
		<div class='container-xxl py-5 wow fadeInUp' data-wow-delay='0.1s'>
			<div class='container text-center' style='margin-top:-50px'>
				<div class='row justify-content-center'>
					<div class='col-lg-6' style='border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;'>
						<div class='row'>
							<div class='col-lg-6 form-group mt-3'>
								<div class='row-lg-12' style='min-height:297px;background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'>
									<div class='form-floating'>
										<img style='width:100%' ";
										if(file_exists("img/customers/resized/$rs[0].jpg")){		
											echo" src='img/customers/resized/$rs[0].jpg?".date("h:i:s")."' />";
										}else{
											echo" src='img/user.png' />";
										}
										echo"
									</div>
								</div>
								<div style='margin:20px'>
									<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
									<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
									<input class='btn btn-primary rounded-pill' value='Change Photo' onclick=\"$('#b_file_$rs[0]').click();\" style='width:160px; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;'/>
								</div>
							</div>
							<div class='col-lg-6 form-group mt-3'>
								<div class='row-lg-12' style='min-height:298px;background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'>
									<input type='hidden' name='cid' value='$rs[0]' />
									<div class='form-floating'>
										<input type='text' class='form-control' name='fullname' placeholder='Full Name' value='".$rs["fullname"]."' required >
										<label for='fullname'>Full Name</label>
									</div>	
									<div class='form-floating'>								
										<input type='text' class='form-control' name='position' placeholder='Position' value='".$rs["position"]."' required >
										<label for='position'>Position</label>
									</div>	
									<div class='form-floating'>								
										<input type='text' class='form-control' name='address' placeholder='Address' value='".$rs["address"]."' required >
										<label for='address'>Address</label>
									</div>
									<div class='form-floating'>								
										<input type='text' class='form-control' name='phone' placeholder='Phone Number' value='".$rs["phone"]."' required >
										<label for='phone'>Phone Number</label>
									</div>
									<div class='form-floating'>								
										<textarea type='text' class='form-control' rows='1' name='testimony' placeholder='Testimony'>".$rs["testimony"]."</textarea>
										<label for='testimony'>Testimony</label>
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
	  ";
	}		
  }			
?>			

</form>

<?php require("admin_footer.php"); ?>
