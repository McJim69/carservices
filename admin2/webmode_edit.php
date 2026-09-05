<?php 
	require("header.php");
	require("navbar.php");
	
	if(isset($_POST['upDate'])){	
		$modid = $_POST['mode_id'];
		$mname = $_POST['mode_name'];
		$mdesc = $_POST['description'];
		$ficon = $_POST['fonticon'];

	$update = $link->query("UPDATE site_mode set
		mode_id     = '$modid',
		mode_name   = '$mname',
		description = '$mdesc',
		fonticon    = '$ficon' where mode_id  = '$modid'") or die(mysqli_error($link));

		if(($update)== TRUE){
			echo"<script>history.back();</script>";
		}
	}

	$mode="";
	if($_GET["site_mode"]!="")
		$mode=" and mode_id='".$_GET["site_mode"]."' ";
												
	$ex = $link->query("select * from site_mode where mode_id=mode_id $mode order by mode_id limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from site_mode t where t.mode_id='$rs[0]' and t.mode_id=t.mode_id ");

	while($rs = mysqli_fetch_array($ex)){		
?>

<div class="content-wrapper">
	<h3 class="card-title">Settings <i class='fa fa-arrow-right'></i> Units <i class='fa fa-arrow-right'></i> Edit</h3>
	<form action='#' method='POST' enctype='multipart/form-data'>
	<div class="row">
		<div class='col-xl-4 col-sm-12 grid-margin stretch-card'>
			<div class='card'>
				<div class='card-body'>
					<div class='row'>
						<div class='col-12'>
							<div class='text-center' style='margin-bottom:20px'>
								<i class='<?php echo $rs["fonticon"];?> text-primary' style='font-size:100px'></i>
							</div>
							<div class='text-dark' style='border-radius:4px;padding:15px;border:3px;background:#bbb'>
								<div class='form-group'>
									<label for='mode_name'>Mode Name</label>
									<input type='hidden' name='mode_id' value='<?php echo $rs[0];?>' />
									<input type='text' class='form-control text-secondary' name='mode_name' value='<?php echo $rs["mode_name"];?>' placeholder='Mode Name' required >
								</div>
								<div class='form-group'>
									<label for='description'>Description</label>
									<input type='text' class='form-control text-secondary' name='description' value='<?php echo $rs["description"];?>' placeholder='Description' required >
								</div>									
								<div class='form-group' style='margin-bottom:2px'>
									<label for='fonticon'>Font Awesome Icon</label>
									<input type='text' class='form-control text-secondary' name='fonticon' value='<?php echo $rs["fonticon"];?>' placeholder='Font Awesome Icon' required >
								</div>
							</div>
							<div class='text-center' style='margin-top:20px;margin-bottom:0'>
								<button class='btn btn-primary btn-block' type='SUBMIT' name='upDate' style='padding:10px'>Save & Update</button>
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
