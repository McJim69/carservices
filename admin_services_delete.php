<?php	
	require("connect.php");	

	$serve = $_GET["service_idno"];
	$link->query("DELETE FROM services WHERE service_idno='$serve' ");
	echo "Success";
?>