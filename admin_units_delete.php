<?php	
	require("connect.php");	

	$unit = $_GET["unit_id"];
	$link->query("DELETE FROM units WHERE unit_id='$unit' ");
	echo "Success";
?>