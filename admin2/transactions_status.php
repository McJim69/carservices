<?php
	
	if(isset($_POST['status'])){ 
		$statN = $_POST['status'];
	}else{
		$statN = "Select";
	}
?>

<div class="col-md-3 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<div class="d-flex flex-row justify-content-between">
				<h4 class="card-title mb-1">Transaction Status</h4>
				<form action="#" method="post" enctype="multipart/form-data">
				<div class="text-muted mb-1" >
					<select style="text-align:left" type="button" class="btn btn-sm btn-outline-success" name="status" type="submit" onchange="this.form.submit()">
						<option value=""><?php echo $statN;?></option>
						<option value="Paid">Paid</option>
						<option value="Pending">Pending</option>
						<option value="Collectable">Collectable</option>
					</select>
				</form>
				</div>
			</div>
			<div class="table-responsive" style="margin-top:10px;height:355px">
				<table class="table table-dark table-hover">
					<!--
					<thead class="bg-dark">
						<th>#</th>
						<th>CLIENT</th>
						<th>STATUS</th>
					</thead>
					-->
					<tbody>											
					<?php 
						
						$i=1;
						
						$cls = "style='cursor:pointer;height:35px;padding:0px'";
						
						if(isset($_POST['status'])){ 
							$ex=$link->query("SELECT * FROM transactions WHERE payment = '$statN' ORDER BY serv_date DESC");
							while($rs=mysqli_fetch_array($ex)){
							echo"<tr id='tr_".$rs[0]."' onclick=\"jump('transactions_details.php?transactions=$rs[0]')\">";
							echo"<td $cls class='text-center'>$i.</td>";
							echo"<td $cls>".$rs["serv_client"]."</td>";
							echo"<td $cls>";
								if($rs["payment"]=="Paid"){
									echo"<x class='btn-inverse-success cust btn btn-sm text-center' style='width:88px'>Paid</x>";
								}
								if($rs["payment"]=="Pending"){
									echo"<x class='btn-inverse-warning cust btn btn-sm text-center' style='width:88px'>Pending</x>";
								}
								if($rs["payment"]=="Collectable"){
									echo"<x class='btn-inverse-danger  cust btn btn-sm text-center' style='width:88px'>Collectable</x>";
								}
							echo"</td>";
							echo"</tr>";		
							$i++;
							}
						}else{
							$ex=$link->query("SELECT * FROM transactions ORDER BY serv_date DESC");
							while($rs=mysqli_fetch_array($ex)){

							echo"<tr id='tr_".$rs[0]."' onclick=\"jump('transactions_details.php?transactions=$rs[0]')\">";
							echo"<td $cls class='text-center'>$i.</td>";
							echo"<td $cls>".$rs["serv_client"]."</td>";
							echo"<td $cls>";
								if($rs["payment"]=="Paid"){
									echo"<x class='btn-inverse-success cust btn btn-sm text-center' title='Paid' style='width:88px'>Paid</x>";
								}
								if($rs["payment"]=="Pending"){
									echo"<x class='btn-inverse-info cust btn btn-sm text-center' title='Pending' style='width:88px'>Pending</x>";
								}
								if($rs["payment"]=="Collectable"){
									echo"<x class='btn-inverse-danger cust btn btn-sm text-center' title='Collectable' style='width:88px'>Collectable</x>";
								}
							echo"</td>";
							echo"</tr>";		
							$i++;
							}
						}							
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>	