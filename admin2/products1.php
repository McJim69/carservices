<?php		
	$ex=$link->query("SELECT * FROM products ORDER BY rand() LIMIT 10")or die(mysqli_error($link));		
?>

<style> .cust{ margin: -10px 0 -10px 0; } </style>

<!-- Transaction List -->
<div class="row">
	<div class="col grid-margin stretch-card">
		<div class='card'>
			<div class='card-body'>
				<h4 class="card-title">Products &nbsp; 
					<button style="width:70px" onClick="jump('products.php')" class="btn btn-sm btn-outline-success">
						View All
					</button>
					<button style="width:70px" onClick="jump('products_add.php')" class="btn btn-sm btn-outline-success">
						+ ADD
					</button>
				</h4>
				<div class='row'>
					<div class='col'>
						<div class="table-responsive" style="height:495px">
							<table class="table table-dark table-hover">
								<thead class="bg-dark">
									<tr>
										<th>#</th>
										<th>PIC</th>
										<th>STOCK</th>
										<th>UNIT</th>
										<th>categories</th>
										<th>NAME</th>
										<th>DESCRIPTION</th>
										<th>PRICE</th>
										<th>ACTION</th>
									</tr>
								</thead>	
								<tbody>

								<?php				
									$i=1;
																				
									while($rs=mysqli_fetch_array($ex)){
									
									$price = $rs["product_price"];
									$stock = $rs["product_stock"];

									if($stock<1){
										$prods="<x class='text-warning'>Out of Stock</x>";
									}elseif($stock==1){
										$prods="<x class='text-info'>$stock Remaining</x>";
									}else{
										$prods="<x class='text-success'>$stock Remaining</x>";
									}
									
									echo"
									<tr id='tr_".$rs[0]."'>
										<td>$i</td>
										<td>
											<img style='height:25px;width:25px;border-radius:50%' class='cust' ";
											if(file_exists("../img/products/resized/$rs[0].jpg")){
												echo"src='../img/products/resized/$rs[0].jpg' >";
											}else{
												echo"src='../img/favicon.png' >";
											}
										echo"
										</td>
										<td>$prods</td>
										<td>".$rs["product_unit"]."</td>
										<td>".$rs["product_category"]."</td>
										<td>".$rs["product_name"]."</td>
										<td>".$rs["description"]."</td>
										<td>&#8369; ".number_format($price,2)."</td>
										<td>
											<span class='class='btn btn-block btn-group'>
												<i onclick=\"jump('products_edit.php?products=$rs[0]')\" class='btn-inverse-success cust btn btn-sm mdi mdi-grease-pencil' title='Edit'></i>
												<i onclick=\"deleteProduct('$rs[0]');\" class='btn-inverse-danger cust btn btn-sm mdi mdi-window-close' title='Delete'></i>
											</span>
										</td>
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

<script>
	function deleteProduct(product_id){	
		if(confirm("Are you sure you want to Remove this Product?")){
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
