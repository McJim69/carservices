<?php	
	if(isset($_POST['year'])){ 	
		$post = $_POST['year'];								
		$Year = "serv_date BETWEEN '$post-01-01' and '$post-12-31'"; 
	}else{
		$post = date("Y");
		$Year = "serv_date BETWEEN '".date("Y")."-01-01' and '".date("Y")."-12-31'";
	}
	require("reports_chart.php");
?>

<div class="row">
	<div class="col-md-3 grid-margin stretch-card">
	   <div class="card">
		  <div class="card-body"><h4 class="card-title">Sales Status</h4>
			 <form action="#" method="post" enctype="multipart/form-data">
				<div class="mb-1" style="position:absolute;top:20px;right:20px">
					<?php 
						echo"
						<select style='text-align:left' class='btn btn-sm btn-outline-success' name='year' type='submit' onchange='this.form.submit()'>	
							<option value=''>$post</option>";
							$stryear = date("Y")-3;
							$endyear = date("Y"); 
							for($j=$stryear;$j<=$endyear;$j++){      
								echo"<option value='$j'>$j</option>";
							}
						echo"
						</select>";
					?>
				</div>
			</form>
			<?php
				if($sales > 0){
				echo"
				<div onClick=\"jump('transactions.php')\">
					<div id='charts' style='margin-top:-20px'>
						<div id='chartContainer2' style='min-height: 215px; width: 100%'></div>
					</div>		
					<div class='d-flex d-md-block d-xl-flex flex-row py-2 px-4 px-md-3 px-xl-4 rounded mt-3 btn btn-inverse-success'>
						<div class='text-md-center text-xl-left'>
							<h6 class='mb-1'>Paid</h6>
						</div>
						<div class='align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0'>
							<h6 class='font-weight-bold mb-0'>&#8369; ".number_format($pdtt,2)." ($pdpa%)</h6>
						</div>
					</div>
					<div class='d-flex d-md-block d-xl-flex flex-row py-2 px-4 px-md-3 px-xl-4 rounded mt-3 btn btn-inverse-info'>
						<div class='text-md-center text-xl-left'>
							<h6 class='mb-1'>Pending</h6>
						</div>
						<div class='align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0'>
							<h6 class='font-weight-bold mb-0'>&#8369; ".number_format($pntt,2)." ($pnpa;%)</h6>
						</div>
					</div>
					<div class='d-flex d-md-block d-xl-flex flex-row py-2 px-4 px-md-3 px-xl-4 rounded mt-3 btn btn-inverse-danger'>
						<div class='text-md-center text-xl-left'>
							<h6 class='mb-1'>Collectable</h6>
						</div>
						<div class='align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0'>
							<h6 class='font-weight-bold mb-0'>&#8369; ".number_format($cltt,2)." ($clpa%)</h6>
						</div>
					</div>
				</div>";
				}else{
					echo"No Data Available for this Year $post!";
				}
			?>			
			</div>
		</div>
	</div>
	<div class="col-md-6 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex flex-row justify-content-between">
					<h4 class="card-title mb-1">Monthly Sales</h4>
					<form action="#" method="post" enctype="multipart/form-data">
						<div class="mb-1">
							<?php 
								echo"
								<select 
									style='text-align:left' 
									class='btn btn-sm btn-outline-success' 
									name='year' 
									type='submit' 
									onchange='this.form.submit()'
								>	
									<option value=''>$post</option>";
									$stryear = date("Y")-3;
									$endyear = date("Y"); 
									for($j=$stryear;$j<=$endyear;$j++){      
										echo"<option value='$j'>$j</option>";
									}
								echo"
								</select>";
							?>
							<input 
								type="button" onClick="jump('summaries.php')" 
								class="btn btn-outline-success" value="Tables"
							>

						</div>
					</form>
				</div>
				
				<?php
					if($sales > 0){
					echo"
					
					<div class='col-lg-12 text-center'>
						<div class='row'>
							<div class='col-lg-12'>
								<div id='chartContainer1' style='min-height:300px;width:100%'></div>													
							</div>
						</div>
						<div class='row' onClick=\"jump('summaries.php')\">	
							<div class='col-lg-2' style='margin-top:10px'>
								<div 
									class='btn btn-sm btn-outline-primary'   
									style='margin:0;width:100%' 
									title='$jan'>".number_format($janT)."
								</div>
							</div>
							<div class='col-lg-2' style='margin-top:10px'>
								<div 
									class='btn btn-sm btn-outline-danger'    
									style='margin:0;width:100%' 
									title='$feb'>".number_format($febT)."
								</div>
							</div>
							<div class='col-lg-2' style='margin-top:10px'>
								<div 
									class='btn btn-sm btn-outline-info'      
									style='margin:0;width:100%' 
									title='$mar'>".number_format($marT)."
								</div>
							</div>
							<div class='col-lg-2' style='margin-top:10px'>
								<div 
									class='btn btn-sm btn-outline-success'   
									style='margin:0;width:100%' 
									title='$apr'>".number_format($aprT)."
								</div>
							</div>
							<div class='col-lg-2' style='margin-top:10px'>
								<div 
									class='btn btn-sm btn-outline-secondary' 
									style='margin:0;width:100%' 
									title='$may'>".number_format($mayT)."
								</div>
							</div>
							<div class='col-lg-2' style='margin-top:10px'>
								<div 
									class='btn btn-sm btn-outline-warning'   
									style='margin:0;width:100%' 
									title='$jun'>".number_format($junT)."
								</div>
							</div>
							<div class='col-lg-2' style='margin-top:10px'>
								<div 
									class='btn btn-sm btn-outline-primary'   
									style='margin:0;width:100%' 
									title='$jul'>".number_format($julT)."</div>
							</div>
							<div class='col-lg-2' style='margin-top:10px'>
								<div 
									class='btn btn-sm btn-outline-info'      
									style='margin:0;width:100%' 
									title='$aug'>".number_format($augT)."
								</div>
							</div>
							<div class='col-lg-2' style='margin-top:10px'>
								<div 
									class='btn btn-sm btn-outline-primary'   
									style='margin:0;width:100%' 
									title='$sep'>".number_format($sepT)."
								</div>
							</div>
							<div class='col-lg-2' style='margin-top:10px'>
								<div 
									class='btn btn-sm btn-outline-info'      
									style='margin:0;width:100%' 
									title='$oct'>".number_format($octT)."
								</div>
							</div>
							<div class='col-lg-2' style='margin-top:10px'>
								<div 
									class='btn btn-sm btn-outline-warning'   
									style='margin:0;width:100%' 
									title='$nov'>".number_format($novT)."
								</div>
							</div>
							<div class='col-lg-2' style='margin-top:10px'>
								<div 
									class='btn btn-sm btn-outline-success'   
									style='margin:0;width:100%' 
									title='$dec'>".number_format($decT)."
								</div>
							</div>
						</div>
					</div>";
				
				}else{
					echo"No Data Available for this Year $post!";
				}
			?>
				
			</div>
		</div>
	</div>

	<?php require("transactions_status.php");?>
	
</div>
