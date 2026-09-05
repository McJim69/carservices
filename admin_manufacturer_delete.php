<?php	
	require("connect.php");	

	$manu = $_GET["mfid"];

	$link->query("DELETE FROM manufacturer WHERE mfid='$manu' ");

	if(file_exists("img/manufacturer/$manu.png")){
		unlink("img/manufacturer/$manu.png");
	}else{
		echo"";
	}
	echo "Success";
?>