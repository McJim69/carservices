<?php
	require("header.php");
	require("navbar.php");

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

	$rec=1000;
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
	
	$link->query("UPDATE products SET product_price = 3300 WHERE product_price=0");
	$link->query("UPDATE products SET product_stock = 0 WHERE product_stock<0");
?>

<div class="content-wrapper">
	<div class='row'>
		<div class='col-lg-12'>
			<form action='#' method='POST' enctype='multipart/form-data'>
				<div class='card'>
					<div class='card-body'>
					<h3 class='card-title'>Product List &nbsp;
						<a href='products_add.php' class='btn btn-sm btn-outline-info' title='Add Products'> 
							<b>+</b> ADD
						</a>
					</h3>
						<div class='row' style="margin-top:-10px">
							<div class='col-lg-3 btn-group'>
								<a href="products.php" title='Refresh' style='margin:5px 0 5px 0' class='btn btn-outline-info'><i class='mdi mdi-refresh'></i></a>
								<input style='text-align:left;margin:5px 0 5px 0;width:72.9%' type="text" class="btn btn-outline-info" placeholder="Type a keyword..." name="t_search" id="t_search" value="<?php if($_POST["t_search"]!=""){echo $_POST["t_search"];} ?>">
								<button style='margin:5px 0 5px 0' type='submit' class='btn btn-outline-info' name='b_search'><i class='mdi mdi-magnify'></i></button>
							</div>
							<div class='col-lg-2 btn-group'>
								<select style='text-align:left;margin:5px 0 5px 0;width:100%' class="btn btn-outline-info" onchange="if(this.value=='Categories')jump('products.php'); else jump('products.php?categories='+this.value+'&products=<?php echo $_GET["products"];?>')">
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
								</select>
							</div>
							<div class='col-lg-2 btn-group'>
								<select style='text-align:left;margin:5px 0 5px 0;width:100%' class="btn btn-outline-info" onchange="jump('?categories=<?php echo $_GET["categories"];?>&products='+this.value)">
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
								</select>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>	
<!-- Page Header End -->

<style> .cust{ margin: -10px 0 -10px 0; } </style>

<!-- Transaction List -->
	<div class='row'>
		<div class='col-lg-12'>
			<div class='card'>
				<div class='card-body'>
					<div class='row'>
						<div class='col'>
							<div class="table-responsive"  style='margin-top:-50px;height:680px'>
								<table class="table table-dark table-hover">
									<thead class="bg-dark">
										<tr>
											<th  class='text-center'>#</th>
											<th  class='text-center'>PIC</th>
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
																					
										if ($ex->num_rows > 0) {				

										while($rs=mysqli_fetch_array($ex)){
										
										$price = $rs["product_price"];
										$stock = $rs["product_stock"];

										$cls="style='height:40px;padding:5px'";

										if($stock<1){
											$prods="<x class='text-warning'>Out of Stock</x>";
										}elseif($stock==1){
											$prods="<x class='text-info'>$stock Remaining</x>";
										}else{
											$prods="<x class='text-success'>$stock Remaining</x>";
										}
										
										echo"
										<tr id='tr_".$rs[0]."'>
											<td class='text-center' $cls>$i</td>
											<td class='text-center' $cls>
												<img style='height:25px;width:25px;border-radius:50%' class='cust' ";
												if(file_exists("../img/products/resized/$rs[0].jpg")){
													echo"src='../img/products/resized/$rs[0].jpg' >";
												}else{
													echo"src='../img/favicon.png' >";
												}
											echo"
											</td>
											<td $cls>$prods</td>
											<td $cls>".$rs["product_unit"]."</td>
											<td $cls>".$rs["product_category"]."</td>
											<td $cls>".$rs["product_name"]."</td>
											<td $cls>".$rs["description"]."</td>
											<td $cls>&#8369; ".number_format($price,2)."</td>
											<td $cls>
												<span class='class='btn btn-block btn-group'>
													<i onclick=\"jump('products_edit.php?products=$rs[0]')\" class='btn-inverse-success cust btn btn-sm mdi mdi-grease-pencil' title='Edit'></i>
													<i onclick=\"deleteProduct('$rs[0]');\" class='btn-inverse-danger cust btn btn-sm mdi mdi-window-close' title='Delete'></i>
												</span>
											</td>
										</tr>";
										$i++;
										}
										} else {
										//No Records Found Error
										$error="
										<div style='text-align:center'><br>
											<div style='text-align:center;font-size:20px'>Searching <b>...</b> $value</div><br><a href='products.php'>
											<div class='btn btn-outline-info' style='text-align:center;font-size:200px'><i class='mdi mdi-magnify'></i></div></a><br>
											<div style='margin-top:-50px;text-align:center;font-size:20px'>No records found!</div><br><br>
										</div>";
										}				
									?>
								</tbody>
							</table>
							<?php echo $error;?>
							</div>
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

<?php require("footer.php");?>
