<?php 
	require("header.php");
	require("navbar.php");
	
	if(isset($_POST['upDate'])){	
		$catid = $_POST['cat_id'];
		$cname = $_POST['cat_name'];
		$cdesc = $_POST['description'];
		$ficon = $_POST['fonticon'];

	$update = $link->query("UPDATE categories set
		cat_id      = '$catid',
		cat_name    = '$cname',
		description = '$cdesc',
		fonticon    = '$ficon' where cat_id  = '$catid'") or die(mysqli_error($link));

		if(($update)== TRUE){
			echo"<script>history.back();</script>";
		}
	}

	$categ="";
	if($_GET["categories"]!="")
		$categ=" and cat_id='".$_GET["categories"]."' ";
												
	$ex = $link->query("select * from categories where cat_id=cat_id $categ order by cat_id limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from categories t where t.cat_id='$rs[0]' and t.cat_id=t.cat_id ");

	while($rs = mysqli_fetch_array($ex)){	
?>

<div class="content-wrapper">
	<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> Edit Categories</h3>
	<form action='#' method='POST' enctype='multipart/form-data'>
	<div class="row">
		<div class='col-xl-4 col-sm-12 grid-margin stretch-card' id='div_$rs[0]'>
			<div class='card'>
				<div class='card-body'>
					<div class='row'>
						<div class='col-12' style='color:#545454'>
							<div class='text-center' style='margin-top:-10px'>
								<i class='<?php echo $rs["fonticon"];?> text-primary' style='margin-bottom:10px;font-size:100px'></i>
							</div>
							<div style='border-radius:3px;background:#fff;padding:15px'>
								<div class='form-group'>
									<label for='cat_name'>Category Name</label>
									<input type='hidden' name='cat_id' value='<?php echo $rs[0];?>' />
									<input type='text' class='form-control text-secondary' name='cat_name' value='<?php echo $rs["cat_name"];?>' placeholder='categories Name' required >
								</div>
								<div class='form-group'>
									<label for='description'>Description</label>
									<input type='text' class='form-control text-secondary' name='description' value='<?php echo $rs["description"];?>' placeholder='Description' required >
								</div>									
								<div class='form-group'>
									<label for='fonticon'>Font Awesome Icon</label>
									<input type='text' class='form-control text-secondary' name='fonticon' value='<?php echo $rs["fonticon"];?>' placeholder='Font Awesome Icon' required >
								</div>
							</div>
							<div class='form-group' style='margin-top:20px'>
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
