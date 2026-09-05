<?php 
	require("header.php");
	require("navbar.php");

	function fill_tech($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT * FROM technicians order by tech_id");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$cont = $row["fullname"];
			$cont = ucwords(strtolower($cont));
			
			$output.='<option value="'.$cont.'">'.$cont.'</option>';
		} 	return $output;
    }	
	
	if(isset($_POST["search"])){

		if($_POST["tech"]!==""){
			$name=$_POST["tech"];
			$tran="and technician='".$_POST["tech"]."'";
		}else{
			$name="Technician (All)";	
			$tran="and technician=technician";
		}
			   
		if($_POST["from"]!==""){
			$dafr=$_POST["from"];
		}else{
			$datQ=$link->query("SELECT serv_date AS date FROM transactions ORDER BY serv_date LIMIT 1");
			$datR=mysqli_fetch_array($datQ);
			$dafr=$datR["date"];
		}

		if($_POST["dato"]!==""){
			$dato=$_POST["dato"];
		}else{
			$dato=date("Y-m-d");
		}

		$ext=$link->query("SELECT * FROM transactions WHERE serv_date BETWEEN '$dafr' AND '$dato' $tran ORDER BY serv_id") or die(mysqli_error($link));				

		$sum = $link->query("SELECT SUM(labor_cost) FROM transactions WHERE serv_date BETWEEN '$dafr' AND '$dato' $tran ORDER BY serv_id") or die(mysqli_error($link));
		$res = mysqli_fetch_array($sum);			
		$TOT = $res[0];
	}	
?>

<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h2>Summaries &nbsp; 
				<a href='index.php' title='Back' class='btn btn-sm btn-outline-info'> 
					<i class='mdi mdi-arrow-left'></i> Back
				</a> &nbsp;
				<a href='summaries.php' title='Refresh' class='btn btn-sm btn-outline-info'>
					<i class='mdi mdi-magnify'></i> Refresh
				</a>
			</h2> 
			<div class="card">
				<div class="card-body"><h4 class="card-title">Select Transaction Date</h4>
					<form action="#" method="post" enctype="multipart/form-data">
						<div class='row form-group'>
							<div class='col-lg-6'>
								<div class='row'>
									<div class='col-lg-3'>
										<input 
											name="from" 
											placeholder="Date from" 
											onFocus="(this. type='date')" 
											class="bg-dark btn btn-outline-primary btn-block"
										>
									</div>
									<div class='col-lg-3'>
										<input 
											name="dato" 
											placeholder="Date to" 
											onFocus="(this. type='date')" 
											class="bg-dark btn btn-outline-primary btn-block"
										>
									</div>

									<div class='col-lg-3'>
										<select 
											name="tech"
											style="text-align:left"
											class="bg-dark btn btn-outline-primary btn-block"
										>
											<option value="">
											<?php 
												if($_POST["tech"]==""){
													echo"Technician (All)";
												}else{
													echo"".$_POST["tech"]."";	
												}
											?>
											</option>
											<?php echo fill_tech($pdo);?>
										</select>
									</div>
									<div class='col-lg-3'>
										<button 
											type="submit" 
											name="search" 
											onChange="this.form.submit()" 
											class="bg-dark btn btn-outline-primary btn-block"
										>
											<i class="mdi mdi-magnify"></i>Search
										</button>
									</div>
								</div>
							</div>
						</div>		

					<?php	
						$i=1;
						if(isset($_POST["search"])){
								
						$date1=date_create($dafr);
						$date2=date_create($dato);

						$trans=number_format(mysqli_num_rows($ext),0);
						
						echo" 
						<div class='row form-group'>
							<div class='col-lg-3'>
								<div class='btn-sm form-control text-center text-secondary text-uppercase'>
									<b>$name</b>
								</div>
							</div>
							<div class='col-lg-3'>
								<div class='btn-sm form-control text-center text-secondary'>
									From: <b>".date_format($date1,"M d, Y")."</b>
								</div>
							</div>
							<div class='col-lg-3'>
								<div class='btn-sm form-control text-center text-secondary'>
									To: <b>".date_format($date2,"M d, Y")."</b>
								</div>
							</div>
							<div class='col-lg-3'>
								<div class='btn-sm form-control text-center text-secondary'>
									Total Transactions: <b>$trans</b> 
								</div>
							</div>
						</div>";
						
						if($trans > 0){
						
						echo"	

						<div class='table-responsive'>
							<table class='table table-black table-hover'>
								<thead class='bg-dark'>
									<tr>
										<th width='2%' style='text-align:center'>#</th>
										<th>Client</th>
										<th>Unit/Model</th>
										<th>Description</th>
										<th>Technician</th>
										<th>Date</th>
										<th style='text-align:right'>Labor</th>
										<th style='text-align:right'>Materials</th>
										<th style='text-align:right'>Total</th>
									</tr>
								</thead>
								<tbody>";

								$Ltot=0;
								$Mtot=0;
								$Gtot=0;

								while($rsi=mysqli_fetch_array($ext)){
								
								$qrym = $link->query("SELECT SUM(product_price) FROM trans_details WHERE serv_id='".$rsi[0]."'") or die(mysqli_error($link));
								$arym = mysqli_fetch_array($qrym);			

								$mate = $arym[0];
								$labr = $rsi["labor_cost"];					
								$tots = $mate+$labr;
								
								echo"<tr onClick=\"jump('transactions_details.php?transactions=$rsi[0]')\">
										<td><b>$i.</b></td>
										<td class='text-left text-uppercase'>".$rsi["serv_client"]."</td>
										<td>".$rsi["unit_make"]."-".$rsi["unit_model"]."</td>
										<td>".$rsi["serv_desc"]."</td>
										<td>".$rsi["technician"]."</td>
										<td>".$rsi["serv_date"]."</td>
										<td style='text-align:right'>".number_format($labr,2)."</td>
										<td style='text-align:right'>".number_format($mate,2)."</td>
										<td style='text-align:right'>".number_format($tots,2)."</td>
									</tr>";

								$Ltot+=$labr;
								$Mtot+=$mate;
								$Gtot+=$tots;
																																	
								$i++;
							} 
							echo"
								</tbody>
								<tfoot class='bg-dark'>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th>TOTALS</th>
									<th></th>
									<th style='text-align:right'>&#8369; ".number_format($Ltot,2)."</th>
									<th style='text-align:right'>&#8369; ".number_format($Mtot,2)."</th>
									<th style='text-align:right'>&#8369; ".number_format($Gtot,2)."</th>
								</tfoot>
							</table>
						</div> ";		
					}
					
				}else{
								
					if(isset($_POST['year'])){ 	
						$post = $_POST['year'];								
						$Year = "serv_date BETWEEN '$post-01-01' and '$post-12-31'"; 
					}else{
						$post = date("Y");
						$Year = "serv_date BETWEEN '".date("Y")."-01-01' and '".date("Y")."-12-31'";
					}
					
					$totA=0;
					
					$allQ=$link->query("SELECT SUM(labor_cost) AS total FROM transactions WHERE $Year");
					$allA=$allQ->fetch_assoc();
					$allT=$allA["total"];

					$almQ=$link->query("SELECT SUM(product_price) AS total FROM trans_details WHERE $Year");
					$almA=$almQ->fetch_assoc();
					$almT=$almA["total"];
					
					$tlmT=$allT+$almT;
					
					$totA+=$tlmT;
					
					echo"
						<div class='row form-group'>
							<div class='col-lg-6'>
								<div class='row'>
									<div class='col-lg-3'>
										<select class='btn btn-outline-primary btn-sm btn-block' name='year' type='submit' onchange='this.form.submit()'>	
											<option value=''>$post</option>";
											$stryear = date("Y")-3;
											$endyear = date("Y"); 
											for($j=$stryear;$j<=$endyear;$j++){      
												echo"<option value='$j'>$j</option>";
											}
											echo"
										</select> 
									</div> ";
								if($totA>0){
								echo"
									<div class='col-lg-3'>
										<span class='btn btn-outline-primary btn-block'>
											Labor ".number_format($allT)."
										</span>
									</div>
									<div class='col-lg-3'>
										<span class='btn btn-outline-primary btn-block'>
											Parts ".number_format($almT)."
										</span>
									</div>
									<div class='col-lg-3'>
										<span class='btn btn-outline-primary btn-block'>
											Total ".number_format($totA)."
										</span>
									</div>
									";
								}else{
									echo" 
										<div class='col-lg-6'>
											<x class='btn btn-outline-primary text-warning'> Mingaw man! way halin nga makita sa tuig $post !</x> 
										</div>
									";
								}
									echo"	
								</div>
							</div>
						</div> ";
						
						$month = $link->query("SELECT
							serv_id AS id,
							DATE_FORMAT(serv_date, '%M') AS month, 
							DATE_FORMAT(serv_date, '%m') AS moon, 
							DATE_FORMAT(serv_date, '%Y') AS year, 
							SUM(labor_cost) AS labor,
							COUNT(serv_id) AS labno,
							serv_id AS id
							FROM transactions
							WHERE $Year 
							GROUP BY MONTH(serv_date), 
							YEAR(serv_date)")or die (mysqli_error($link));							

						if($month->num_rows > 0){
															
						echo"
							<div class='table-responsive' style='height:630px'>
								<table class='table table-black table-hover'>
									<thead class='bg-dark text-uppercase'>
										<tr>
											<th width='2%' style='text-align:center'>#</th>
											<th>Year</th>
											<th>Month</th>
											<th>Trans</th>
											<th>Labor</th>
											<th>Parts</th>
											<th>Qty</th>
											<th>Total</th>
										</tr>
									</thead>
											
									<tbody>";

									while($row = mysqli_fetch_array($month)){	
										$labid = $row["id"];
										$labno = $row["labno"];
										$labor = $row["labor"];
										$labmo = $row["month"];
										$labyr = $row["year"];
										$moons = $row["moon"];

										$betwn = "serv_date BETWEEN '$post-$moons-01' and '$post-$moons-31'";
										
										$matqr = $link->query("SELECT 
											dets_idno as id,
											SUM(product_price) AS mater, 
											COUNT(dets_idno) AS matno 
											FROM trans_details 
											WHERE $betwn") or die(mysqli_error($link));
										$matrs = mysqli_fetch_array($matqr);			
										
										$matno = $matrs["matno"];
										$mater = $matrs["mater"];
										
										$labc += $labno;
										$matc += $matno;
										$labt += $labor;
										$matt += $mater;	
										
										$total=$labor + $mater;
										
										$grdt+=$total;
										
										echo"
										</tr>
											<td> <b> $i.</b> </td>
											<td>".$labyr."</td>
											<td>".$labmo."</td>
											<td>".number_format($labno)."</td>
											<td>&#8369; ".number_format($labor,2)."</td>
											
											<td>&#8369; ".number_format($mater,2)."</td>
											<td>".number_format($matno)."</td>
											<td>&#8369; ".number_format($total,2)."</td>
										</tr>";

										$i++;

										}
										echo"
											</tbody>					
										<tfoot class='bg-dark' style='font-weight:bold'>
											<td></td>
											<td></td>
											<td>TOTALS</td>
											<td>".number_format($labc)."</td>
											<td>&#8369; ".number_format($labt,2)."</td>
											<td>&#8369; ".number_format($matt,2)."</td>
											<td>".number_format($matc)."</td>
											<td>&#8369; ".number_format($grdt,2)."</td>
										</tfoot>
									</table>
								</div>
							</form>	";
							} 	
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Reports End -->

<?php require("footer.php");?>
