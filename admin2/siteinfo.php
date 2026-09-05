<?php 
	require("header.php");
	require("navbar.php");

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
	}
?>

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
<div class="content-wrapper">
<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> Web Info</h3>
<form action="#" method="POST">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body" style="color:gray;margin-bottom:-15px">
					<div class="row g-3">						
						<div class="col-md-3">
							<div class="form-group">
								<label for="site_name">Website Mode (Select Mode)</label>
								<input type="hidden" name="site_id" value="<?php echo $rs["site_id"];?>">
								<select class="form-control text-secondary" name="site_mode" required>
								<option value="<?php echo $rs["site_mode"];?>"><?php echo $rs["site_mode"];?></option>
									<?php echo fill_mode($pdo);?>			
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="year_found">Year Founded (Shop Founded)</label>
								<input type="text" class="form-control text-secondary text-secondary" name="year_found" placeholder="Year Founded" value="<?php echo $rs["year_found"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="site_name">Shop Name (Website Name)</label>
								<input type="text" class="form-control text-secondary" name="site_name" placeholder="Website Name" value="<?php echo $rs["site_name"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="description">Shop Description</label>
								<input type="text" class="form-control text-secondary" name="description" placeholder="Description" value="<?php echo $rs["description"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="site_domain">Domain Name (Hostname)</label>
								<input type="text" class="form-control text-secondary" name="site_domain" placeholder="Domain Name" value="<?php echo $rs["site_domain"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="postal_add">Postal Address (Home/Shop)</label>
								<input type="text" class="form-control text-secondary" name="postal_add" placeholder="Postal Address" value="<?php echo $rs["postal_add"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="facebook">Facebook (Page)</label>
								<input type="text" class="form-control text-secondary" name="facebook" placeholder="Facebook Page" value="<?php echo $rs["facebook"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="youtube">Youtube (Channel)</label>
								<input type="text" class="form-control text-secondary" name="youtube" placeholder="Youtube Channel" value="<?php echo $rs["youtube"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="email_info">Email Address (For Inquery)</label>
								<input type="email" class="form-control text-secondary" name="email_info" placeholder="Email Address (Query)" value="<?php echo $rs["email_info"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="email_book">Email Address (For Booking)</label>
								<input type="email" class="form-control text-secondary" name="email_book" placeholder="Email Address (Booking)" value="<?php echo $rs["email_book"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="email_tech">Email Address (For Technical)</label>
								<input type="email" class="form-control text-secondary" name="email_tech" placeholder="Email Address (Technical)" value="<?php echo $rs["email_tech"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="email_admin">Email Address (Administrator)</label>
								<input type="email" class="form-control text-secondary" name="email_admin" placeholder="Email Address (SysAdmin)" value="<?php echo $rs["email_admin"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="phone_globe">Phone Number (Globe Telecoms)</label>
								<input type="text" class="form-control text-secondary" name="phone_globe" placeholder="Phone Number (Globe)" value="<?php echo $rs["phone_globe"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="phone_smart">Phone Number (Smart Telecoms)</label>
								<input type="text" class="form-control text-secondary" name="phone_smart" placeholder="Phone Number (Smart)" value="<?php echo $rs["phone_smart"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="cert_permit1">Certificate-Permit 1 (PhilGEPS)</label>
								<input type="text" class="form-control text-secondary" name="cert_permit1" placeholder="Certificate-Permit 1" value="<?php echo $rs["cert_permit1"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="cert_permit2">Certificate-Permit 2 (Business)</label>
								<input type="text" class="form-control text-secondary" name="cert_permit2" placeholder="Certificate-Permit 2" value="<?php echo $rs["cert_permit2"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="cert_permit3">Certificate-Permit 3 (DTI)</label>
								<input type="text" class="form-control text-secondary" name="cert_permit3" placeholder="Certificate-Permit 3" value="<?php echo $rs["cert_permit3"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="cert_permit4">Certificate-Permit 4 (DENR)</label>
								<input type="text" class="form-control text-secondary" name="cert_permit4" placeholder="Certificate-Permit 4" value="<?php echo $rs["cert_permit4"];?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="opening_hr1">Opening Hours (Monday to Friday)</label>
								<input type="text" class="form-control text-secondary" name="opening_hr1" placeholder="Opening Hours (Mon-Fri)" value="<?php echo $rs["opening_hr1"];?>" required>
							</div>
						</div>								
						<div class="col-md-3">
							<div class="form-group">
								<label for="opening_hr2">Opening Hours (Saturdays)</label>
								<input type="text" class="form-control text-secondary" name="opening_hr2" placeholder="Opening Hours (Saturdays)" value="<?php echo $rs["opening_hr2"];?>" required>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>						
<br>	

<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> Front Pages</h3>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body" style="color:gray;margin-bottom:-15px">
					<div class="row g-3">						
						<div class="col-md-3">
							<div class="form-group">
								<label for="page_about">About Us</label>
								<select type="text" class="form-control text-secondary" name="page_about" required>
									<option value="<?php echo $rs["page_about"];?>">Display: <?php echo $rs["page_about"];?></option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="page_facts">Shop Facts</label>
								<select type="text" class="form-control text-secondary" name="page_facts" required>
									<option value="<?php echo $rs["page_facts"];?>">Display: <?php echo $rs["page_facts"];?></option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="page_services">Shop Services</label>
								<select type="text" class="form-control text-secondary" name="page_services" required>
									<option value="<?php echo $rs["page_services"];?>">Display: <?php echo $rs["page_services"];?></option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="page_booking">Booking Page</label>
								<select type="text" class="form-control text-secondary" name="page_booking" required>
									<option value="<?php echo $rs["page_booking"];?>">Display: <?php echo $rs["page_booking"];?></option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="page_technicians">Technicians</label>
								<select type="text" class="form-control text-secondary" name="page_technicians" required>
									<option value="<?php echo $rs["page_technicians"];?>">Display: <?php echo $rs["page_technicians"];?></option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="page_pictorials">Pictorials</label>
								<select type="text" class="form-control text-secondary" name="page_pictorials" required>
									<option value="<?php echo $rs["page_pictorials"];?>">Display: <?php echo $rs["page_pictorials"];?></option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="page_testimonials">Testimonials</label>
								<select type="text" class="form-control text-secondary" name="page_testimonials" required>
									<option value="<?php echo $rs["page_testimonials"];?>">Display: <?php echo $rs["page_testimonials"];?></option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="page_contact">Contact Us</label>
								<select type="text" class="form-control text-secondary" name="page_contact" required>
									<option value="<?php echo $rs["page_contact"];?>">Display: <?php echo $rs["page_contact"];?></option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-md-12 text-center">
							<div class="form-group">
								<button class="btn btn-primary btn-block" type="submit" name='upDate' style='padding:10px;margin-bottom:-5px'>Submit & Update</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

</div>

<!-- Site Info End -->

<?php } require("footer.php");?>
