<?php 
	require("header.php");
	require("navbar.php");

	$i=1;

	if(isset($_POST['year'])){ 	
		$post = $_POST['year'];								
		$Year = "serv_date BETWEEN '$post-01-01' and '$post-12-31'"; 
	}else{
		$post = date("Y");
		$Year = "serv_date BETWEEN '".date("Y")."-01-01' and '".date("Y")."-12-31'";
	}

	$granC=0;
	$granT=0;

	$matrQ = $link->query("SELECT
		serv_id AS id,
		DATE_FORMAT(serv_date, '%M') AS month, 
		DATE_FORMAT(serv_date, '%Y') AS year, 
		SUM(product_price) AS total,
		COUNT(serv_id) AS count
		FROM trans_details
		WHERE $Year 
		GROUP BY MONTH(serv_date), 
		YEAR(serv_date)");		
	//
?>

<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
				<?php
					echo"
					<select class='btn btn-sm btn-light' style='background:#eee;text-align:left;border:1px solid #bbb' name='year' type='submit' onchange='this.form.submit()'>	
						<option value='1'>$post</option>";
						$stryear = date("Y")-3;
						$endyear = date("Y"); 
						for($j=$stryear;$j<=$endyear;$j++){      
							echo"<option value='$j'>$j</option>";
						}
					echo"
					</select>";
				?>

					<div class='table-responsive'>
						<table class='table tale-dark table-hover'>
							<thead class="bg-dark text-uppercase">
								<tr>
									<th>#</th>
									<th>Months</th>
									<th>Qty</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$granC=0;
								$granT=0;

								$matrQ = $link->query("SELECT
									serv_id AS id,
									DATE_FORMAT(serv_date, '%M') AS month, 
									DATE_FORMAT(serv_date, '%Y') AS year, 
									SUM(product_price) AS total,
									COUNT(serv_id) AS count
									FROM trans_details
									WHERE $Year 
									GROUP BY MONTH(serv_date), 
									YEAR(serv_date)");		
		
								while($matrs = mysqli_fetch_array($matrQ)){						
									
									$mname = $matrs["month"]; 
									$mtqty = $matrs["count"];
									$mater = $matrs["total"];
									
									$granC+=$mtqty;
									$granT+=$mater;
									
									echo"<tr>";
										echo"<td>$i</td>";
										echo"<td>$mname</td>";
										echo"<td>$mtqty</td>";
										echo"<td>$mater</td>";
									echo"</tr>";
									$i++;
								}
								echo"
								<tfoot class='bg-dark text-uppercase'>
									<tr>
										<th></th>
										<th>Totals</th>
										<th>$granC</th>
										<th>$granT</th>
									</tr>

								</tfoot>
								";
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require("footer.php");?>
