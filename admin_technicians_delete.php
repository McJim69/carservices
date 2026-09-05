<?php	
	require("connect.php");		

	$tech = $_GET["tech_id"];

	$link->query("DELETE FROM technicians WHERE tech_id='$tech' ");

	if(file_exists("img/technicians/$tech.jpg")){
		unlink("img/technicians/$tech.jpg");
	}

	if(file_exists("img/technicians/resized/$tech.jpg")){
		unlink("img/technicians/resized/$tech.jpg");
	}

	echo "Success";
?>