<?php 
	require("header.php");

	if(!isset($_SESSION['user'])){
		require("topbar.php");
	}else{
		require("admin_topbar.php");
	}		

	if(!isset($_SESSION['user'])){
		require("navbar.php");
	}else{
		require("admin_navbar.php");
	}		

	$prod="";
	if($_GET["products"]!="")
		$prod=" and product_id='".$_GET["products"]."' ";
												
	$ex = $link->query("select * from products where product_id=product_id $prod order by product_id limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from products t where t.product_id='$rs[0]' and t.product_id=t.product_id ");

	while($rs = mysqli_fetch_array($ex)){	
	
?>

<script> setActive("products"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Product Details</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Product Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<style>
.content {
  height: 340px;
  position: relative;
}

.center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

.cont-box {
	border-radius:4px;
	border:1px solid #bbb;
	box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
}

.cont-det {
	font-size:18px;
	min-width:380px;
	text-align:center;
}

</style>

<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
	<div class="container text-center" style="margin-top:-50px">
		<div class="row justify-content-center">
			<div class="col-lg-8 cont-box" style="background:#eee">
				<div class="row">
					<div class="col-lg-6 form-group mt-3">
						<div class="cont-box" style="background:#fff">
							<div class="content">
								<div class="center">
								<?php
									echo"<img style='height:300px' ";
									if(file_exists("img/products/resized/$rs[0].jpg")){			
										echo" src='img/products/resized/$rs[0].jpg? ".date("h:i:s")."' >";
									}else{
										echo" src='img/products.png' style='opacity:0.5' >";
									}
								?>
								</div>
							</div>		
						</div>
					</div>
					<div class="col-lg-6 form-group mt-3">
						<div class="cont-box" style="background:#fff">
							<div class="content">
								<div class="center">
									<div class="text-secondary cont-det">Category: <h5><?php echo $rs["product_category"];?></h5></div>
									<div class="text-secondary cont-det">Product: <h5><?php echo $rs["product_name"];?></h5></div>
									<div class="text-secondary cont-det">Description: <h5><?php echo $rs["description"];?></h5></div>
									<div class="text-secondary cont-det">In Stock: <h5><?php echo $rs["product_stock"];?>-<?php echo $rs["product_unit"];?></h5></div>
									<div class="text-secondary cont-det">Price:
									<?php 
										if ($rs["product_price"]!=="0"){
											echo"<h2 class='text-primary'>&#8369;".number_format($rs["product_price"]).".00</h2>";
										}else{
											echo"<h4><a href='contact.php'>Call for Pricing</a></h4>";
										}
									?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div style="margin:20px">
					<a class="cont-box btn btn-primary rounded-pill py-3 px-5" onclick="javascript:history.back()">Back to List</a>
				</div>
			</div>
		</div>
	</div>
</div>	

<?php } } require("footer.php");?>