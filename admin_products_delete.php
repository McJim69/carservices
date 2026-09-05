<?php	
	require("connect.php");		

	$prod = $_GET["product_id"];

	$link->query("DELETE FROM products WHERE product_id='$prod' ");

	if(file_exists("img/technicians/$prod.jpg")){
		unlink("img/products/$prod.jpg");
	}

	if(file_exists("img/technicians/resized/$prod.jpg")){
		unlink("img/products/resized/$prod.jpg");
	}

	echo "Success";
?>