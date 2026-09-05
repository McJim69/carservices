<?php
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");

    function fill_products($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT * FROM products ORDER BY product_id");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row['product_id'].'">'.$row['product_id'].'.'.$row["product_name"].' : '.$row["description"].'</option>';
		}	return $output;
	}

	$trans="";
	if($_GET["transactions"]!="")
	$trans=" serv_id='".$_GET["transactions"]."' ";

	$trid = $_GET["transactions"];
	
	$cont = $trid;
	$tids = sprintf("%04d", $cont);

	$qrys = $pdo->prepare("SELECT * FROM transactions WHERE $trans");
	$qrys->execute();
	$ress = $qrys->fetchAll();

	foreach($ress as $rows){
		$client = $rows['serv_client'];
		$unitmk = $rows['unit_make'];
		$umodel = $rows['unit_model'];
		$svdate = $rows['serv_date'];
		$svdesc = $rows['serv_desc'];
	}	

	$cont = $rows[0];
	$tids = sprintf("%04d", $cont);

    if(isset($_POST['transSave'])){

		$prod_idno = $_POST['productidno'];   // Product ID Number
		$prod_name = $_POST['productname'];   // Product Name
		$prod_stck = $_POST['productstock'];  // Product Number of Stock
		$prod_qnty = $_POST['productqnty'];   // Product Post Quantity
		$prod_unit = $_POST['productunit'];   // Product Units Scale
		$prod_cost = $_POST['productprice'];  // Product Selling Price
		$serv_date = $svdate;  				  // Service Date (Transaction)

	if($trid!=null){
				
		for($i=0; $i<count($prod_idno); $i++){

		$rem_qty = $prod_stck[$i] - $prod_qnty[$i];

		if($rem_qty<0){

		echo'
			<script type="text/javascript">
				jQuery(function validation(){
					swal("Warning", "Input Data", "warning", {
						button: "Continue",
					});
				});
			</script>';
		}else{
			$update = $pdo->prepare("UPDATE products SET product_stock = '$rem_qty'   WHERE product_id='".$prod_idno[$i]."'");
			$update->execute();
		}

		$insert = $pdo->prepare("INSERT INTO trans_details (
			serv_id, 
			product_id, 
			product_name,
			product_stock,
			product_qnty, 
			product_unit, 
			product_price,
			serv_date
			
			) VALUES (
			
			:tranid, 
			:prodid, 
			:pdname, 
			:pstock, 
			:pdqnty, 
			:pdunit,
			:pprice,
			:svdate
			
			)");

			$insert->bindParam(':tranid', $trid);
			$insert->bindParam(':prodid', $prod_idno[$i]);
			$insert->bindParam(':pdname', $prod_name[$i]);
			$insert->bindParam(':pstock', $prod_stck[$i]);
			$insert->bindParam(':pdqnty', $prod_qnty[$i]);					
			$insert->bindParam(':pdunit', $prod_unit[$i]);
			$insert->bindParam(':pprice', $prod_cost[$i]);
			$insert->bindParam(':svdate', $serv_date);

			$insert->execute();
			
			}

			if($insert==TRUE){

				echo"<script>location.href='admin_transactions_details.php?transactions=$trid';</script>";
				
			}else{
				echo $error->getmessage();
			}
		}
	}
?>

<script>setActive("transactions");</script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Add Service Parts</h1>
				<div>
					<span style="cursor:pointer" onClick="jump('admin_transactions_details.php?transactions=<?php echo $trid;?>')" class="btn btn-primary">
						<i title="Back" class="fa fa-eye text-light"></i> View Details
					</span>
				</div>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<form action="#" method="POST" enctype="multipart/form-data">

<main class="main">
    <section style="margin-bottom:20px">
		<div class="container"><h2 class="text-secondary">ADD PARTS TO JOB ORDER # <?php echo $tids;?></h2>	
			<button type="button" name="addTrans" class="btn btn-success btn-sm btn_addTrans" required>Add</button> &nbsp;
			
			Owner: <?php echo $client;?> &nbsp;
			Unit: <?php echo $unitmk;?>-<?php echo $umodel;?> &nbsp;
			Service Date: <?php echo $indate;?> &nbsp;
			Job Description: <?php echo $svdesc;?> &nbsp;
		
			<div class="container">	
				<div class="row" style="overflow-x:auto;margin-top:10px;background:#eee;border:1px solid #bbb;border-radius:5px">
					<table class="table table-responsive" id="myTrans">
						<thead style="background:#bbb">
							<tr>
								<th></th>
								<th>Product</th>
								<th>Stock</th>
								<th>Qnty</th>
								<th>Unit</th>
								<th>Price</th>
								<th>
									<button type="button" name="addTrans" class="btn btn-success btn-sm btn_addTrans" required>
										<span><i class="fa fa-plus"></i></span>
									</button>
								</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>	
		</div>
		<div class="box-footer text-center" style="margin:5px 10px 20px 10px">	
			<input style="margin:10px;width:100px;border-radius:5px" type="submit" onclick="jump('admin_transactions_add.php')" value="Reset" class="btn btn-primary">
			<a href="javascript:history.back()" style="width:100px;border-radius:5px" class="btn btn-secondary">Cancel</a>
			<input style="margin:10px;width:100px;border-radius:5px" type="submit" name="transSave" value="Submit" class="btn btn-success">
		</div>			
    </section>
</main>

</form>

<script>
    $(document).ready(function(){
		$(document).on('click','.btn_addTrans', function(){
			var html='';
			html+='<tr class="addtr">';
			html+='<td><input  class="addtd productname"  name="productname[]"  type="hidden" readonly></td>';
			html+='<td><select class="selek productidno"  name="productidno[]"  required><option value="">Select Item</option><?php echo fill_products($pdo);?></select></td>';
			html+='<td><input  class="addtd productstock" name="productstock[]" type="text"   size="5" readonly></td>';
			html+='<td><input  class="addtd productqnty"  name="productqnty[]"  type="number" min="1"  max="50" required></td>';
			html+='<td><input  class="addtd productunit"  name="productunit[]"  type="text"   size="5" readonly></td>';
			html+='<td><input  class="addtd productprice" name="productprice[]" type="text"   size="5" readonly></td>';
			html+='<td><button class="btn btn-danger btn-sm btn-remove" type="button" name="remove"><i class="fa fa-times"></i></button></td>';

        $('#myTrans').append(html);

			$('.productidno').on('change', function(e){
				var productidno = this.value;
				var tr=$(this).parent().parent();
				$.ajax({
					url:"getproducts.php",
					method:"get",
					data:{id:productidno},
					success:function(data){
						tr.find(".productname").val(data["product_name"]);
						tr.find(".productstock").val(data["product_stock"]);
						tr.find(".productqnty").val(0);
						tr.find(".productunit").val(data["product_unit"]);
						tr.find(".productprice").val(data["product_price"]);

						// calculate(0,0);
					}	
				})
			})
		})

		$(document).on('click','.btn-remove', function(){
			$(this).closest('tr').remove();
			calculate(0,0);
		})

		$("#myTrans").delegate(".productqnty","keyup change", function(){
		var productqnty = $(this);
		var tr=$(this).parent().parent();
			if((productqnty.val()-0)>(tr.find(".productstock").val()-0)){
				swal("Warning","Not Enough Stock","warning");
				productqnty.val(1);
			}
		})
	});
</script>

<?php require("admin_footer.php");?>