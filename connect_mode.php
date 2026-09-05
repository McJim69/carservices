<?php
	error_reporting(0);

	require("config.php");

	$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	$ex=$link->query("SET NAMES 'utf8'");
	$ex=$link->query("SET CHARACTER SET utf8");
	$ex1=$link->query("SET NAMES 'utf8'");
	$ex1=$link->query("SET CHARACTER SET utf8");
	$ex2=$link->query("SET NAMES 'utf8'");
	$ex2=$link->query("SET CHARACTER SET utf8");
		
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	try{
		$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	
	}catch(PDOException $error){
		echo $error->getmessage();
	}		

	session_start();

	date_default_timezone_set('Asia/Manila');

	if(isset($_SESSION['user'])){
		header("location:admin/");
	}	
	
	$qry=$link->query("SELECT site_mode FROM siteinfo") or die(mysqli_error($link));
	while($rs=mysqli_fetch_array($qry)){
		$mode=$rs[0];
		if($mode=="Production"){
			header("location:index.php");
		}
	}		
?>