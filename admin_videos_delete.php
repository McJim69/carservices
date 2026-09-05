<?php	

	require("connect.php");	

	$vids = $_GET["vid"];

	$link->query("DELETE FROM videos WHERE vid='$vids' ");

	echo "Success";
?>