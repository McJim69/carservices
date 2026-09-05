<?php	
	require("connect.php");	

	$pics = $_GET["picid"];

	$link->query("DELETE FROM pictures WHERE picid='$pics' ");

	if(file_exists("img/pictures/$pics.jpg")){
		unlink("img/pictures/$pics.jpg");
	}

	if(file_exists("img/pictures/resized/$pics.jpg")){
		unlink("img/pictures/resized/$pics.jpg");
	}

	echo "Success";
?>