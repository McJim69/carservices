<?php	
	require("../connect.php");	

	$todo = $_GET["todo_idn"];
	$link->query("UPDATE todo set status='OK' WHERE todo_idn='$todo' ");
	echo "Success";
?>