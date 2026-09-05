<?php 
	require("header.php");
	require("navbar.php");
	
	if(isset($_POST['upDate'])){	
		$untid = $_POST['unit_id'];
		$uname = $_POST['unit_name'];
		$udesc = $_POST['description'];

	$update = $link->query("UPDATE units set
		unit_id     = '$untid',
		unit_name   = '$uname',
		description = '$udesc' where unit_id  = '$untid'") or die(mysqli_error($link));

		if(($update)== TRUE){
			echo"<script>history.back();</script>";
		}
	}

	$unit="";
	if($_GET["units"]!="")
		$unit=" and unit_id='".$_GET["units"]."' ";
												
	$ex = $link->query("select * from units where unit_id=unit_id $unit order by unit_id limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from units t where t.unit_id='$rs[0]' and t.unit_id=t.unit_id ");

	while($rs = mysqli_fetch_array($ex)){	
		
?>

<div class="content-wrapper">
	<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> Units Edit</h3>
	<form action='#' method='POST' enctype='multipart/form-data'>
	<div class="row">
		<div class='col-xl-4 col-sm-12 grid-margin stretch-card'>
			<div class='card'>
				<div class='card-body'>
					<div class='row'>
						<div class='col-12'>
							<div class='row'>
								<div class='col-lg-12 text-center text-primary'>
									<i class='fa fa-ruler-horizontal' style='margin:10px;font-size:50px'></i>
									<i class='fa fa-balance-scale' style='margin:10px;font-size:50px'></i>
									<i class='fa fa-ruler-horizontal' style='margin:10px;font-size:50px'></i>
								</div>
							</div>
							<div class='row'>
								<div class='col-lg-12'>
									<div class='form-group'>
										<label for='unit_name'>Unit Name</label>
										<input type='hidden' name='unit_id' value='<?php echo $rs[0];?>' />
										<input type='text' class='btn btn-dark form-control text-uppercase text-secondary' name='unit_name' value='<?php echo $rs["unit_name"];?>' placeholder='Unit Name' required >
									</div>
									<div class='form-group'>
										<label for='description'>Description</label>
										<input type='text' class='btn btn-dark form-control text-secondary' name='description' value='<?php echo $rs["description"];?>' placeholder='Description' required >
									</div>									
								</div>
							</div>
							<div class='row'>
								<div class='col-lg-12 form-group' style='margin-top:10px;margin-bottom:0'>
									<button class='btn btn-primary btn-block' type='SUBMIT' name='upDate' style='padding:10px'>Save & Update</button>
								</div>
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
