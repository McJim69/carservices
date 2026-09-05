<?php	
	require("connect.php");		

	$tran = $_GET["serv_id"];

	$link->query("DELETE FROM transactions WHERE serv_id='$tran' ");
	$link->query("DELETE FROM trans_details WHERE serv_id='$tran' ");

	if(file_exists("img/transactions/$tran.jpg")){
		unlink("img/transactions/$tran.jpg");
	}
	if(file_exists("img/transactions/resized/$tran.jpg")){
		unlink("img/transactions/resized/$tran.jpg");
	}
	echo "Success";	
?>