<?php 
	require("header2.php");

	$msg="";
	if (isset($_POST["login"])) {
		$user = $link->real_escape_string($_POST["user"]);
		$pass = $link->real_escape_string($_POST["pass"]);

		$ex = $link->query("SELECT * FROM users WHERE username='$user' AND password='$pass'") or die(mysqli_error($link));
		
		if($rs=mysqli_fetch_array($ex)){
			
			$exx=$link->query("SELECT * from validity WHERE validity>'".date("Y-m-d")."'");

			if($rs1=mysqli_fetch_array($exx)){
				$_SESSION["usid"]=$rs[0];
				$_SESSION["mail"]=$rs["email"];
				$_SESSION["user"]=$rs["username"];
				$_SESSION["pass"]=$rs["password"];	
				$_SESSION["fnam"]=$rs["fname"];	
				$_SESSION["lnam"]=$rs["lname"];	
				$_SESSION["type"]=$rs["account"];
				$_SESSION["pics"]=$rs["photo"];

			echo"<script>window.location.href = 'index.php';</script>";
		
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

<style>
	.father{
		background: rgb(0,0,0);
		border-radius: 20px;
		margin-bottom: 50px;
		box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; 
		background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(2,0,36,1) 100%, rgba(0,212,255,1) 100%);
	}
	.mother{
		height: 710px;
		position: relative;
	}
	.child{
		top: 50%;
		left: 50%;
		margin: 0; 
		border-radius:10px;					
		position: absolute;
		border:1px solid #bbb; 
		transform: translate(-50%, -50%);
		box-shadow: rgba(255, 255, 255, 0.35) 0px 5px 10px;
		background: linear-gradient(135deg, #000000, #434343);padding:30px 30px 20px 30px;
	}
</style>

<div class="content-wrapper bg-light justify-content-center father">
	<div class="row">
		<div class="col-lg-12" style="padding:20px">
            <div class="row justify-content-center mother"><?php require("time.php");?>
				<div class="col-lg-3 child">
					<div class="row">
						<div class="col col-lg-12">
							<div class="text-center">
								<img src="../img/favicon.png" height="120" style="margin-bottom:20px">
							</div>	
							<div>
								<h2 class="text-center">LOGIN</h2>
							</div>
						</div>
					</div>
					<form action="#" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col col-lg-12" style="margin-top:10px">
								<?php echo $msg;?>
								<div class="form-group">
									<input class="btn btn-outline-primary btn-lg text-dark btn-block bg-secondary" type="text" name="user" placeholder="Username" required>
								</div>
								<div class="form-group">
									<input class="btn btn-outline-primary btn-lg text-dark btn-block bg-secondary" type="password" name="pass" placeholder="Password" required>
								</div>		
							</div>
						</div>	
						<div class="row">
							<div class="col-lg-12" style="margin-top:10px">
								<div class="row">
									<div class="col-lg-6 form-group">							
										<input style='padding:10px' class="btn btn-primary btn-block" type='submit' name='login' value='Log In'>
									</div>
									<div class="col-lg-6 form-group">							
										<a style='padding:10px' class="btn btn-primary btn-block" href="../index.php">Cancel</a>
									</div>
								</div>
							</div>
						</div>
					</form>					
				</div>
			</div>
		</div>
	</div>
</div>

<?php //require("footer.php");?>
