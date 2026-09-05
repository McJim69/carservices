<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
	if(isset($_POST['submit'])){	

	$insert = $link->query("INSERT INTO  users VALUES (0,
		'".$_POST["fname"]."',
		'".$_POST["lname"]."',
		'".$_POST["email"]."',
		'".$_POST["username"]."',
		'".$_POST["password"]."',
		'".$_POST["account"]."',0,0)");

		if(($insert)== TRUE){
			echo"<script>window.location.href='admin_users.php';</script>";
		}
	}
?>

<script>setActive("system");</script>
<script>setActive("users");</script>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Add User</h1>
			<button onClick="history.back()" class="btn btn-primary"><i title="Back to List" class="fa fa-arrow-left text-light"></i> Back to List</span>
		</div>
	</div>
</div>
<!-- Page Header End -->

<form action="#" method="POST" enctype="multipart/form-data">

<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
	<div class="container text-center" style="margin-top:-50px">
		<div class="row justify-content-center">
			<div class="col-lg-5" style="border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
				<div class="row" style='padding-top:15px'>
					<div>
						<div class='form-floating' style='margin:5px'>
							<input type='text' class='form-control' name='fname' placeholder='First Name' required >
							<label for='fname'>First Name</label>
						</div>
						<div class='form-floating' style='margin:5px'>
							<input type='text' class='form-control' name='lname' placeholder='Last Name' required >
							<label for='lname'>Last Name</label>
						</div>
						<div class='form-floating' style='margin:5px'>
							<input type='email' class='form-control' name='email' placeholder='Email Address' required >
							<label for='email'>Email Address</label>
						</div>
						<div class='form-floating' style='margin:5px'>
							<input type='text' class='form-control' name='username' placeholder='Username' required >
							<label for='username'>Username</label>
						</div>
						<div class='form-floating' style='margin:5px'>
							<input type='text' class='form-control' name='password' placeholder='Password' required >
							<label for='password'>Password</label>
						</div>
						<div class='form-floating' style='margin:5px'>
							<select type='text' class='form-control' name='account' required  style='background:#fff'>
								<option value=''>Account Type</option>					
								<option value='Admin'>Admin</option>
								<option value='Encoder'>Encoder</option>
								<option value='Manager'>Manager</option>
								<option value='Proprietor'>Proprietor</option>
								<option value='Webmaster'>Webmaster</option>
							</select>
							<label for='account'>Account Type</label>
						</div>
					</div>
				</div>
				<div style="margin:20px">
					<button class="btn btn-primary rounded-pill" type="SUBMIT" name="submit" style="width:200px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">SUBMIT</button>
				</div>
			</div>
		</div>
	</div>
</div>	

</form>

<?php require("admin_footer.php");?>