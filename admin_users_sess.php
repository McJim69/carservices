<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");

	if(isset($_POST['upDate'])){	
		$usrid = $_POST['usrid'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$uname = $_POST['username'];
		$pword = $_POST['password'];
		$accnt = $_POST['account'];
		

	$update = $link->query("UPDATE users set
		usrid    = '$usrid',
		fname    = '$fname',
		lname    = '$lname',
		email    = '$email',
		username = '$uname',
		password = '$pword',
		account  = '$accnt' where usrid = '$usrid'");

		if(($update)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>

<script> setActive("profile"); </script>
<script> setActive("users"); </script>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Users Profile</h1>
			<button onClick="history.back()" class="btn btn-primary">
				<i class="fa fa-arrow-left"></i> Back
			</button>
		</div>
	</div>
</div>
<!-- Page Header End -->

<?php	
	
	$ID = $_SESSION["usid"];
	
	$ex = $link->query("select * from users u where u.usrid='$ID' and u.usrid=u.usrid ");
	$ii=1;

	while($rs = mysqli_fetch_array($ex)){	
		$name="".$rs["fname"]." ".$rs["lname"]."";

		if(isset($_POST["b_upImg_$rs[0]"])){
			move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "img/users/$rs[0].jpg");
			$link->query("update users set photo=1 where usrid='$rs[0]'");
			jump("");

			$origFile="img/users/$rs[0].jpg";
			$destFile="img/users/resized/$rs[0].jpg";
					
			$source = imagecreatefromjpeg($origFile);
			list($width, $height) = getimagesize($origFile);

			$newWidth = 300;
			$newHeight = 300;

			$thumb = imagecreatetruecolor($newWidth, $newHeight);
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
			imagejpeg($thumb, $destFile, 80);
		}	
		
		echo"	
		<form action='#' method='POST' enctype='multipart/form-data'>
			<div class='row justify-content-center' style='margin:-10px 5px 40px 5px;padding:10px'>
				<div class='col-lg-5' style='border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;'>
					<div class='row'>
						<div class='col-lg-12' style='margin-top:15px'>
							<div class='bg-light text-center'>
								<h2 class='text-primary text-uppercase'>$name</h2>
							</div>
						</div>						
						<div class='col-lg-6 form-group mt-3'>
							<div class='bg-light text-center'>
								<img style='min-height:365px;border-radius:4px;border:1px solid #bbb;width:100%;background:#fff;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;' ";
								if(file_exists("img/users/resized/$rs[0].jpg")){			
									echo" src='img/users/resized/$rs[0].jpg? ".date("h:i:s")." ' />";
								}else{
									echo" src='img/user.png' style='opacity:.5' />";
								}
							echo"
							</div>
							<div class='text-center' style='margin:20px'>
								<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
								<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
								<input class='btn btn-primary rounded-pill' style='width:100%;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px' value='Change Photo' onclick=\"$('#b_file_$rs[0]').click();\"/>
							</div>
						</div>
						<div class='col-lg-6 form-group mt-3'>
							<div style='min-height:365px;background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;width:100%;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'>
								<div class='form-floating'>
									<input type='hidden' name='usrid' value='$rs[0]' />
									<input type='text' class='form-control' name='fname' value='".$rs["fname"]."' placeholder='First Name' required >
									<label for='fname'>First Name</label>
								</div>
								<div class='form-floating'>
									<input type='text' class='form-control' name='lname' value='".$rs["lname"]."' placeholder='Lastname' required >
									<label for='lname'>Last Name</label>
								</div>
								<div class='form-floating'>
									<input type='email' class='form-control' name='email' value='".$rs["email"]."' placeholder='Email Address' required >
									<label for='email'>Email Address</label>
								</div>
								<div class='form-floating'>
									<input type='text' class='form-control' name='username' value='".$rs["username"]."' placeholder='Username' required >
									<label for='username'>Username</label>
								</div>

								<div class='form-floating'>
									<input type='text' class='form-control' name='password' value='".$rs["password"]."' placeholder='Password' required >
									<label for='password'>Password</label>
								</div>
								<div class='form-floating'>
									<input type='text' class='form-control' name='account' placeholder='Account Type' value='".$rs["account"]."' readonly style='background:#fff'>
									<label for='account'>Account Type</label>
								</div>
							</div>
							<div class='text-center' style='margin:20px'>
								<button class='btn btn-primary rounded-pill' type='SUBMIT' name='upDate' style='width:100%;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;'>SAVE & UPDATE</button>
							</div>
						</div>					
					</div>
				</div>
			</div>
		</form>
				
		";
	}			
?>					

</div>

<?php require("admin_footer.php");?>