<?php	
	$ex = $link->query("SELECT * FROM siteinfo") or die (mysqli_error($link));
	while($rs=mysqli_fetch_array($ex)){
		$site_mode	  = $rs["site_mode"];
		$year_found	  = $rs["year_found"];
		$title		  = $rs["site_name"];
		$description  = $rs["description"];
		$site_domain  = $rs["site_domain"];
		$facebook	  = $rs["facebook"];
		$youtube	  = $rs["youtube"];
		$postal_add	  = $rs["postal_add"];
		$email_info	  = $rs["email_info"];
		$email_book	  = $rs["email_book"];
		$email_tech	  = $rs["email_tech"];
		$email_admin  = $rs["email_admin"];
		$phone_globe  = $rs["phone_globe"];
		$phone_smart  = $rs["phone_smart"];
		$cert_permit1 = $rs["cert_permit1"];
		$cert_permit2 = $rs["cert_permit2"];
		$cert_permit3 = $rs["cert_permit3"];
		$cert_permit4 = $rs["cert_permit4"];
		$opening_hr1  = $rs["opening_hr1"];
		$opening_hr2  = $rs["opening_hr2"];
	}

	$ex1 = $link->query("SELECT service_name FROM services WHERE service_idno=1") or die (mysqli_error($link));
	$rs1=mysqli_fetch_array($ex1);
	$serv_car    = $rs1[0];
	
	$ex2 = $link->query("SELECT service_name FROM services WHERE service_idno=2") or die (mysqli_error($link));
	$rs2=mysqli_fetch_array($ex2);
	$serv_office = $rs2[0];
	
	$ex3 = $link->query("SELECT service_name FROM services WHERE service_idno=3") or die (mysqli_error($link));
	$rs3=mysqli_fetch_array($ex3);
	$serv_home   = $rs3[0];
	
	$ex4 = $link->query("SELECT service_name FROM services WHERE service_idno=4") or die (mysqli_error($link));
	$rs4=mysqli_fetch_array($ex4);
	$serv_app    = $rs4[0];
	
	define('_SMODE',   $site_mode);
	define('_FOUND',   $year_found);
	define('_TITLE',   $title);
	define('_DESC',    $description);
	define('_DOMAIN',  $site_domain);
	define('_POSTAL',  $postal_add);
	define('_FBPAGE',  $facebook);
	define('_YTPAGE',  $youtube);
	define('_EMAIL1',  $email_info);
	define('_EMAIL2',  $email_book);
	define('_EMAIL3',  $email_tech);
	define('_EMAIL4',  $email_admin);
	define('_PHONE1',  $phone_globe);
	define('_PHONE2',  $phone_smart);
	define('_OFFICE',  $serv_office);
	define('_HOMEAC',  $serv_home);
	define('_SRVCAR',  $serv_car);
	define('_HOMEAP',  $serv_app);
	define('_CERTPG',  $cert_permit1);
	define('_CERTBP',  $cert_permit2);
	define('_CERTTI',  $cert_permit3);
	define('_CERTEC',  $cert_permit4);
	define('_OHOURS1', $opening_hr1);
	define('_OHOURS2', $opening_hr2);

	define('_ODAYS1', 'Monday-Friday');
	define('_ODAYS2', 'Saturdays');	
	define('_CERTCAR', 'Car Aircon Specialist');
	define('_ALSOSRV', 'We also provide home and office refrigeration and air conditioning installation and maintenance, available as either walk-in or on-site services.');	
	define('_THANKS1', 'Thank you for reaching us!');
	define('_THANKS2', 'We appreciate your interest on our services. One of our colleagues will get back to you soon.');
	define('_BESTPLC', 'Is The Best Place For Your Airconditioning Services');
	define('_HOMEADD', 'Don E. Sero Street, Rosary Heights 4, Cotabato City');
	define('_SPECIALIZE', 'We’ve specialized in car, home, and office air conditioning services over years. Additionally, we also accept services on a variety of home electrical appliances.');	
?>