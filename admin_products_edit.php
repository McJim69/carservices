<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");	

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
			echo"<script>history.back();</script>";
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

<script> setActive("products"); </script>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Update Product</h1>
			<button onClick="history.back()" class="btn btn-primary">
				<i class="fa fa-arrow-left"></i> Back
			</button>
		</div>
	</div>
</div>
<!-- Page Header End -->

<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
	<div class="container text-center" style="margin-top:-50px">

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
			move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "img/products/$rs[0].jpg");
			$link->query("update products set product_img=1 where product_id='$rs[0]'");
			jump("");

			$origFile="img/products/$rs[0].jpg";
			$destFile="img/products/resized/$rs[0].jpg";
					
			$source = imagecreatefromjpeg($origFile);
			list($width, $height) = getimagesize($origFile);

			$newWidth = 300;
			$newHeight = 300;

			$thumb = imagecreatetruecolor($newWidth, $newHeight);
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
			imagejpeg($thumb, $destFile, 80);
		}						

		echo"

		<form action='#' method='POST' enctype='multipart/form-data'>
			<div class='row justify-content-center'>
				<div class='col-lg-6' style='border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;'>
					<div class='row'>
						<div class='col-lg-12' style='margin-top:12px'>
							<div class='bg-light'>
								<div class='text-primary' style='font-size:25px'><b>Product ID: $tids</b></div>
							</div>
						</div>						
						<div class='col-lg-6 form-group mt-3'>
							<div class='bg-light text-center'>
								<img style='border-radius:4px;border:1px solid #bbb;width:100%;background:#fff;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;' ";
									if(file_exists("img/products/resized/$rs[0].jpg")){			
										echo" src='img/products/resized/$rs[0].jpg? ".date("h:i:s")." ' />";
									}else{
										echo" src='img/products.png' style='opacity:.5' />";
									}

								echo"
							</div>
							<div class='text-center' style='margin-top:10px'>
								<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
								<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
								<input class='btn text-primary' style='border-radius:4px;background:#fff;border:1px solid #bbb;width:100%;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px' value='Change Photo' onclick=\"$('#b_file_$rs[0]').click();\"/>
							</div>
						</div>
						<div class='col-lg-6 form-group mt-3'>
							<div style='background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;width:100%;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'>
							<input type='hidden' name='product_id' value='$rs[0]' />
							<div class='form-floating'>
								<select style='background:#fff' type='text' class='form-control' name='product_category' required >
									<option value='".$rs["product_category"]."'>".$rs["product_category"]."</option>
										".fill_categories($pdo)."
								</select>
								<label for='product_category'>Product categories</label>
							</div>
							<div class='form-floating'>
								<input type='text' class='form-control' name='product_name' value='".$rs["product_name"]."' placeholder='Product Name' required >
								<label for='product_name'>Product Name</label>
							</div>
							<div class='form-floating'>
								<textarea type='text' rows='2' class='form-control' name='description' placeholder='Product Description' required >".$rs["description"]."</textarea>
								<label for='description'>Product Description</label>
							</div>
							<div class='form-floating'>
								<input type='number' class='form-control' name='product_stock' value='".$rs["product_stock"]."' placeholder='Product Stock' required >
								<label for='product_stock'>Product Stock</label>
							</div>
							<div class='form-floating'>
								<select style='background:#fff' type='text' class='form-control' name='product_unit' required >
									<option value='".$rs["product_unit"]."'>".$rs["product_unit"]."</option>
										".fill_unit($pdo)."
								</select>
								<label for='product_unit'>Product Unit</label>
							</div>
							<div class='form-floating'>
								<input type='number' class='form-control' name='product_price' value='".$rs["product_price"]."' placeholder='Product Price' required >
								<label for='product_price'>Product Price</label>
							</div>
							</div>
						</div>					
						<div class='col' style='margin:15px'>
							<button class='btn btn-primary rounded-pill' type='SUBMIT' name='upDate' style='width:100px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;'>SAVE</button>
						</div>
					</div>
				</div>
			</div>
		</form>

				";
			}		
		}			
	?>		
	
</div>
</div>

<?php require("admin_footer.php");?>