<?php 
	require("header.php");
	require("navbar.php");
	
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

<?php	
	$users="";
	if($_GET["users"]!="")
		$users=" and usrid='".$_GET["users"]."' ";
												
	$ex = $link->query("select * from users where usrid=usrid $users order by usrid limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from users u where u.usrid='$rs[0]' and u.usrid=u.usrid ");
	$ii=1;

	while($rs = mysqli_fetch_array($ex)){	
	$name="".$rs["fname"]." ".$rs["lname"]."";
	$usid=$rs[0];

	if(isset($_POST["b_upImg_$rs[0]"])){
		move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "../img/users/$rs[0].jpg");
		$link->query("update users set photo=1 where cid='$rs[0]'");
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
?>

<div class="content-wrapper">
	<h2>Edit User &nbsp; 
		<a href='users.php' title='Back' class='btn btn-sm btn-outline-info'> 
			<i class='mdi mdi-arrow-left'></i>Back
		</a>
	</h2> 
	<div class="row">	
		<div class="col-lg-3">
			<div class="card">
				<div class="card-body">	
				<h4 class="card-title">User Photo</h4>				
					<div class="text-center">
					<?php
						echo"
						<img style='width:100%' ";
						if(file_exists("../img/users/resized/$rs[0].jpg")){			
							echo" src='../img/users/resized/$rs[0].jpg? ".date("h:i:s")." ' />";
						}else{
							echo" src='../img/user.png' style='opacity:.5' />";
						}					
					?>
					</div>
					<div class="form-group">
						<span class="form-control btn btn-outline-info btn-block" style="margin-top:5px;margin-bottom:-5px">
							User ID Number: <?php echo $usid;?>
						</span>
					</div>
					<div class="form-group" style="margin-bottom:-8px">
					<form action="#" method="POST" enctype="multipart/form-data">
						<?php
						  echo"
							<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
							<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
							<input class='form-control btn btn-outline-info btn-block' value='Change User Photo' onclick=\"$('#b_file_$rs[0]').click();\"/>
						  ";
						?>
					</form>	
					</div>
				</div>
			</div>
		</div>
		
	<!-- Submit Form Start-->
		<div class="col-lg-4">
			<div class="card">
				<div class="card-body" style="color:#bbb">
					<h4 class="card-title">Submit Form</h4>
					<div class='row'>
					<form action="#" method="POST" enctype="multipart/form-data">
						<div class='col-lg-12'>
							<div class='row'>
								<div class="col-lg-6 form-group">				
									<div>First Name</div>
									<input 
										required 
										type="text" 
										name="fname" 
										placeholder="First Name" 
										value="<?php echo $rs["fname"];?>"
										class="form-control bg-dark text-secondary" 
									>
								</div>	
								<div class="col-lg-6 form-group">				
									<div>Last Name</div>
									<input 
										required 
										type="text" 
										name="lname" 
										placeholder="Last Name" 
										value="<?php echo $rs["lname"];?>"
										class="form-control bg-dark text-secondary" 
									>
								</div>	
								<div class="col-lg-12 form-group">				
									<div>Email</div>
									<input 
										type="email" 
										name="email" 
										placeholder="Email" 
										value="<?php echo $rs["email"];?>"										
										class="form-control bg-dark text-secondary" 
									>
								</div>	
								<div class="col-lg-12 form-group">				
									<div>Username</div>
									<input 
										required 
										type="text" 
										name="username" 
										placeholder="Username" 
										value="<?php echo $rs["username"];?>"
										class="form-control bg-dark text-secondary" 
									>
								</div>	
								<div class="col-lg-12 form-group">				
									<div>Password</div>
									<input 
										required 
										type="text" 
										name="password" 
										placeholder="Password" 
										value="<?php echo $rs["password"];?>"										
										class="form-control bg-dark text-secondary" 
									>
								</div>	
								<div class="col-lg-12 form-group">				
									<div>Account Type</div>
									<select 
										required 
										type='text' 
										name='account' 
										class="form-control bg-dark text-secondary" 
									>
										<option value='<?php echo $rs["account"];?>'><?php echo $rs["account"];?></option>					
										<option value='Admin'>Admin</option>
										<option value='Encoder'>Encoder</option>
										<option value='Manager'>Manager</option>
										<option value='Proprietor'>Proprietor</option>
										<option value='Webmaster'>Webmaster</option>
									</select>
								</div>
								<div class="col-lg-12 form-group" style="margin-bottom:-10px">
									<button class="form-control btn btn-outline-info btn-block" type="SUBMIT" name="submit">Save & Update</button>
								</div>
							</div>
						</div>
					</form>	
					</div>	
				</div>
			</div>
		</div>

	<?php } } ?>		

<!-- Submit Form End -->
	
	<!-- Users List Start -->
		<div class="col-lg-5">
			<div class="card">
				<div class="card-body">		
				<h4 class="card-title">Users List</h4>									
					<div class="table-responsive" style="height:420px">	
						<table class="table table-dark table-hover">
							<thead class="bg-dark">
								<tr>
									<th>#</th>
									<th>Pic</th>
									<th>Name</th>
									<th>Position</th>
									<th>Address</th>
									<th>Phone</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
							
								$i=1;
								$ex=$link->query("SELECT * FROM users ORDER BY usrid");
								
								while($rs=mysqli_fetch_array($ex)){
								  echo"
									<tr onclick=\"jump('users_edit.php?users=$rs[0]')\">
										<td>$i</td>
										<td style='padding:0 0 0 10px;margin:0 0 0 0;'>
										<img style='height:30px;width:30px;border-radius:50%;padding:0;margin:0' ";
											if(file_exists("../img/users/resized/$rs[0].jpg")){			
												echo" src='../img/users/resized/$rs[0].jpg? ".date("h:i:s")." ' />";
											}else{
												echo" src='../img/user.png' />";
											}

											echo"
										
										</td>
										<td>".$rs["fname"]." ".$rs["lname"]."</td>
										<td>".$rs["account"]."</td>
										<td>".$rs["username"]."</td>
										<td>".$rs["password"]."</td>
									</tr>
								  ";
								$i++;
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>		
		<!-- List End -->
	</div>
</div>

<?php require("footer.php");?>
