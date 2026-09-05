<?php
	$prodQ=$link->query("SELECT * FROM products") or die(mysqli_error($link));
	$prodT=mysqli_num_rows($prodQ);

	$prodP = ($prodT*100)/$prodT;
	$prodA = round($prodP);

	$rempQ=$link->query("SELECT * FROM products WHERE product_stock>0") or die(mysqli_error($link));
	$rempT=mysqli_num_rows($rempQ);

	$rempP = ($rempT*100)/$prodT;
	$rempA = round($rempP);

	$outpQ = $link->query("SELECT * FROM products WHERE product_stock<1") or die(mysqli_error($link));
	$outpT = mysqli_num_rows($outpQ);

	$outpP = ($outpT*100)/$prodT;
	$outpA = round($outpP);

	if($rempA<50){
		$remcol="warning";
	}else{
		$remcol="success";
	}

	if($outpA>50){
		$ostcol="danger";
	}else{
		$ostcol="success";
	}

	$pricQ = $link->query("SELECT SUM(product_price) AS total FROM products") or die(mysqli_error($link));
	$pricT = $pricQ->fetch_assoc();
	$total = $pricT["total"];

	$detsQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details") or die(mysqli_error($link));
	$detsA = $detsQ->fetch_assoc();
	$detsT = $detsA["total"];

	$detsP = ($detsT*100)/$total;
	$detsC = round($detsP);
	
?>
<!-- Summaries Start -->
	<div class="row">
	<!-- Remaining -->
		<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-9">
							<div class="d-flex align-items-center align-self-start">
								<h3 class="mb-0"><?php echo number_format($rempT,0);?></h3>
								<p class="text-<?php echo $remcol;?> ml-2 mb-0 font-weight-medium"><?php echo $rempA;?>%</p>
							</div>
						</div>
						<div class="col-3">
							<div class="icon icon-box-<?php echo $remcol;?>" onClick="jump('products.php')" style="cursor:pointer;width:70px" title="View All">
								<small>VIEW</small><span class="mdi mdi-arrow-right icon-item"></span>
							</div>
						</div>
					</div><h6 class="text-muted font-weight-normal">Stock Remaining <?php echo $rempA;?>%</h6>
				</div>
			</div>
		</div>
	<!-- Out of Stock -->
		<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-9">
							<div class="d-flex align-items-center align-self-start">
								<h3 class="mb-0"><?php echo number_format($outpT,0);?></h3>
								<p class="text-<?php echo $ostcol;?> ml-2 mb-0 font-weight-medium"><?php echo $outpA;?>%</p>
							</div>
						</div>
						<div class="col-3">
							<div class="icon icon-box-<?php echo $ostcol;?>" onClick="jump('products.php')" style="cursor:pointer;width:70px" title="View All">
								<small>VIEW</small><span class="mdi mdi-arrow-right icon-item"></span>
							</div>
						</div>
					</div><h6 class="text-muted font-weight-normal">Out of Stock <?php echo $outpA;?>%</h6>
				</div>
			</div>
		</div>		
		<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-9">
							<div class="d-flex align-items-center align-self-start">
								<h3 class="mb-0">&#8369; <?php echo number_format($detsT,2);?></h3>
								<p class="text-<?php echo $ostcol;?> ml-2 mb-0 font-weight-medium"><?php echo $detsC;?>%</p>
							</div>
						</div>
						<div class="col-3">
							<div class="icon icon-box-success" onClick="jump('summaries.php')" style="cursor:pointer;width:70px" title="View All">
								<small>VIEW</small><span class="mdi mdi-arrow-right icon-item"></span>
							</div>
						</div>
					</div><h6 class="text-muted font-weight-normal">Product Sales <?php echo $detsC;?>%</h6>
				</div>
			</div>
		</div>		
	<!-- Product Accumulated Cost (Capital Outlay) -->
		<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-9">
							<div class="d-flex align-items-center align-self-start">
								<h3 class="mb-0">&#8369; <?php echo number_format($total,2);?></h3>
							</div>
						</div>
						<div class="col-3">
							<div class="icon icon-box-success" onClick="jump('products.php')" style="cursor:pointer;width:70px" title="View All">
								<small>VIEW</small><span class="mdi mdi-arrow-right icon-item"></span>
							</div>
						</div>
					</div><h6 class="text-muted font-weight-normal">Total Materials Cost</h6>
				</div>
			</div>
		</div>		
	</div>
<!-- Summaries End -->
	