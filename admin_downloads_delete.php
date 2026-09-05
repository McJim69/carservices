<?php	
	require("connect.php");	

	$file = $_GET["did"];

	$ex=$link->query("SELECT * FROM downloads WHERE did='$file' ");
	while($rs=mysqli_fetch_array($ex)){
		$fn=$rs["filename"];
		$link->query("DELETE FROM downloads WHERE did='$file' ");	
	}

	if(file_exists("download/$fn")){
		unlink("download/$fn");
	}
	
	echo "Success";
?>