<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
	if(isset($_POST['submit'])){	

	$insert = $link->query("INSERT INTO  products VALUES (0,
		'".$_POST["product_stock"]."',
		'".$_POST["product_unit"]."',
		'".$_POST["product_name"]."',
		'".$_POST["product_category"]."',
		'".$_POST["description"]."',
		'".$_POST["product_price"]."',0,0)");

		if(($insert)== TRUE){
			echo"<script>history.back();</script>";
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

<script> setActive("products"); </script>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Add Product</h1>
			<div>
				<span style="cursor:pointer" onClick="jump('admin_products.php')" class="btn btn-primary rounded-pill"><i title="Back to List" class="fa fa-arrow-left text-light"></i> Back to List</span>
			</div>			
		</div>
	</div>
</div>
<!-- Page Header End -->

<form action="#" method="POST" enctype="multipart/form-data">

<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
	<div class="container text-center" style="margin-top:-50px">
		<div class="row justify-content-center">
			<div class="col-lg-7" style="border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
				<div class="row">
					<div class="col-lg-6 form-group mt-3">
						<div class="bg-light text-center">
							<img style="min-height:385px;border-radius:4px;border:1px solid #bbb;width:100%;background:#fff;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;" 
							src="img/products.png" />
						</div>
					</div>
					<div class="col-lg-6 form-group mt-3">
						<div style="min-height:297px;background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;width:100%;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px">
							<div class='form-floating' style='margin:5px'>
								<input type='text' class='form-control' name='product_name' placeholder='Product Name' required >
								<label for='product_name'>Product Name</label>
							</div>
							<div class='form-floating' style='margin:5px'>
								<select style='background:#fff' type='text' class='form-control' name='product_category' required >
									<option value="">Select categories</option>
									<?php echo fill_categories($pdo);?>	
								</select>
								<label for='product_category'>Product categories</label>
							</div>
							<div class='form-floating' style='margin:5px'>
								<textarea type='text' class='form-control' name='description' required ></textarea>
								<label for='description'>Product Descriptions</label>
							</div>
							<div class='form-floating' style='margin:5px'>
								<input type='number' class='form-control' name='product_stock' placeholder='Number of Stock' required >
								<label for='product_stock'>Number of Stock</label>
							</div>
							<div class='form-floating' style='margin:5px'>
								<select style='background:#fff' type='text' class='form-control' name='product_unit' required >
									<option value="">Select Unit</option>
									<?php echo fill_unit($pdo);?>	
								</select>
								<label for='product_unit'>Product Unit</label>
							</div>
							<div class='form-floating' style='margin:5px'>
								<input type='number' class='form-control' name='product_price' placeholder='Product Price' required >
								<label for='product_price'>Product Price</label>
							</div>
						</div>
					</div>
					<div class="col" style="margin:20px 0 20px 0">
						<button class="btn btn-primary rounded-pill" type="SUBMIT" name="submit" style="width:100%;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">SUBMIT</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

</form>

<?php require("admin_footer.php");?>