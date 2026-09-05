	<div class="col-md-5 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex flex-row justify-content-between">
				<h4 class="card-title mb-1">Out of Stocks &nbsp; 
					<button style="width:70px" onClick="jump('products.php')" class="btn btn-sm btn-outline-success">
						View All
					</button>
					<button style="width:70px" onClick="jump('products_add.php')" class="btn btn-sm btn-outline-success">
						+ ADD
					</button>
				</h4>
				</div>
				<div class="table-responsive" style="margin-top:10px;height:410px">
					<table class="table table-dark table-hover">
						<thead class="bg-dark">
							<th>#</th>
							<th>DESCRIPTION</th>
							<th>ACTION</th>
						</thead>	
						<tbody>											
						
						<?php 
							
							$i=1;
							
							$cls = "style='height:37px;padding:5px'";
							
							$pos = $link->query("SELECT * FROM products WHERE product_stock<1") or die(mysqli_error($link));

							while($rs=mysqli_fetch_array($pos)){
									
								echo"<tr id='tr_".$rs[0]."'>";
								echo"<td $cls class='text-center'>$i.</td>";
								echo"<td $cls>".$rs["description"]."</td>";
								echo"<td $cls>";
									echo"<span class='class='btn btn-block btn-group'>";
									echo"<i onclick=\"jump('products_edit.php?products=$rs[0]')\" class='btn-inverse-success cust btn btn-sm mdi mdi-grease-pencil' title='Edit'></i>";
									echo"<i onclick=\"deleteProduct('$rs[0]');\" class='btn-inverse-danger cust btn btn-sm mdi mdi-window-close' title='Delete'></i>";
									echo"</span>";
								echo"</td>";
								echo"</tr>";
			
								$i++;
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>	
	
<script>
	function deleteProduct(product_id){	
		if(confirm("Are you sure you want to Remove this Transaction?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#tr_"+product_id).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#tr_"+product_id).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","../admin_products_delete.php?product_id="+product_id,true);
			xmlhttp.send();
		}
	}	
</script>	