<?php
	require("header.php");
	require("topbar.php");
	require("navbar.php");
	require("carousel.php");
	require("manufacturer.php");	
	require("service1.php");

	$qry=$link->query("SELECT * FROM siteinfo") or die(mysqli_error($link));
	
	if($rs=mysqli_fetch_array($qry)){
		$korek="Yes";
		$about=$rs["page_about"];
		$facts=$rs["page_facts"];
		$servi=$rs["page_services"];
		$books=$rs["page_booking"];
		$techs=$rs["page_technicians"];
		$picto=$rs["page_pictorials"];
		$testi=$rs["page_testimonials"];
		$conta=$rs["page_contact"];
		
		if($about==$korek){ require("about1.php"); }
		if($facts==$korek){ require("fact.php"); }
		if($servi==$korek){ require("service2.php"); } 
		if($books==$korek){ require("booking1.php");} 
		if($techs==$korek){ require("team1.php"); }	
		if($picto==$korek){ require("pictures1.php"); require("videos1.php"); } 
		if($testi==$korek){ require("testimonial1.php"); }
		if($conta==$korek){ require("contact1.php"); }
	}

	$ex=$link->query("SELECT * from validity");	
	$rs=mysqli_fetch_array($ex);
	
	if($rs["validity"] < date("Y-m-d")){
		$link->query("update siteinfo set site_mode='Disabled' ");		
	}	
?>
	
<script> setActive("home"); </script>

<?php require("footer.php"); ?>