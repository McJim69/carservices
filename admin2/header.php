<?php 
	require("connect.php");
	require("language.php");
	
	if(!isset($_SESSION['user'])){
		header("location:login.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	<meta content="<?php echo _TITLE;?>" name="keywords">
    <meta content="Car Aircon, <?php echo _DESC;?>" name="description">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo _TITLE;?> - Admin</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../favicon.png">

    <!-- Plugins -->
	<link href="../lib/venobox/venobox.css" rel="stylesheet">
	<link href="../lib/font-awesome/css/all.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">

    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
	<script src="../lib/sweetalert/sweetalert.js"></script>
	<script src="../lib/jquery/jquery.min.js"></script>

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

<div class="container-scroller">

<?php require("sidebar.php");?>

<div class="container-fluid page-body-wrapper">

<div class="main-panel">
