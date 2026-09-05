<?php	
	require("connect.php");		

	$dets = $_GET["dets_idno"];

	$link->query("DELETE FROM trans_details WHERE dets_idno='$dets' ");

	echo "Success";	
?>