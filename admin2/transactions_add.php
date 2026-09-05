<?php
	require("header.php");
	require("navbar.php");
	
    function fill_products($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT * FROM products ORDER BY product_id");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row['product_id'].'">'.$row['product_id'].'.'.$row["product_name"].': '.$row["description"].'</option>';
		}	return $output;
	}

    function fill_services($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT * FROM categories ORDER BY cat_id");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row['description'].'">'.$row["description"].'</option>';
		}	return $output;
	}

    function fill_brands($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT * FROM manufacturer ORDER BY mfid");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row['name'].'">'.$row["name"].'</option>';
		}	return $output;
	}
    
    function fill_clients($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT * FROM customers ORDER BY cid");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row['fullname'].'">'.$row["fullname"].'</option>';
		}	return $output;
	}

    function fill_techs($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT * FROM technicians ORDER BY tech_id");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row['fullname'].'">'.$row["fullname"].'</option>';
		}	return $output;
	}
	
	$userID = $_SESSION["usid"];
	$userfn = $_SESSION["fnam"];
	$userln = $_SESSION["lnam"];

	$querys = $link->query("SELECT MAX(serv_id) FROM transactions");
	$result = $querys->fetch_array();
	$tranID = $result[0]+1;

    if(isset($_POST['transSave'])){
		
		$cusqr = $link->query("SELECT * FROM customers WHERE fullname = '".$_POST['serv_client']."' ");
		$cusrs = $cusqr->fetch_array();
		$cusid = $cusrs[0];
		
		$usrid = $userID;
		$tidno = $tranID;
		$tdate = $_POST['serv_date'];        // Date of Job Service
		$categ = $_POST['serv_categ'];       // Service/Job categories
		$custm = $_POST['serv_client'];      // Customer/Client
		$cunit = $_POST['unit_make'];        // Unit Brand / Made
		$model = $_POST['unit_model'];       // Unit Model Series
		$jdesc = $_POST['serv_desc'];        // Job Full Description
		$stech = $_POST['technician'];       // Job Full Description
		$lcost = $_POST['labor_cost'];       // Service/Job/Labor Cost
		$stats = $_POST['payment'];          // Payment Options (Cash/Utang)
		$remrk = $_POST['remarks'];          // Service Remarks

		$prod_idno = $_POST['productidno'];   // Product ID Number
		$prod_name = $_POST['productname'];   // Product Name
		$prod_stck = $_POST['productstock'];  // Product Number of Stock
		$prod_qnty = $_POST['productqnty'];   // Product Post Quantity
		$prod_unit = $_POST['productunit'];   // Product Units Scale
		$prod_cost = $_POST['productprice'];  // Product Selling Price

		$insert = $pdo->prepare("INSERT INTO transactions (
			serv_id,
			user_id,
			serv_date,
			serv_categ,
			serv_client,
			cust_id,
			unit_make,
			unit_model,
			serv_desc,
			technician,
			labor_cost,
			payment,
			remarks)
			
			VALUES (
			
			:tidno,
			:usrid,
			:tdate,
			:categ,
			:custm,
			:cusid,
			:cunit,
			:model,
			:jdesc,
			:stech,
			:lcost,
			:stats,
			:remrk)");

			$insert->bindParam(':usrid', $usrid);
			$insert->bindParam(':tidno', $tidno);
			$insert->bindParam(':tdate', $tdate);
			$insert->bindParam(':categ', $categ);
			$insert->bindParam(':custm', $custm);
			$insert->bindParam(':cusid', $cusid);
			$insert->bindParam(':cunit', $cunit);
			$insert->bindParam(':model', $model);
			$insert->bindParam(':jdesc', $jdesc);
			$insert->bindParam(':stech', $stech);
			$insert->bindParam(':lcost', $lcost);
			$insert->bindParam(':stats', $stats);
			$insert->bindParam(':remrk', $remrk);
	
			$insert->execute();

			if($tranID!=null){
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
					serv_date,
					payment) 
					
					VALUES (
					
					:tranid, 
					:prodid, 
					:pdname, 
					:pstock, 
					:pdqnty, 
					:pdunit, 
					:pprice, 
					:svdate,
					:svstat)");

				$insert->bindParam(':tranid', $tranID);
				$insert->bindParam(':prodid', $prod_idno[$i]);
				$insert->bindParam(':pdname', $prod_name[$i]);
				$insert->bindParam(':pstock', $prod_stck[$i]);
				$insert->bindParam(':pdqnty', $prod_qnty[$i]);					
				$insert->bindParam(':pdunit', $prod_unit[$i]);
				$insert->bindParam(':pprice', $prod_cost[$i]);
				$insert->bindParam(':svdate', $tdate);
				$insert->bindParam(':svstat', $stats);

				$insert->execute();

			}
		
			if($insert==TRUE){
				echo"<script>location.href='transactions_details.php?transactions=$tranID';</script>";
			}else{
				echo $error->getmessage();
			}
		}
	}
?>

<!-- Add Transaction Form Start -->
<div class="content-wrapper">
	<form action="#" method="POST" enctype="multipart/form-data">
	<h2>Transaction Add &nbsp; 
		<button onClick="jump('transactions.php')" title='Back' class='btn btn-sm btn-outline-info'>
			<b><</b> BACK
		</button>
	</h2>
		<div class="row">					
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body" style="color:#bbb">
						<div class="row">
							<div class="col-lg-3 form-group">
								<small>&nbsp;<i class="mdi mdi-calendar"></i> Date</small>
								<input onfocus="(this. type='date')" class="text-light bg-dark form-control" name="serv_date" onfocus="(this.type='date')" placeholder="Service Date" required>
							</div>
							<div class="col-lg-3 form-group">
								<small><i class="mdi mdi-apps"></i> Category</small>
								<select class="text-light bg-dark form-control" name="serv_categ" required>
									<option value="">Service Type</option>
									<?php echo fill_services($pdo);?>
								</select>
							</div>
							<div class="col-lg-6 form-group">
								<small>&nbsp;<i class="mdi mdi-arrow-all"></i> Description</small>
								<input class="text-light bg-dark form-control" type="text" name="serv_desc" placeholder="Job Description" required></textarea>
							</div>
							<div class="col-lg-3 form-group">
								<small><i class="mdi mdi-account-box"></i> Customer</small>
								<select class="text-light bg-dark form-control" name="serv_client" required>
									<option value="">Select Client</option>
									<?php echo fill_clients($pdo);?>
								</select>
							</div>
							<div class="col-lg-3 form-group">
								<small>&nbsp;<i class="mdi mdi-car"></i> Unit</small>
								<select class="text-light bg-dark form-control" name="unit_make" required>
									<option value="">Select Brand</option>
									<?php echo fill_brands($pdo);?>
								</select>
							</div>
							<div class="col-lg-3 form-group">
								<small>&nbsp;<i class="mdi mdi-car-side"></i> Model</small>
								<input class="text-light bg-dark form-control" type="text" name="unit_model" placeholder="Unit Model Series" required>
							</div>
							<div class="col-lg-3 form-group">
								<small>&nbsp;<i class="mdi mdi-worker"></i> Technician</small>
								<select class="text-light bg-dark form-control" name="technician" required>
									<option value="">Select Technician</option>
									<?php echo fill_techs($pdo);?>
								</select>
							</div>
							<div class="col-lg-3 form-group">
								<small>&nbsp;<i class="mdi mdi-currency-usd"></i> Labor</small>
								<input class="text-light bg-dark form-control" type="number" name="labor_cost" placeholder="Total Labor Cost" required>
							</div>
							<div class="col-lg-3 form-group">
								<small><i class="mdi mdi-square-inc-cash"></i> Payment</small>
								<select class="text-light bg-dark form-control" type="text" name="payment" required>
									<option value="">Payment</option>
									<option value="Paid">Paid</option>
									<option value="Pending">Pending</option>
									<option value="Pending">Collectable</option>
								</select>
							</div>
							<div class="col-lg-3 form-group">
								<small>&nbsp;<i class="mdi mdi-comment"></i> Remarks</small>
								<input class="text-light bg-dark form-control" name="remarks" placeholder="Service Remarks" >								
							</div>					
							<div class="col-lg-3 form-group">
								<small>&nbsp;<i class="mdi mdi-account"></i> User (Readonly)</small>
								<div class="text-light bg-dark form-control"><?php echo $userfn;?> <?php echo $userln;?></div>
							</div>					
							<div class="col-lg-3 form-group">
								<button type="button" name="addTrans" class="btn btn-outline-success btn_addTrans" required>Add Parts</button>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-hover" id="myTrans">
								<thead>
									<tr class="bg-dark text-uppercase">
										<th>Product</th>
										<th>Stock</th>
										<th>Qnty</th>
										<th>Unit</th>
										<th>Price</th>
										<th>
											<button type="button" name="addTrans" class="btn btn-sm btn-outline-success btn_addTrans" required>
												<span><i class="mdi mdi-plus"></i></span>
											</button>
										</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
							<div class="text-center" style="margin-top:20px">	
								<input style="margin:5px;width:100px" type="submit" onclick="jump('transactions_add.php')" value="Reset" class="btn btn-outline-primary">
								<a href="javascript:history.back()" style="margin:5px;width:100px" class="btn btn-outline-warning">Cancel</a>
								<input style="margin:5px;width:100px" type="submit" name="transSave" value="Submit" class="btn btn-outline-success">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- Add Transaction Form End -->

<style>
	.cust{
		margin: -5px 0 -5px 0;
	}
	.left{
		text-align:left;
	}
</style>

<script>
    $(document).ready(function(){
		$(document).on('click','.btn_addTrans', function(){
			var html='';
			html+='<tr>';
			html+='<input class="productname"  name="productname[]" type="hidden" readonly>';
			html+='<td><select class="left cust btn btn-dark productidno"  name="productidno[]"  required><option value="">Select Item</option><?php echo fill_products($pdo);?></select></td>';
			html+='<td><input  class="cust btn btn-dark productstock" name="productstock[]" type="text"   size="5" readonly></td>';
			html+='<td><input  class="cust btn btn-dark productqnty"  name="productqnty[]"  type="number" min="1"  max="50" required></td>';
			html+='<td><input  class="cust btn btn-dark productunit"  name="productunit[]"  type="text"   size="5" readonly></td>';
			html+='<td><input  class="cust btn btn-dark productprice" name="productprice[]" type="text"   size="5" readonly></td>';

			html+='<td><button class="btn btn-sm btn-outline-danger btn-remove" type="button" name="remove"> &nbsp;<i class="mdi mdi-window-close"></i></button></td>';

        $('#myTrans').append(html);

			$('.productidno').on('change', function(e){
				var productidno = this.value;
				var tr=$(this).parent().parent();
				$.ajax({
					url:"../getproducts.php",
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

<?php require('footer.php');?>
