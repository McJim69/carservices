<?php	
	require("connect.php");	

	$cust = $_GET["cid"];

	$link->query("DELETE FROM customers WHERE cid='$cust' ");

	if(file_exists("img/customers/$cust.jpg")){
		unlink("img/customers/$cust.jpg");
	}

	if(file_exists("img/customers/resized/$cust.jpg")){
		unlink("img/customers/resized/$cust.jpg");
	}

	echo "Success";
?>