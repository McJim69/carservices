<?php 
	require("header.php");
	require("navbar.php");
	
	if(isset($_POST['upDate'])){	
		$product_id    = $_POST['product_id'];
		$product_name  = $_POST['product_name'];
		$product_cat   = $_POST['product_category'];
		$description   = $_POST['description'];
		$product_stock = $_POST['product_stock'];
		$product_unit  = $_POST['product_unit'];
		$product_price = $_POST['product_price'];

	$update = $link->query("UPDATE products set
		product_id  	 = '$product_id',
		product_name 	 = '$product_name',
		product_category = '$product_cat',
		description 	 = '$description',
		product_stock 	 = '$product_stock',
		product_unit 	 = '$product_unit',
		product_price 	 = '$product_price' where product_id = '$product_id'");

		if(($update)== TRUE){
			$link->query("UPDATE trans_details SET product_name = '$product_name' WHERE product_id='$product_id'");
			$link->query("UPDATE trans_details SET product_price = '$product_price' WHERE product_id='$product_id'");
			echo"<script>window.location.href='products_edit.php?products=$product_id';</script>";
		}else{
			echo mysqli_error($link);
		}
	}
		
    function fill_categories($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT cat_name FROM categories order by cat_id");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row[0].'">'.$row[0].'</option>';
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
	<h2 class="card-title">Product Details &nbsp;
		<a href="products.php" class='btn btn-sm btn-outline-info mdi mdi-arrow-left btn-icon-text' title='Back'> 
			Back
		</a>
	</h2>
	<div class="row">
	
		<div class='col-lg-3 grid-margin stretch-card'>
			<div class='card'>
				<div class='card-body' style='color:#bbb'>
					<div class='row'>
						<div class='col'>
	
						<?php	
							$prod="";
							if($_GET["products"]!="")
								$prod=" and product_id='".$_GET["products"]."' ";
																			
							$ex = $link->query("select * from products where product_id=product_id $prod order by product_id limit 1");

							while($rs = mysqli_fetch_array($ex)){	

								$ex = $link->query("select * from products t where t.product_id='$rs[0]' and t.product_id=t.product_id ");

								while($rs = mysqli_fetch_array($ex)){	
									
								$cont = $rs[0];
								$tids = sprintf("%04d", $cont);

								if(isset($_POST["b_upImg_$rs[0]"])){
									move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "../img/products/$rs[0].jpg");
									$link->query("update products set product_img=1 where product_id='$rs[0]'");
									jump("");

									$origFile="../img/products/$rs[0].jpg";
									$destFile="../img/products/resized/$rs[0].jpg";
											
									$source = imagecreatefromjpeg($origFile);
									list($width, $height) = getimagesize($origFile);

									$newWidth = 300;
									$newHeight = 300;

									$thumb = imagecreatetruecolor($newWidth, $newHeight);
									imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
									imagejpeg($thumb, $destFile, 80);
								}						
										
								echo"
									<div style='margin-bottom:0px'>
										<p>Product ID: No. <b>$tids</b></p>
										<p>Product Name: <b>".$rs["product_name"]."</b></p>
										<p>Product categories: <b>".$rs["product_category"]."</b></p>
									</div>
									<div class='text-center'>
										<img style='height:100%;width:100%; border-radius:4px;background:#eee' ";
											if(file_exists("../img/products/resized/$rs[0].jpg")){			
												echo" src='../img/products/resized/$rs[0].jpg? ".date("h:i:s")." ' />";
											}else{
												echo" src='../img/favicon.png' style='opacity:.5' />";
											}

										echo"
									</div><br>
									<div class='text-center'>
										<form action='#' method='POST' enctype='multipart/form-data'>
										<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
										<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
										<input class='btn btn-primary btn-block' value='Change Photo' onclick=\"$('#b_file_$rs[0]').click();\"/>
										</form>	
									</div>
								";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class='col-lg-4 grid-margin stretch-card'>
			<div class='card'>
				<div class='card-body' style='color:#bbb'>
					<div class='row'>
						<div class='col'>
		
							<?php 
								echo"
								<form action='#' method='POST' enctype='multipart/form-data'>							
								<input type='hidden' name='product_id' value='$rs[0]'>
								<div class='form-group'>
									<div>Product categories</div>
									<select type='text' style='text-align:left' class='form-control btn btn-dark' name='product_category' required >
										<option value='".$rs["product_category"]."'>".$rs["product_category"]."</option>
											".fill_categories($pdo)."
									</select>
								</div>
								<div class='form-group'>
									<div>Product Name</div>
									<input type='text' style='text-align:left' class='form-control btn btn-dark' name='product_name' value='".$rs["product_name"]."' placeholder='Product Name' required >
								</div>
								<div class='form-group'>
									<div>Product Description</div>
									<input type='text' style='text-align:left' class='form-control btn btn-dark' name='description' placeholder='Product Description' value='".$rs["description"]."' required >
								</div>
								<div class='form-group'>
									<div>Product Stock</div>
									<input type='number' style='text-align:left' class='form-control btn btn-dark' name='product_stock' value='".$rs["product_stock"]."' placeholder='Product Stock' required >
								</div>
								<div class='form-group'>
									<div>Product Unit</div>
									<select type='text' style='text-align:left' class='form-control btn btn-dark' name='product_unit' required >
										<option value='".$rs["product_unit"]."'>".$rs["product_unit"]."</option>
											".fill_unit($pdo)."
									</select>
								</div>
								<div class='form-group'>
									<div>Product Price</div>
									<input type='number' style='text-align:left' class='form-control btn btn-dark' name='product_price' value='".$rs["product_price"]."' placeholder='Product Price' required >
								</div>
								<div>
									<button class='btn btn-primary btn-block' type='SUBMIT' name='upDate'>Save</button>
								</div>
								</form>
							";
						?>		
					</div>					
				</div>
			</div>
		</div>
	</div>

<?php } } ?>		

	<style> 
		.cust{ 
			margin: -10px 0 -10px 0; 
			text-align:left
		} 
	</style>
		
		<div class="col-lg-5 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title mb-1">Out of Stocks &nbsp; <button onClick="jump('products.php')" class="btn btn-sm btn-outline-success">View All</button></h4>
					<div class="table-responsive" style="margin-top:20px;height:453px">
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

<?php require("footer.php");?>
