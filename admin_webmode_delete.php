<?php	
	require("connect.php");	

	$mode = $_GET["mode_id"];
	$link->query("DELETE FROM site_mode WHERE mode_id='$mode' ");
	echo "Success";
?>