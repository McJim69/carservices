<?php	
	require("connect.php");	
	$user = $_GET["usrid"];
	$link->query("DELETE FROM users WHERE usrid='$user' ");

	if(file_exists("img/users/$user.jpg")){
		unlink("img/users/$user.jpg");
	}
	
	if(file_exists("img/users/resized/$user.jpg")){
		unlink("img/users/resized/$user.jpg");
	}

	echo "Success";
?>