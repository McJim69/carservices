<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");

	if(isset($_POST['upDate'])){	
		$site_id           = $_POST["site_id"];
		$site_mode         = $_POST["site_mode"];
		$year_found        = $_POST["year_found"];
		$site_name         = $_POST["site_name"];
		$description       = $_POST["description"];
		$site_domain       = $_POST["site_domain"];
		$postal_add        = $_POST["postal_add"];
		$facebook          = $_POST["facebook"];
		$youtube           = $_POST["youtube"];
		$email_info        = $_POST["email_info"];
		$email_book        = $_POST["email_book"];
		$email_tech        = $_POST["email_tech"];
		$email_admin       = $_POST["email_admin"];
		$phone_globe       = $_POST["phone_globe"];
		$phone_smart       = $_POST["phone_smart"];
		$cert_permit1      = $_POST["cert_permit1"];
		$cert_permit2      = $_POST["cert_permit2"];
		$cert_permit3      = $_POST["cert_permit3"];
		$cert_permit4      = $_POST["cert_permit4"];
		$opening_hr1       = $_POST["opening_hr1"];
		$opening_hr2  	   = $_POST["opening_hr2"];
		$page_about 	   = $_POST["page_about"];
		$page_facts 	   = $_POST["page_facts"];
		$page_services 	   = $_POST["page_services"];
		$page_booking 	   = $_POST["page_booking"];
		$page_technicians  = $_POST["page_technicians"];
		$page_pictorials   = $_POST["page_pictorials"];
		$page_testimonials = $_POST["page_testimonials"];	 
		$page_contact	   = $_POST["page_contact"];

	$update = $link->query("UPDATE siteinfo set
		site_id		       = '$site_id',
		site_mode	       = '$site_mode',
		year_found	       = '$year_found',
		site_name	       = '$site_name',
		description	       = '$description',
		site_domain	       = '$site_domain',
		postal_add	       = '$postal_add',
		facebook	       = '$facebook',
		youtube  	       = '$youtube',
		email_info	       = '$email_info',
		email_book	       = '$email_book',
		email_tech	       = '$email_tech',
		email_admin	       = '$email_admin',
		phone_globe	       = '$phone_globe',
		phone_smart	       = '$phone_smart',
		cert_permit1       = '$cert_permit1',
		cert_permit2       = '$cert_permit2',
		cert_permit3       = '$cert_permit3',
		cert_permit4       = '$cert_permit4',
		opening_hr1	       = '$opening_hr1',
		opening_hr2	       = '$opening_hr2', 
		page_about 	       = '$page_about',
		page_facts 	       = '$page_facts',
		page_services 	   = '$page_services',
		page_booking 	   = '$page_booking',
		page_technicians   = '$page_technicians',
		page_pictorials    = '$page_pictorials',
		page_testimonials  = '$page_testimonials',	 
		page_contact	   = '$page_contact'
		
		where site_id = '$site_id'");

		if(($update)== TRUE){
			echo"<script>history.back();</script>";
		}else{
			echo mysqli_error($link);
		}
	}
?>

<script> setActive("system"); </script>
<script> setActive("info"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-1.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Website Settings</h1>
				<button style="width:100px;margin:5px" onClick="history.back()" class="btn btn-primary">
					<i class="fa fa-arrow-left"></i> Back
				</button>				
				<button style="width:100px;margin:5px" onClick="jump('admin_dashboard.php')" class="btn btn-primary">
					<i class="fa fa-home"></i> Home
				</button>				
			</div>
        </div>
    </div>
<!-- Page Header End -->

<?php 

    function fill_mode($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT mode_name FROM site_mode order by mode_id");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row[0].'">'.$row[0].'</option>';
		}	return $output;
	}

	$ex = $link->query("select * from siteinfo");

	while($rs = mysqli_fetch_array($ex)){		
?>

<!-- Site Info Start -->
    <div class="container-xxl py-5">
        <div class="container">
			<div style="margin-top:-80px" class="col-md-12">
				<div class="wow fadeInUp" data-wow-delay="0.2s">
					<form action="#" method="POST">
						<div class="row g-3">						
							<div class="text-center" style="margin-bottom:-10px"><h1>Information</h1></div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="hidden" name="site_id" value="<?php echo $rs["site_id"];?>">
									<select class="form-control bg-light" name="site_mode" required>
									<option value="<?php echo $rs["site_mode"];?>"><?php echo $rs["site_mode"];?></option>
										<?php echo fill_mode($pdo);?>			
									</select>
									<label for="site_name">Website Mode (Select Mode)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="year_found" placeholder="Year Founded" value="<?php echo $rs["year_found"];?>" required>
									<label for="year_found">Year Founded (Shop Founded)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="site_name" placeholder="Website Name" value="<?php echo $rs["site_name"];?>" required>
									<label for="site_name">Shop Name (Website Name)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="description" placeholder="Description" value="<?php echo $rs["description"];?>" required>
									<label for="description">Shop Description</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="site_domain" placeholder="Domain Name" value="<?php echo $rs["site_domain"];?>" required>
									<label for="site_domain">Domain Name (Hostname)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="postal_add" placeholder="Postal Address" value="<?php echo $rs["postal_add"];?>" required>
									<label for="postal_add">Postal Address (Home/Shop)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="facebook" placeholder="Facebook Page" value="<?php echo $rs["facebook"];?>" required>
									<label for="facebook">Facebook (Page)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="youtube" placeholder="Youtube Channel" value="<?php echo $rs["youtube"];?>" required>
									<label for="youtube">Youtube (Channel)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="email" class="form-control" name="email_info" placeholder="Email Address (Query)" value="<?php echo $rs["email_info"];?>" required>
									<label for="email_info">Email Address (For Inquery)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="email" class="form-control" name="email_book" placeholder="Email Address (Booking)" value="<?php echo $rs["email_book"];?>" required>
									<label for="email_book">Email Address (For Booking)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="email" class="form-control" name="email_tech" placeholder="Email Address (Technical)" value="<?php echo $rs["email_tech"];?>" required>
									<label for="email_tech">Email Address (For Technical)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="email" class="form-control" name="email_admin" placeholder="Email Address (SysAdmin)" value="<?php echo $rs["email_admin"];?>" required>
									<label for="email_admin">Email Address (Administrator)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="phone_globe" placeholder="Phone Number (Globe)" value="<?php echo $rs["phone_globe"];?>" required>
									<label for="phone_globe">Phone Number (Globe Telecoms)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="phone_smart" placeholder="Phone Number (Smart)" value="<?php echo $rs["phone_smart"];?>" required>
									<label for="phone_smart">Phone Number (Smart Telecoms)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="cert_permit1" placeholder="Certificate-Permit 1" value="<?php echo $rs["cert_permit1"];?>" required>
									<label for="cert_permit1">Certificate-Permit 1 (PhilGEPS)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="cert_permit2" placeholder="Certificate-Permit 2" value="<?php echo $rs["cert_permit2"];?>" required>
									<label for="cert_permit2">Certificate-Permit 2 (Business)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="cert_permit3" placeholder="Certificate-Permit 3" value="<?php echo $rs["cert_permit3"];?>" required>
									<label for="cert_permit3">Certificate-Permit 3 (DTI)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="cert_permit4" placeholder="Certificate-Permit 4" value="<?php echo $rs["cert_permit4"];?>" required>
									<label for="cert_permit4">Certificate-Permit 4 (DENR)</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="opening_hr1" placeholder="Opening Hours (Mon-Fri)" value="<?php echo $rs["opening_hr1"];?>" required>
									<label for="opening_hr1">Opening Hours (Monday to Friday)</label>
								</div>
							</div>								
							<div class="col-md-3">
								<div class="form-floating">
									<input type="text" class="form-control" name="opening_hr2" placeholder="Opening Hours (Saturdays)" value="<?php echo $rs["opening_hr2"];?>" required>
									<label for="opening_hr2">Opening Hours (Saturdays)</label>
								</div>
							</div>
							<div class="text-center" style="margin-bottom:-10px"><h1>Front Pages</h1></div>
							<div class="col-md-3">
								<div class="form-floating">
									<select type="text" class="form-control" name="page_about" required>
										<option value="<?php echo $rs["page_about"];?>">Display: <?php echo $rs["page_about"];?></option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
									<label for="page_about">About Us</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<select type="text" class="form-control" name="page_facts" required>
										<option value="<?php echo $rs["page_facts"];?>">Display: <?php echo $rs["page_facts"];?></option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
									<label for="page_facts">Shop Facts</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<select type="text" class="form-control" name="page_services" required>
										<option value="<?php echo $rs["page_services"];?>">Display: <?php echo $rs["page_services"];?></option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
									<label for="page_services">Shop Services</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<select type="text" class="form-control" name="page_booking" required>
										<option value="<?php echo $rs["page_booking"];?>">Display: <?php echo $rs["page_booking"];?></option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
									<label for="page_booking">Booking Page</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<select type="text" class="form-control" name="page_technicians" required>
										<option value="<?php echo $rs["page_technicians"];?>">Display: <?php echo $rs["page_technicians"];?></option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
									<label for="page_technicians">Technicians</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<select type="text" class="form-control" name="page_pictorials" required>
										<option value="<?php echo $rs["page_pictorials"];?>">Display: <?php echo $rs["page_pictorials"];?></option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
									<label for="page_pictorials">Pictorials</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<select type="text" class="form-control" name="page_testimonials" required>
										<option value="<?php echo $rs["page_testimonials"];?>">Display: <?php echo $rs["page_testimonials"];?></option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
									<label for="page_testimonials">Testimonials</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-floating">
									<select type="text" class="form-control" name="page_contact" required>
										<option value="<?php echo $rs["page_contact"];?>">Display: <?php echo $rs["page_contact"];?></option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
									<label for="page_contact">Contact Us</label>
								</div>
							</div>
							<div class="col-md3 text-center" style='margin-top:30px'>
								<button class="btn btn-primary rounded-pill py-2 px-4" type="submit" name='upDate'>SUBMIT & UPDATE</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- Site Info End -->

<?php } require("admin_footer.php");?>