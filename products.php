<?php
	require("header.php");
	require("topbar.php");
	require("navbar.php");	
?>

<?php

	error_reporting(0);

	$value=$_GET['value'];
				
	$catg="";
		if($_GET["categories"]!="Categories" && $_GET["categories"]!="")
			$catg=" and product_category='".$_GET["categories"]."'";
					
	$prod="";
		if($_GET["products"]!="Products" && $_GET["products"]!="")
			$prod=" and product_name='".$_GET["products"]."'";

	if(isset($_POST["b_search"])){
		$value=$_POST["t_search"];
	}

	$rec=20;
	$p=$_GET['page'];
	if($p>1){
		$to=$rec;
		$from=($p*$rec)-$rec;
		$i=(($p-1)*$rec)+1;
	}else{
		$to=$rec;
		$from=0;
		$i=1;
		$p=1;
	}
		
	$ex=$link->query("select * from products p where 
	   (p.product_id like'%".$value."%' or
		p.product_name like'%".$value."%' or
		p.product_category like'%".$value."%' or	
		p.description like'%".$value."%') $catg $prod order by product_id LIMIT $from,$to ")or die(mysqli_error($link));		

	$ex1=$link->query("select * from products p where 
	   (p.product_id like'%".$value."%' or
		p.product_name like'%".$value."%' or
		p.product_category like'%".$value."%' or	
		p.description like'%".$value."%') $catg $prod order by product_id ")or die(mysqli_error($link));		

	$sbtn="<button style='margin-top:5px' type='submit' class='btn btn-primary' name='b_search'><i class='fa fa-search'></i></button>";
	$lbtn="<button style='margin-top:5px' class='btn btn-primary'><i class='fa fa-list'></i></button>";
?>

<script> setActive("products"); </script>

<form action='#' method='POST' enctype='multipart/form-data'>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
				<h1 class="display-3 text-white mb-3 animated slideInDown">
					<span onClick="history.back()" class="btn btn-primary rounded-pill"><i class="fa fa-arrow-left" title="Back"></i></span>
						Products
					<span onClick="jump('products.php')" class="btn btn-primary rounded-pill"><i class="fa fa-sync" title="Refresh"></i></span>
				</h1>
				<input style='text-align:left;margin-top:5px;width:232px' type='text' class='btn btn-light text-capitalize' placeholder='Type a keyword' name='t_search' id='t_search' value='<?php if($_POST["t_search"]!=""){echo $_POST["t_search"];} ?>'><?php echo $sbtn;?>			
				<select style='text-align:left;padding:8px;margin-top:5px;width:232px' class="btn btn-light" onchange="if(this.value=='Categories')jump('products.php'); else jump('products.php?categories='+this.value+'&products=<?php echo $_GET["products"];?>')">
					<option>Categories</option>
					<?php
						$ex2=$link->query("select product_category from products where product_category='".$_GET["categories"]."' group by product_category order by product_category")or die(mysqli_error($link));		
						if($_GET["products"]=="" || $_GET["products"]=="Products")							
						$ex2=$link->query("select product_category from products group by product_category order by product_category")or die(mysqli_error($link));																	
						while($rs=mysqli_fetch_array($ex2)){
							echo "<option ";
						if($_GET["categories"]===$rs[0])
							echo "selected";
							echo">$rs[0]</option>";
						}
					?>
				</select><?php echo $lbtn;?>
				<select style='text-align:left;padding:8px;margin-top:5px;width:232px' class="btn btn-light" onchange="jump('?categories=<?php echo $_GET["categories"];?>&products='+this.value)">
					<option>Products</option>
					<?php
						$ex2=$link->query("select product_name from products where product_category='".$_GET["categories"]."' and product_name='".$_GET["products"]."' group by product_name order by product_name")or die(mysqli_error($link));

						if($_GET["categorie"]=="" || $_GET["categorie"]=="Categorie")

						$ex2=$link->query("select product_name from products group by product_name order by product_name")or die(mysqli_error($link));										
						
						while($rs=mysqli_fetch_array($ex2)){
							echo "<option ";
						if($_GET["products"]===$rs[0])
							echo "selected";
							echo">$rs[0]</option>";
						}
					?>
				</select><?php echo $lbtn;?>
			</div>
        </div>
    </div>
<!-- Page Header End -->

<!-- Product List -->
    <div class="container-xxl py-5" style="min-height:220px">
        <div class="container">
            <div class='row g-4' style='margin-top:-70px' >

			<?php

				$val=strtoupper($_POST["t_search"]);

				$rep="<b style='color:#0014d0;background:#ffa0a0'>$val</b>";
					
				if ($ex->num_rows > 0) {				
					
				while($rs=mysqli_fetch_array($ex)){
										
				echo"
					<div class='col-lg-3 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>
						<div class='team-item'>
							<div class='bg-light position-relative overflow-hidden'>
								<img class='img-fluid' width='100%' ";
								
									if(file_exists("img/products/resized/$rs[0].jpg")){			
										echo" src='img/products/resized/$rs[0].jpg? ".date("h:i:s")."' />";
									}else{
										echo" src='img/products.png' style='opacity:0.5'/>";
									}
								
								echo"
								
								<div class='team-overlay position-absolute start-0 top-0 w-100 h-100' >								
									<a href='products_details.php?products=$rs[0]'><input class='btn btn-light' value='Product Details'></a>
								</div>
							</div>
							<div class='bg-light text-center p-4 overflow-hidden'>
								<h5 class='fw-bold mb-0'>".str_replace($val,$rep,$rs["product_name"])."</h5>
								<small>
									<div>".str_replace($val,$rep,$rs["product_category"])." Parts</div>
									<div style='font-size:11px'>".$rs["description"]."</div>
									<div>In Stock: ".$rs["product_stock"]." ".$rs["product_unit"]."</div>
								</small>
							</div>
						</div>
					</div>
					
					";
				}
				} else {
				//No Records Found Error
				echo"
				<div style='text-align:center;color:red;font-size:25px'><br>
					<div>Searching <b>...</b> $value</div>
					<div><img src='img/no_records.jpg' style='border-radius:10px;width:400px'></div>
					<div>No records found!</div>
				</div>";
				}				
			?>
            </div>
        </div>
    </div>
</form>

<?php require("footer.php");?>