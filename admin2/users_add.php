<?php 
	require("header.php");
	require("navbar.php");

	$useq = $link->query("SELECT MAX(usrid) FROM users");
	$resu = $useq->fetch_array();
	$usid = $resu[0]+1;
	
	if(isset($_POST['submit'])){	

	$insert = $link->query("INSERT INTO  users VALUES (
		'".$usid."',
		'".$_POST["fname"]."',
		'".$_POST["lname"]."',
		'".$_POST["email"]."',
		'".$_POST["username"]."',
		'".$_POST["password"]."',
		'".$_POST["account"]."',0,0)");
	
		$name1=$_POST["fname"]; 
		$name2=$_POST["lname"]; 

		if(($insert)== TRUE){

			echo'
			<script type="text/javascript">
				swal({
				  title: "Success!",
				  text: "User '.$name1.' '.$name2.' added successfully!",
				  type: "success"
				}).then(function() {
					window.location.href = "users_edit.php?users='.$usid.'";
				})
			</script>';

		}else{
			$error = mysqli_error($link);
			echo'
			<script type="text/javascript">
				jQuery(function validation(){
					swal("ERROR!", "'.$error.'", "warning", {
						button: "Retry",
					});
				});
			</script>';		
		}
	}
?>

<div class="content-wrapper">
	<h2>Add User &nbsp; 
		<a href='users.php' title='Back' class='btn btn-sm btn-outline-info'> 
			<i class='mdi mdi-arrow-left'></i>Back
		</a>
		<a href='users_add.php' title='Refresh' class='btn btn-sm btn-outline-info'>
			<i class='mdi mdi-magnify'></i>Refresh
		</a>
	</h2> 
	<div class="row">	
		<div class="col-lg-3">
			<div class="card">
				<div class="card-body">	
				<h4 class="card-title">User Photo</h4>				
					<div class="text-center">
						<img style="width:100%" 
						src="../img/user.png" />
					</div>
					<div class="form-group">
						<span class="form-control btn btn-outline-info btn-block" style="margin-top:5px;margin-bottom:-5px">
							User ID Number: <?php echo $usid;?>
						</span>
					</div>
					<div class="form-group" style="margin-bottom:-8px">
						<input class="form-control btn btn-outline-info btn-block" value="Change Photo Later" onclick="$('#b_file_$cid').click();"/>
					</div>
				</div>
			</div>
		</div>
		
	<!-- Submit Form Start-->
		<div class="col-lg-4">
			<div class="card">
				<div class="card-body" style="color:#bbb">
					<h4 class="card-title">Submit Form</h4>

					<form action="#" method="POST" enctype="multipart/form-data">
					<div class='row'>
						<div class='col-lg-12'>
							<div class='row'>
								<div class="col-lg-6 form-group">				
									<div>First Name</div>
									<input type="text" class="form-control bg-dark text-secondary" name="fname" placeholder="First Name" required >
								</div>	
								<div class="col-lg-6 form-group">				
									<div>Last Name</div>
									<input type="text" class="form-control bg-dark text-secondary" name="lname" placeholder="Last Name" required >
								</div>	
								<div class="col-lg-12 form-group">				
									<div>Email</div>
									<input type="email" class="form-control bg-dark text-secondary" name="email" placeholder="Email" >
								</div>	
								<div class="col-lg-12 form-group">				
									<div>Username</div>
									<input type="text" class="form-control bg-dark text-secondary" name="username" placeholder="Username" required >
								</div>	
								<div class="col-lg-12 form-group">				
									<div>Password</div>
									<input type="text" class="form-control bg-dark text-secondary" name="password" placeholder="Password" required >
								</div>	
								<div class="col-lg-12 form-group">				
									<div>Account Type</div>
									<select type='text' class="form-control bg-dark text-secondary" name='account' required >
										<option value=''>Account Type</option>					
										<option value='Admin'>Admin</option>
										<option value='Encoder'>Encoder</option>
										<option value='Manager'>Manager</option>
										<option value='Proprietor'>Proprietor</option>
										<option value='Webmaster'>Webmaster</option>
									</select>
								</div>
								<div class="col-lg-12 form-group" style="margin-bottom:-10px">
									<button class="form-control btn btn-outline-info btn-block" type="SUBMIT" name="submit">Submit</button>
								</div>
							</div>
						</div>
					</div>	

					</form>	
	
				</div>
			</div>
		</div>
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
