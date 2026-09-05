<?php 
	require("header.php");
	require("navbar.php");

	if(isset($_POST['upDate'])){	
		$serv_id     = $_POST['serv_id'];
		$serv_date   = $_POST['serv_date'];
		$serv_categ  = $_POST['serv_categ'];
		$serv_client = $_POST['serv_client'];
		$unit_make   = $_POST['unit_make'];
		$unit_model  = $_POST['unit_model'];
		$serv_desc   = $_POST['serv_desc'];
		$technician  = $_POST['technician'];
		$labor_cost  = $_POST['labor_cost'];
		$payment     = $_POST['payment'];
		$remarks     = $_POST['remarks'];

	$update = $link->query("UPDATE transactions set
		serv_id  	 = '$serv_id',
		serv_date 	 = '$serv_date',
		serv_categ   = '$serv_categ',
		serv_client  = '$serv_client',
		unit_make 	 = '$unit_make',
		unit_model 	 = '$unit_model',
		serv_desc 	 = '$serv_desc', 
		technician   = '$technician',
		labor_cost   = '$labor_cost',
		payment      = '$payment',
		remarks      = '$remarks' where serv_id = '$serv_id'");

		$errors = mysqli_error($link);

		$link->query("UPDATE trans_details SET payment = '$payment' WHERE serv_id='$serv_id'");
		$link->query("UPDATE trans_details SET serv_date = '$serv_date' WHERE serv_id='$serv_id'");

		if(($update)== TRUE){
			echo'
			<script type="text/javascript">
				swal({
				  title: "Success!",
				  text: "Transaction No.'.$serv_id.' updated successfully!",
				  type: "success"
				}).then(function() {
					window.location.href = "transactions_details.php?transactions='.$serv_id.'";
				})
			</script>';
			
		}else{
			echo'
			<script type="text/javascript">
				jQuery(function validation(){
					swal("ERROR!", "'.$errors.'", "warning", {
						button: "Close",
					});
				});
			</script>';
		}
	}
	
    function fill_categories($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT service_name FROM services order by service_idno");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row[0].'">'.$row[0].'</option>';
		}	return $output;
	}

    function fill_client($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT fullname FROM customers order by cid");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row[0].'">'.$row[0].'</option>';
		}	return $output;
	}

    function fill_brand($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT name FROM manufacturer order by mfid");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row[0].'">'.$row[0].'</option>';
		}	return $output;
	}

    function fill_tech($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT fullname FROM technicians order by tech_id");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$output.='<option value="'.$row[0].'">'.$row[0].'</option>';
		}	return $output;
	}
?>

<div class="content-wrapper">
	<form action='#' method='POST' enctype='multipart/form-data'>
		<h2 class="card-title">Transaction Edit  &nbsp;
			<a href="transactions.php" class='btn btn-sm btn-outline-info' title='Back'> 
				<b><</b> Back
			</a>
		</h2>
		
		<div class="row">
		
		<?php
			$tran="";
			if($_GET["transactions"]!="")
				$tran=" and serv_id='".$_GET["transactions"]."' ";
														
			$ex = $link->query("select * from transactions where serv_id=serv_id $tran order by serv_id limit 1");

			while($rs = mysqli_fetch_array($ex)){	

				$ex = $link->query("select * from transactions t where t.serv_id='$rs[0]' and t.serv_id=t.serv_id ");

				while($rs = mysqli_fetch_array($ex)){	

				$cont = $rs[0];
				$tids = sprintf("%04d", $cont);

				if(isset($_POST["b_upImg_$rs[0]"])){
					move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "../img/transactions/$rs[0].jpg");

					$link->query("update transactions set serv_photo=1 where serv_id='$rs[0]'");
					jump("");

					$origFile="../img/transactions/$rs[0].jpg";
					$destFile="../img/transactions/resized/$rs[0].jpg";
					
					$source = imagecreatefromjpeg($origFile);
					list($width, $height) = getimagesize($origFile);

					$newWidth = 384;
					$newHeight = 512;

					$thumb = imagecreatetruecolor($newWidth, $newHeight);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
					imagejpeg($thumb, $destFile, 80);
				}		
				
				echo"
					<div class='col-lg-3 grid-margin stretch-card'>
						<div class='card'>
							<div class='card-body text-center'>
							<img style='border-radius:4px;height:418px;width:100%' ";
								if(file_exists("../img/transactions/resized/$rs[0].jpg")){			
									echo" src='../img/transactions/resized/$rs[0].jpg? ".date("h:i:s")." ' />";
								}else{
									echo" src='../img/aircon-parts.jpg' style='opacity:.5' />";
								}

								echo"
								<div style='margin-top:20px'>
									<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
									<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
									<input style='padding:10px' type='button' class='btn btn-primary btn-block' value='Change Photo' onclick=\"$('#b_file_$rs[0]').click();\"/>
								</div>
							</div>
						</div>
					</div>					
					
					<div class='col-lg-6 grid-margin stretch-card'>
						<div class='card'>
							<div class='card-body'>
								<h3 class='card-title'>Transaction No. $tids</h4>
								<div class='row'>
									<div class='col-lg-6' style='color:#bbb'>
										<div class='form-group'>
											<input type='hidden' name='serv_id' value='$rs[0]' />
											<label for='serv_date'>Date</label>
											<input type='date' onfocus=\"(this. type='date')\" class='text-warning form-control bg-dark' name='serv_date' value='".$rs["serv_date"]."' required >
										</div>
										<div class='form-group'>
											<label for='serv_categ'>categories</label>
											<select type='text' class='text-warning form-control bg-dark' name='serv_categ' required >
												<option value='".$rs["serv_categ"]."'>".$rs["serv_categ"]."</option>
													".fill_categories($pdo)."
											</select>
										</div>
										<div class='form-group'>
											<label for='serv_client'>Customer</label>
											<select type='text' class='text-warning form-control bg-dark' name='serv_client' required >
												<option value='".$rs["serv_client"]."'>".$rs["serv_client"]."</option>
													".fill_client($pdo)."
											</select>
										</div>
										<div class='form-group'>
											<label for='unit_make'>Unit</label>
											<select type='text' class='text-warning form-control bg-dark' name='unit_make' required >
												<option value='".$rs["unit_make"]."'>".$rs["unit_make"]."</option>
													".fill_brand($pdo)."
											</select>
										</div>
										<div class='form-group'>
											<label for='unit_model'>Model</label>
											<input type='text' class='text-warning form-control bg-dark' name='unit_model' value='".$rs["unit_model"]."' placeholder='Unit Model' required >
										</div>
									</div>
									<div class='col-lg-6' style='color:#bbb'>
										<div class='form-group'>
											<label for='serv_desc'>Description</label>
											<input type='text' rows='2' class='text-warning form-control bg-dark' name='serv_desc' value='".$rs["serv_desc"]."' placeholder='Service Description' required >
										</div>
										<div class='form-group'>
											<label for='technician'>Technician</label>
											<select type='text' class='text-warning form-control bg-dark' name='technician' required >
												<option value='".$rs["technician"]."'>".$rs["technician"]."</option>
												".fill_tech($pdo)."
											</select>
										</div>
										<div class='form-group'>
											<label for='labor_cost'>Labor Cost</label>
											<input type='number=' class='text-warning form-control bg-dark' name='labor_cost' value='".$rs["labor_cost"]."' required >
										</div>
										<div class='form-group'>
											<label class='payment'>Status</label>
											<select type='text' class='text-warning form-control bg-dark' name='payment' required >
												<option value='".$rs["payment"]."'>".$rs["payment"]."</option>
												<option value='Paid'>Paid</option>
												<option value='Pending'>Pending</option>
												<option value='Collectable'>Collectable</option>
											</select>
										</div>
										<div class='form-group'>
											<label for='remarks'>Remarks</label>
											<input type='text' class='text-warning form-control bg-dark' name='remarks' value='".$rs["remarks"]."' placeholder='Remarks'>
										</div>
									</div>
								</div>
									<div>
										<button style='padding:10px' class='btn btn-primary btn-block' type='SUBMIT' name='upDate'>Save and Update</button>
									</div>
							</div>
						</div>
					</div>
		
					";
				}		
			}			
		?>	

<?php
	if(isset($_POST['status'])){ 
		$statN = $_POST['status'];
	}else{
		$statN = "Select";
	}
?>
<style> .cust{ margin: -10px 0 -10px 0; } </style>
	<div class="col-lg-3 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex flex-row justify-content-between">
					<h4 class="card-title mb-1">Transaction Status</h4>
					<form action="#" method="post" enctype="multipart/form-data">
					<div class="text-muted mb-1" >
						<select style="text-align:left" type="button" class="btn btn-sm btn-outline-success" name="status" type="submit" onchange="this.form.submit()">
							<option value=""><?php echo $statN;?></option>
							<option value="Paid">Paid</option>
							<option value="Pending">Pending</option>
							<option value="Collectable">Collectable</option>
						</select>
					</form>
					</div>
				</div>
				<div class="table-responsive" style="margin-top:10px;height:430px">
					<table class="table table-dark table-hover">
						<thead class="bg-dark">
							<th>#</th>
							<th>CLIENT</th>
							<th>STATUS</th>
						</thead>	
						<tbody>											
						<?php 
							
							$i=1;
							
							$cls = "style='height:35px;padding:5px'";
							
							if(isset($_POST['status'])){ 
								$ex=$link->query("SELECT * FROM transactions WHERE payment = '$statN' ORDER BY serv_date DESC");
								while($rs=mysqli_fetch_array($ex)){
								echo"<tr id='tr_".$rs[0]."' onclick=\"jump('transactions_details.php?transactions=$rs[0]')\">";
								echo"<td $cls class='text-center'>$i.</td>";
								echo"<td $cls>".$rs["serv_client"]."</td>";
								echo"<td $cls>";
									if($rs["payment"]=="Paid"){
										echo"<x class='btn-outline-success cust btn btn-sm text-center' style='width:90px'>Paid</x>";
									}
									if($rs["payment"]=="Pending"){
										echo"<x class='btn-outline-warning cust btn btn-sm text-center' style='width:90px'>Pending</x>";
									}
									if($rs["payment"]=="Collectable"){
										echo"<x class='btn-outline-danger  cust btn btn-sm text-center' style='width:90px'>Collectable</x>";
									}
								echo"</td>";
								echo"</tr>";		
								$i++;
								}
							}else{
								$ex=$link->query("SELECT * FROM transactions ORDER BY serv_date DESC");
								while($rs=mysqli_fetch_array($ex)){

								echo"<tr id='tr_".$rs[0]."' onclick=\"jump('transactions_details.php?transactions=$rs[0]')\">";
								echo"<td $cls class='text-center'>$i.</td>";
								echo"<td $cls>".$rs["serv_client"]."</td>";
								echo"<td $cls>";
									if($rs["payment"]=="Paid"){
										echo"<x class='btn-outline-success cust btn btn-sm text-center' title='Paid'>PD</x>";
									}
									if($rs["payment"]=="Pending"){
										echo"<x class='btn-outline-info cust btn btn-sm text-center' title='Pending'>PN</x>";
									}
									if($rs["payment"]=="Collectable"){
										echo"<x class='btn-outline-danger cust btn btn-sm text-center' title='Collectable'>CL</x>";
									}
								echo"</td>";
								echo"</tr>";		
								$i++;
								}
							}							
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>	

		</div>	
	</form>
</div>

<?php require("footer.php");?>
