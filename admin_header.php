<?php 
	require("admin_connect.php");
	require("admin_language.php");

	if(!isset($_SESSION['user'])){
		header("location:admin_login.php");
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta content="<?php echo _TITLE;?>" name="keywords">
    <meta content="Car Aircon, <?php echo _DESC;?>" name="description">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

	<meta name="google-adsense-account" content="ca-pub-4818333944764715">
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4818333944764715" crossorigin="anonymous"></script>
    
	<title><?php echo _TITLE;?></title>

    <!-- Favicon -->
    <link href="img/favicon.png" rel="shortcut icon">
	<link href="img/favicon.png" rel="apple-touch-icon">

    <!-- Web Fonts -->
    <link href="lib/webfonts/google-fonts.css" rel="stylesheet"> 
	<link href="lib/font-awesome/css/all.min.css" rel="stylesheet"> 
    <link href="lib/bootstrap/css/bootstrap-icons.css" rel="stylesheet">
	
    <!-- Libraries Stylesheet -->
	<link href="lib/owlcarousel/css/owl.carousel.min.css" rel="stylesheet">
	<link href="lib/animate/animate.min.css" rel="stylesheet">
	<link href="lib/css/bootstrap.min.css" rel="stylesheet">
	<!--<link href="lib/preloader/loader.css" rel="stylesheet">-->
	<link href="lib/venobox/venobox.css" rel="stylesheet">
	<link href="lib/css/custom.css" rel="stylesheet">
	<link href="lib/css/style.css" rel="stylesheet">
	<script src="lib/sweetalert/sweetalert.js"></script>
	<script src="lib/jquery/jquery.min.js"></script>

	<script>
		if (window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");				
		
		function conf(){
			return confirm("Are you sure?");
		}
		function getID(id){
			return document.getElementById(id);
		}		
		function setActive(id){
			getID(id).style.color="red";
		//	getID(id).style.fontWeight="bold";
		}
		function jump(page){
			window.location=page;
		}
	</script>
	
</head>

<?php
	function jump($page){
		echo "<script>window.location='$page'</script>";
	}
?>	

<body>

<!-- Page Preloader
<script type="text/javascript" src="lib/preloader/loader.js"></script>
-->