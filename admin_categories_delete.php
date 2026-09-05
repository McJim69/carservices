<?php	
	require("connect.php");	

	$cat = $_GET["cat_id"];
	$link->query("DELETE FROM categories WHERE cat_id='$cat' ");
	echo "Success";
?>