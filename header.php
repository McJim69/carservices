<?php 
	require("connect.php");
	require("language.php");

	if(isset($_SESSION['user'])){
		header("location:admin/");
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

    <title><?php echo _TITLE;?></title>

    <!-- Favicon -->
    <link href="img/favicon.png" rel="shortcut icon">
	<link href="img/favicon.png" rel="apple-touch-icon">

    <!-- Fonts -->
	<link href="lib/icofont/icofont.min.css" rel="stylesheet"> 
    <link href="lib/webfonts/google-fonts.css" rel="stylesheet"> 
	<link href="lib/font-awesome/css/all.min.css" rel="stylesheet"> 
    <link href="lib/bootstrap/css/bootstrap-icons.css" rel="stylesheet">
	<link href="lib/font-awesome/css/fontawesome.min.css" rel="stylesheet"> 

    <!-- Stylesheet -->
	<link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
	<link href="lib/owlcarousel/css/owl.carousel.min.css" rel="stylesheet">
	<link href="lib/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="lib/animate/animate.min.css" rel="stylesheet">
	<link href="lib/css/bootstrap.min.css" rel="stylesheet">
	<link href="lib/venobox/venobox.css" rel="stylesheet">
	<link href="lib/css/custom.css" rel="stylesheet">
	<link href="lib/css/style.css" rel="stylesheet">
	
	<!-- JQuery Library -->	
	<script src="lib/jquery/jquery.min.js"></script>

	<!-- Google Adsense 
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4818333944764715" crossorigin="anonymous"></script>	
	-->
	<!-- Chat Box -->	
	<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="d1d9bca4-2330-4689-ac32-759095c48610";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>	

</head>

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

<?php
	function jump($page){
		echo "<script>window.location='$page'</script>";
	}
?>	
	
<body>
