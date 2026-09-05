<?php 
	require('header.php');
	require('navbar.php');
	
	if(isset($_POST['upDate'])){	
		$usrid = $_POST['usrid'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$uname = $_POST['username'];
		$pword = $_POST['password'];
		$accnt = $_POST['account'];
		
	$update = $link->query("UPDATE users SET
		usrid    = '$usrid',
		fname    = '$fname',
		lname    = '$lname',
		email    = '$email',
		username = '$uname',
		password = '$pword',
		account  = '$accnt' where usrid = '$usrid'");

		if(($update)== TRUE){
			echo"<script>window.location.href='user_profile.php';</script>";
		}
	}
	
	$ID = $_SESSION['usid'];
	
	$ex = $link->query("select * from users u where u.usrid='$ID' and u.usrid=u.usrid ");
	$ii=1;

	while($rs = mysqli_fetch_array($ex)){	
		$name="".$rs["fname"]." ".$rs["lname"]."";

		if(isset($_POST["b_upImg_$rs[0]"])){
			move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "../img/users/$rs[0].jpg");
			$link->query("update users set photo=1 where usrid='$rs[0]'");
			jump("");

			$origFile="../img/users/$rs[0].jpg";
			$destFile="../img/users/resized/$rs[0].jpg";
					
			$source = imagecreatefromjpeg($origFile);
			list($width, $height) = getimagesize($origFile);

			$newWidth = 300;
			$newHeight = 300;

			$thumb = imagecreatetruecolor($newWidth, $newHeight);
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
			imagejpeg($thumb, $destFile, 80);
		}
	//
?>

<div class="content-wrapper">

<?php
	echo"
	<h2>$name</h2>
		<div class='row'>
			<div class='col-lg-3'>
				<div class='card'>
					<div class='card-body'><h3>Profile Picture</h3><br>
						<div class='row' style='height:355px'>
							<div class='col text-center'>
								<img style='width:80%;border-radius:4px' ";
								if(file_exists("../img/users/resized/$rs[0].jpg")){			
									echo" src='../img/users/resized/$rs[0].jpg?".date('h:i:s')."' />";
								}else{
									echo" src='../img/user.png' />";
								}
								echo"
								<div style='position:absolute;bottom:0;width:100%;padding-right:23px'>
								<form action='#' method='POST' enctype='multipart/form-data'>	
									<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
									<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
									<input class='btn btn-inverse-primary' value='Change Photo' onclick=\"$('#b_file_$rs[0]').click();\" style='width:100%'/>									
								</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
			<div class='col-lg-5'>
				<div class='card'>
					<div class='card-body'><h3>Profile Details</h3><br>
						<div class='row' style='height:355px'>
							<div class='col'>
								<form action='#' method='POST' enctype='multipart/form-data'>	
								<div class='row'>
									<div class='col-lg-6 form-group'>
										<input type='hidden' name='usrid' value='$rs[0]' />
										<div class='text-primary'>First Name</div>
										<input type='text' class='bg-dark text-light form-control' name='fname' value='".$rs['fname']."' placeholder='First Name' required >
									</div>
									<div class='col-lg-6 form-group'>
										<div class='text-primary'>Last Name</div>
										<input type='text' class='bg-dark text-light form-control' name='lname' value='".$rs['lname']."' placeholder='Lastname' required >
									</div>
								</div>
								<div class='row'>
									<div class='col-lg-6 form-group'>
										<div class='text-primary'>Email Address</div>
										<input type='email' class='bg-dark text-light form-control' name='email' value='".$rs['email']."' placeholder='Email Address' required >
									</div>
									<div class='col-lg-6 form-group'>
										<div class='text-primary'>Username</div>
										<input type='text' class='bg-dark text-light form-control' name='username' value='".$rs['username']."' placeholder='Username' required >
									</div>
								</div>	
								<div class='row'>
									<div class='col-lg-6 form-group'>
										<div class='text-primary'>Password</div>
										<input type='text' class='bg-dark text-light form-control' name='password' value='".$rs['password']."' placeholder='Password' required >
									</div>
									<div class='col-lg-6 form-group'>
										<div class='text-primary'>Account Type</div>
										<input type='text' class='bg-dark text-light form-control' name='account' placeholder='Account Type' value='".$rs['account']."' readonly We>
									</div>
								</div>	
								<div style='position:absolute;bottom:0;width:100%;padding-right:6px;margin-left:-10px'>
									<div class='col form-group text-center' style='margin-bottom:0px;margin-top:10px'>
										<input class='btn btn-inverse-primary' type='SUBMIT' name='upDate' value='Save and Update' style='width:100%;padding:8px'/>
									</div>
								</div>				  
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>";

		echo"<div class='col-lg-4' grid-margin stretch-card>";
			require("todolist.php");
		echo"</div>";
			
		echo"</div>";
	}
?>

</div>

<!-- User Profile End -->

<?php require('footer.php');?>
