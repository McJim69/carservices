<?php
	require("admin_header2.php");
	require("topbar.php");
	require("navbar.php");

	$msg="";
	if(isset($_POST["login"])){
		$ex=$link->query("SELECT * FROM users WHERE username='".$_POST["user"]."' AND password='".$_POST["pass"]."' ");
		
		if($rs=mysqli_fetch_array($ex)){
			$exx=$link->query("SELECT * from validity WHERE validity>'".date("Y-m-d")."'");
		//	$exx=$link->query("SELECT * from users WHERE status=1 AND usrid='$rs[0]'");

			if($rs1=mysqli_fetch_array($exx)){
				$_SESSION["usid"]=$rs[0];
				$_SESSION["mail"]=$rs["email"];
				$_SESSION["user"]=$rs["username"];
				$_SESSION["pass"]=$rs["password"];	
				$_SESSION["fnam"]=$rs["fname"];	
				$_SESSION["lnam"]=$rs["lname"];	
				$_SESSION["type"]=$rs["account"];
				$_SESSION["pics"]=$rs["photo"];

			echo"<script>window.location.href = 'admin2/';</script>";
		
		}else			
		$msg = '
			<script type="text/javascript">
				jQuery(function validation(){
					swal("Access Denied!", "Expired License Key or Validation!", "warning", {
						button: "Retry",
					});
				});
			</script>
		';
		
		}else
		$msg = '
			<script type="text/javascript">
				jQuery(function validation(){
					swal("Access Denied!", "Invalid Username or Password!", "warning", {
						button: "Retry",
					});
				});
			</script>
		';
	}
?>

<script> setActive("admin"); </script>

<!-- Login Start -->
<form action="admin_login.php" method="POST" enctype="multipart/form-data">
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center">
            <div class="row justify-content-center" style="margin-bottom:20px;">
                <div class="col-lg-4" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; background: linear-gradient(135deg, #000000, #434343);margin-bottom:-25px;padding:40px;border-radius:10px">
					<img src="img/favicon.png" height="150">
                      <h2 class="text-light">ADMINISTRATOR</h2>
					   <h2 class="text-light">LOGIN</h2>
						<div class="mt-5 mt-lg-0" data-aos="fade-right" data-aos-delay="100">											
							<div class="row" style="margin-bottom:-65px">
								<?php echo $msg;?>
								<div class="form-group mt-3">
									<input class="form-control" type="text" name="user" placeholder="Username" required style="font-size:20px;border-radius:5px">
								</div>
								<div class="form-group mt-3">
									<input type="password" class="form-control" name="pass" placeholder="Password" required style="font-size:20px;border-radius:5px">
								</div>		
							</div>	
						</div>
					<br><br>
					<br><br>
					<input type='submit' class="btn btn-primary rounded-pill py-3 px-5" name='login' value='Log In' style="margin:5px;width:150px">
					<a class="btn btn-primary rounded-pill py-3 px-5" href="index.php" style="margin:5px;width:150px">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Login End -->

<?php require("footer.php");?>