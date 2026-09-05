<?php 
	require("header.php");
	require("navbar.php");
	
	if(isset($_POST['submit'])){	

	$insert = $link->query("INSERT INTO  products VALUES (0,
		'".$_POST["product_stock"]."',
		'".$_POST["product_unit"]."',
		'".$_POST["product_name"]."',
		'".$_POST["product_category"]."',
		'".$_POST["description"]."',
		'".$_POST["product_price"]."',0,0)");

		if(($insert)== TRUE){
			echo"<script>window.location.href='transactions_details.php?transactions=$serv_id';</script>";
		}
	}

    function fill_categories($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT * FROM categories order by cat_id");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row['cat_name'].'">'.$row["cat_name"].'</option>';
		}	return $output;
	}

    function fill_unit($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT * FROM units order by unit_id");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row['unit_name'].'">'.$row["description"].'</option>';
		}	return $output;
	}
?>

<div class="content-wrapper">
	<h2 class="card-title">Product Add &nbsp;
		<button class='btn btn-sm btn-outline-info' onClick="jump('products.php')" title='Back'> 
			<b><</b> Back
		</button>
	</h2>
	<div class="row">
		<div class="col-lg-3 grid-margin stretch-card">
			<div class='card'>
				<div class="card-body">
					<div class="row" style="height:495px">
						<div class="col-lg-12">
							<img style="height:100%;width:100%;opacity:.3" src="../img/parts.jpg?<?php echo date("h:i:s");?>"/>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<div class="col-lg-4 grid-margin stretch-card">
			<div class='card'>
				<div class='card-body' style='color:#bbb'>
					<form action="#" method="POST" enctype="multipart/form-data">
						<div class='form-group'>
							<label for='product_name'>Product Name</label>
							<input type='text' class='form-control bg-dark text-light' name='product_name' placeholder='Product Name' required >
						</div>
						<div class='form-group'>
							<label for='product_category'>Product categories</label>
							<select type='text' class='form-control bg-dark text-light' name='product_category' required >
								<option value="">Select categories</option>
								<?php echo fill_categories($pdo);?>	
							</select>
						</div>
						<div class='form-group'>
							<label>Product Description</label>
							<input type='text' class='form-control bg-dark text-light' name='description' placeholder='Description' required >
						</div>
						<div class='form-group'>
							<label for='product_stock'>Number of Stock</label>
							<input type='number' class='form-control bg-dark text-light' name='product_stock' placeholder='Number of Stock' required >
						</div>
						<div class='form-group'>
							<label for='product_unit'>Product Unit</label>
							<select type='text' class='form-control bg-dark text-light' name='product_unit' required >
								<option value="">Select Unit</option>
								<?php echo fill_unit($pdo);?>	
							</select>
						</div>
						<div class='form-group'>
							<label for='product_price'>Product Price</label>
							<input type='number' class='form-control bg-dark text-light' name='product_price' placeholder='Product Price' required >
						</div>
						<div>
							<button class="btn btn-primary btn-block" type="SUBMIT" name="submit">SUBMIT</button>
						</div>
					</form>
				</div>
			</div>								
		</div>
	<style> .cust{ margin: -10px 0 -10px 0; text-align:left} </style>
		<div class="col-md-5 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="d-flex flex-row justify-content-between">
						<h4 class="card-title mb-1">Out of Stocks &nbsp; <button onClick="jump('products.php')" class="btn btn-sm btn-outline-success">View All</button></h4>
					</div>
					<div class="table-responsive" style="margin-top:15px;height:450px">
						<table class="table table-dark table-hover">
							<thead class="bg-dark">
								<th>#</th>
								<th>DESCRIPTION</th>
								<th>ACTIONS</th>
							</thead>	
							<tbody>											
							<?php 
								$i=1;
								$pos = $link->query("SELECT * FROM products WHERE product_stock<1") or die(mysqli_error($link));

								while($rs=mysqli_fetch_array($pos)){

									echo"<tr id='tr_".$rs[0]."'>";
									echo"<td>$i.</td>";
									echo"<td>".$rs["description"]."</td>";
									echo"<td>";
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

<?php require("footer.php");?>
