<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
	if(isset($_POST['upDate'])){	
		$tid 	  = $_POST['tech_id'];
		$fullname = $_POST['fullname'];
		$position = $_POST['position'];
		$facebook = $_POST['facebook'];
		$mobphone = $_POST['mobphone'];

	$update = $link->query("UPDATE technicians set
		tech_id  = '$tid',
		fullname = '$fullname',
		position = '$position',
		facebook = '$facebook',
		mobphone = '$mobphone' where tech_id = '$tid'");

		if(($update)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>

<script> setActive("technicians"); </script>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Update Technician</h1>
			<button onClick="history.back()" class="btn btn-primary">
				<i class="fa fa-arrow-left"></i> Back
			</button>
		</div>
	</div>
</div>
<!-- Page Header End -->

<?php 
	$tech="";
	if($_GET["technicians"]!="")
		$tech=" and tech_id='".$_GET["technicians"]."' ";
												
	$ex = $link->query("select * from technicians where tech_id=tech_id $tech order by tech_id limit 1");

	while($rs = mysqli_fetch_array($ex)){	

		$ex = $link->query("select * from technicians t where t.tech_id='$rs[0]' and t.tech_id=t.tech_id ");

		while($rs = mysqli_fetch_array($ex)){	
		$name=$rs["fullname"];
		
		echo"
			<form action='#' method='POST' enctype='multipart/form-data'>
				<div class='row justify-content-center' style='margin:5px 5px 50px 5px;padding:10px'>
					<div class='col-lg-4' style='border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;'>
						<div class='row'>
							<div class='col-lg-12' style='margin-top:15px'>
								<div class='bg-light text-center'>
									<h2 class='text-primary text-uppercase'>$name</h2>
								</div>
							</div>						
							<div class='col-lg-5 form-group mt-3'>
								<div class='bg-light text-center'>
									<img style='min-height:235px;border-radius:4px;border:1px solid #bbb;width:100%;background:#fff;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;' ";
										if(file_exists("img/technicians/resized/$rs[0].jpg")){			
											echo" src='img/technicians/resized/$rs[0].jpg? ".date("h:i:s")." ' />";
										}else{
											echo" src='img/technicians.png' style='opacity:.5' />";
										}
									echo"
								</div>
								<div class='text-center' style='margin:20px'>
									<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
									<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
									<input class='btn btn-primary rounded-pill' style='width:200px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px' value='Change Photo' onclick=\"$('#b_file_$rs[0]').click();\"/>
								</div>
							</div>
							<div class='col-lg-7 form-group mt-3'>
								<div style='min-height:235px;background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'>
									<div class='form-floating'>
										<input type='hidden' name='tech_id' value='$rs[0]' />
										<input type='text' class='form-control' name='fullname' value='".$rs["fullname"]."' placeholder='Full Name' required >
										<label for='fullname'>Full Name</label>
									</div>
									<div class='form-floating'>
										<input type='text' class='form-control' name='position' value='".$rs["position"]."' placeholder='Position' required >
										<label for='position'>Position</label>
									</div>
									<div class='form-floating'>
										<input type='text' class='form-control' name='facebook' value='".$rs["facebook"]."' placeholder='Facebook Account' required >
										<label for='facebook'>Facebook Account</label>
									</div>
									<div class='form-floating'>
										<input type='text' class='form-control' name='mobphone' value='".$rs["mobphone"]."' placeholder='Cell Phone Number' required >
										<label for='mobphone'>Cell Phone Number</label>
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