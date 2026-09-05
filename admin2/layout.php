<?php 
	$qry=$link->query("SELECT * FROM grid");
	$res=mysqli_fetch_array($qry);
	$col=$res["colgrid"];
	
	if($col="2"){echo"6 Collumns";}
	if($col="3"){echo"4 Collumns";}
	if($col="4"){echo"3 Collumns";}
	if($col="6"){echo"2 Collumns";}
?>