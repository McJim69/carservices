<?php 
	require("header.php");
	require("navbar.php");
	
	if(isset($_POST['upDate'])){	
		$service_idno = $_POST['service_idno'];
		$service_name = $_POST['service_name'];
		$service_qlty = $_POST['service_qlty'];
		$service_expt = $_POST['service_expt'];
		$service_mdrn = $_POST['service_mdrn'];
		$service_font = $_POST['service_font'];

	$update = $link->query("UPDATE services set
		service_idno = '$service_idno',
		service_name = '$service_name',
		service_qlty = '$service_qlty',
		service_expt = '$service_expt',
		service_mdrn = '$service_mdrn',
		service_font = '$service_font' where service_idno  = '$service_idno'") or die(mysqli_error($link));
	}

	$serve="";
	if($_GET["services"]!="")
		$serve=" and service_idno='".$_GET["services"]."' ";
												
	$ex = $link->query("select * from services where service_idno=service_idno $serve order by service_idno limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from services t where t.service_idno='$rs[0]' and t.service_idno=t.service_idno ");

	while($rs = mysqli_fetch_array($ex)){	
		
?>

<div class="content-wrapper">
	<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> Services Edit</h3>
	<form action='#' method='POST' enctype='multipart/form-data'>
	<div class="row">
		<div class='col-xl-4 col-sm-12 grid-margin stretch-card' id='div_$rs[0]'>
			<div class='card'>
				<div class='card-body'>
					<div class='row'>
						<div class='col-12' style='color:#545454'>
							<div class='text-center'>
								<i class='<?php echo $rs["service_font"];?> text-primary' style='font-size:100px'></i>
							</div><br>
							<div style='border-radius:3px;background:#eee;padding:15px'>
								<div class='form-group'>
									<label for='service_name'>Service Name</label>
									<input type='hidden' name='service_idno' value='<?php echo $rs[0];?>' />
									<input type='text' class='form-control text-secondary' name='service_name' value='<?php echo $rs["service_name"];?>' placeholder='Service Name' required >
								</div>
								<div class='form-group'>
									<label for='service_qlty'>Quality Tagline</label>
									<input type='text' class='form-control text-secondary' name='service_qlty' value='<?php echo $rs["service_qlty"];?>' placeholder='Quality Tagline' required >
								</div>
								<div class='form-group'>
									<label for='service_expt'>Expert Tagline</label>
									<input type='text' class='form-control text-secondary' name='service_expt' value='<?php echo $rs["service_expt"];?>' placeholder='Expert Tagline' required >
								</div>
								<div class='form-group'>
									<label for='service_mdrn'>Modern Tagline</label>
									<input type='text' class='form-control text-secondary' name='service_mdrn' value='<?php echo $rs["service_mdrn"];?>' placeholder='Modern Tagline' required >
								</div>
								<div class='form-group'>
									<label for='service_font'>Font Awesome Icon</label>
									<input type='text' class='form-control text-secondary' name='service_font' value='<?php echo $rs["service_font"];?>' placeholder='Font Awesome Icon' required >
								</div>
							</div><br>
							<div class='text-center'>
								<button class='btn btn-primary text-secondary btn-block' type='Submit' name='upDate' style='padding:10px'>Save & Update</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
	
</div>
			
<?php } } require("footer.php");?>
