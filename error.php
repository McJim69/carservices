<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
?>

<script>setActive("users");</script>

<br><br>
	<section id="contact" class="contact">
		<div class="container" data-aos="fade-up" style="text-align:center">
			<img src="img/error.png" height="250"><br><br>
			<h3 class='text-primary'>Something went wrong :</h3>
			<h4 class='text-danger text-center'>

			<?php echo $error; ?>

			</h4>
			<h4>PLEASE TRY AGAIN</h4>
		
			<h7 class="text-uppercase">Need help? Check us on email</h7>
			<h6 class="text-primary">
				<i class="icofont-email"></i><a href="https://www.email.com/jcmcyberworks">www.email.com/jcmcyberworks</a>
			</h6><br>
			<h1 class="text-primary"><button style="font-size:20px" class="btn btn-success" onclick="javascript:history.back()">Retry</button></h1>
		</div>
	</section>
<br>

<?php require("admin_footer.php"); } } ?>
