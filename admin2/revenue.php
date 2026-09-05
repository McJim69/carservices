<!-- All Revenues Start-->
<?php 
	$totA=0;

	$alsQ=$link->query("SELECT SUM(product_price) AS total FROM products");
	$alsA=$alsQ->fetch_assoc();
	$alsT=$alsA["total"];
	
	$allQ=$link->query("SELECT SUM(labor_cost) AS total FROM transactions");
	$allA=$allQ->fetch_assoc();
	$allT=$allA["total"];

	$almQ=$link->query("SELECT SUM(product_price) AS total FROM trans_details");
	$almA=$almQ->fetch_assoc();
	$almT=$almA["total"];
	
	$tlmT=$allT+$almT;
	
	$totA+=$tlmT;
	
	$labP = ($allT*100)/$alsT;
	$labR = round($labP);	

	$matP = ($almT*100)/$alsT;
	$matR = round($matP);	

	$salP = ($totA*100)/$alsT;
	$salR = round($salP);	
?>
<div class="row">
	<div class="col-sm-4 grid-margin">
		<div class="card">
			<div class="card-body"><h5>Over-All Services Sales</h5>
			<?php 
				if($allT > 0){
				echo"
				<div class='row'>
					<div class='col-8 col-sm-12 col-xl-8 my-auto'>
						<div class='d-flex d-sm-block d-md-flex align-items-center'>
							<h2 class='mb-0'>&#8369; ".number_format($allT,2)."</h2>
							<p class='text-success ml-2 mb-0 font-weight-medium'>$labR%</p>
						</div>
						<h6 class='text-muted font-weight-normal'>$labR% From Capital Outlay</h6>
					</div>
					<div class='col-4 col-sm-12 col-xl-4 text-center text-xl-right'>
						<i class='icon-lg mdi mdi-wrench text-primary ml-auto'></i>
					</div>
				</div>";
				}else{
					echo"No generated Sales!";
				}					  
			?>										
			</div>
		</div>
	</div>
	<div class="col-sm-4 grid-margin">
		<div class="card">
			<div class="card-body"><h5>Over-All Product Sales</h5>
			<?php 
				if($almT > 0){
				echo"
				<div class='row'>
					<div class='col-8 col-sm-12 col-xl-8 my-auto'>
						<div class='d-flex d-sm-block d-md-flex align-items-center'>
							<h2 class='mb-0'>&#8369; ".number_format($almT,2)."</h2>
							<p class='text-success ml-2 mb-0 font-weight-medium'>$matR%</p>
						</div>
						<h6 class='text-muted font-weight-normal'>$matR% From Capital Outlay</h6>
					</div>
					<div class='col-4 col-sm-12 col-xl-4 text-center text-xl-right'>
						<i class='icon-lg mdi mdi-car text-primary ml-auto'></i>
					</div>
				</div>";
				}else{
					echo"No generated Sales!";
				}					  
			?>							
			</div>
		</div>
	</div>
	<div class="col-sm-4 grid-margin">
		<div class="card">
			<div class="card-body"><h5>Over-All Generated Sales</h5>
			<?php 
				if($totA > 0){
				echo"
				<div class='row'>
					<div class='col-8 col-sm-12 col-xl-8 my-auto'>
						<div class='d-flex d-sm-block d-md-flex align-items-center'>
							<h2 class='mb-0'>&#8369; ".number_format($totA,2)."</h2>
							<p class='text-success ml-2 mb-0 font-weight-medium'>$salR%</p>
						</div>
						<h6 class='text-muted font-weight-normal'>$salR% From Capital Outlay</h6>
					</div>
					<div class='col-4 col-sm-12 col-xl-4 text-center text-xl-right'>
						<i class='icon-lg mdi mdi mdi mdi-calculator text-primary ml-auto'></i>
					</div>
				</div>";
				}else{
					echo"No generated Sales!";
				}					  
			?>							
			</div>
		</div>
	</div>
</div>
<!-- All Revenues End-->
