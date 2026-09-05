<?php		
	$ex=$link->query("select * from transactions order by serv_date DESC")or die(mysqli_error($link));		
?>

<!-- Transaction List -->
<div class="row">
	<div class="col grid-margin stretch-card">
		<div class='card'>
			<div class='card-body'>
				<h4 class="card-title">Transactions &nbsp; 
					<button style="width:70px" onClick="jump('transactions.php')" class="btn btn-sm btn-outline-success">
						View All
					</button>
					<button style="width:70px" onClick="jump('transactions_add.php')" class="btn btn-sm btn-outline-success">
						+ ADD
					</button>
				</h4>
				<div class='row'>
					<div class='col'>
						<div class="table-responsive" style='height:495px;border-radius:4px'>
							<table class="table table-dark table-hover">
								<thead class="bg-dark text-uppercase">
									<tr>
										<th class='text-center' width='1%'>#</th>
										<th class='text-center' width='1%'>PIC</th>
										<th>DATE</th>
										<th>CLIENT</th>
										<th>UNIT-MODEL</th>
										<th>categories</th>
										<th>DESCRIPTION</th>
										<th>TECHNICIAN</th>
										<th>LABOR</th>
										<th>STATUS</th>
									</tr>
								</thead>	
								<tbody>

								<?php				
									$i=1;
									$val=strtoupper($_POST["t_search"]);
																													
									while($rs=mysqli_fetch_array($ex)){
										
									$lab=$rs["labor_cost"];

									$link->query("UPDATE trans_details SET serv_date = '".$rs["serv_date"]."' WHERE serv_id='".$rs[0]."'");

									$exd=$link->query("SELECT * FROM trans_details WHERE serv_id='".$rs[0]."' ");

									while($rsd=mysqli_fetch_array($exd)){
										$tds=$link->query("SELECT * FROM products WHERE product_id='".$rsd["prod_idno"]."' ");
										$tpd=mysqli_fetch_array($tds);																		
									}

									$cont = $rs[0];
									$tids = sprintf("%04d", $cont);

									echo"
									<tr id='tr_".$rs[0]."'>
										<td class='text-center' width='1%'>$i</td>
										<td class='text-center' width='1%'><img style='height:25px;width:25px;border-radius:50%' class='cust' ";
											if(file_exists("../img/transactions/resized/$rs[0].jpg")){
												echo"src='../img/transactions/resized/$rs[0].jpg' >";
											}else{
												echo"src='../img/favicon.png' >";
											}
										echo"
										</td>										
										<td>".$rs["serv_date"]."</td>
										<td>".$rs["serv_client"]."</td>
										<td>".$rs["unit_make"]." - ".str_replace($val,$rep,$rs["unit_model"])."</td>
										<td>".$rs["serv_categ"]."</td>
										<td>".$rs["serv_desc"]."</td>
										<td>".$rs["technician"]."</td>
										<td>&#8369; ".number_format($rs["labor_cost"],2)."</td>
										<td>";
											if($rs["payment"]=="Paid"){
												echo"<x onclick=\"jump('transactions_details.php?transactions=$rs[0]')\" class='btn-inverse-success cust btn btn-sm text-center' style='width:90px' title='View Details'>Paid</x>";
											}
											if($rs["payment"]=="Pending"){
												echo"<x onclick=\"jump('transactions_details.php?transactions=$rs[0]')\" class='btn-inverse-info cust btn btn-sm text-center' style='width:90px' title='View Details'>Pending</x>";
											}
											if($rs["payment"]=="Collectable"){
												echo"<x onclick=\"jump('transactions_details.php?transactions=$rs[0]')\" class='btn-inverse-danger cust btn btn-sm text-center' style='width:90px' title='View Details'>Collectable</x>";
											}
																				
										echo"
									</tr>";
									$i++;
									} 
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

