<?php	
	require("connect.php");	

	$about = $_GET["asid"];
	$link->query("DELETE FROM about WHERE asid='$about' ");
	echo "Success";
?>