<?php
	require("header.php");
	require("navbar.php");	
?>

<?php

	$rec=1;

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
						
	$tran="";
	if($_GET["transactions"]!="")
		$tran=" and serv_id='".$_GET["transactions"]."' ";
												
	$ex = $link->query("select * from transactions where serv_id=serv_id $tran order by serv_id limit $from,$to ");
	  
	while($rs = mysqli_fetch_array($ex)){	
	$ex = $link->query("select * from transactions t where t.serv_id='$rs[0]' and t.serv_id=t.serv_id ");
	
	while($rs = mysqli_fetch_array($ex)){	
	
	$cont = $rs[0];
	$tids = sprintf("%04d", $cont);
	$date = date("F d, Y", strtotime($rs["serv_date"]));
	$cate = $rs["serv_categ"];
	$unit = $rs["unit_make"];
	$mode = $rs["unit_model"];
	$desc = $rs["serv_desc"];
	$tech = $rs["technician"];
	$cost = $rs["labor_cost"];
	$pays = $rs["payment"];
	$rems = $rs["remarks"];

	if(isset($_POST["b_upImg_$cont"])){
		move_uploaded_file($_FILES["b_file_$cont"]["tmp_name"], "../img/transactions/$cont.jpg");

		$link->query("update transactions set serv_photo=1 where serv_id='$cont'");
		jump("");

		$origFile="../img/transactions/$cont.jpg";
		$destFile="../img/transactions/resized/$cont.jpg";
							
		$source = imagecreatefromjpeg($origFile);
		list($width, $height) = getimagesize($origFile);

		$newWidth = 384;
		$newHeight = 512;

		$thumb = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		imagejpeg($thumb, $destFile, 80);
	}	

	$tsc = $link->query("SELECT * FROM customers WHERE cid='".$rs["cust_id"]."' ");
	while($tcn=mysqli_fetch_array($tsc)){
		$fname = $tcn["fullname"];
		$postn = $tcn["position"];
		$addrs = $tcn["address"];
		$phone = $tcn["phone"];
	}

	$spc = $link->query("SELECT * FROM customers WHERE fullname='".$rs["cust_id"]."' ");
	
	$divID="div_$cont";
		} 
	} 
?>

<!-- Transaction Details Start -->
<div id="myself" class="content-wrapper">
	<h3 class="card-title hid">Transaction <small><i class='fa fa-arrow-right'></i></small> Details &nbsp;
		<a href='transactions.php' title='Back' class='btn btn-sm btn-outline-info'> 
			<i class='mdi mdi-arrow-left'></i>Back
		</a>
	</h3>
	<div class="row" id="<?php echo $divID;?>">
		<div class="col-lg-3 grid-margin stretch-card">
			<div class="card">			
				<div class="card-body">
				<h4 class="card-title">JOB ORDER NO: <?php echo $tids;?></h4>
					<form action='#' method='POST' enctype='multipart/form-data' >
					<?php
						echo"
						<div class='text-center' id='photo'>
							<img class='img-fluid bg-secondary' style='border-radius:5px' ";
							if(file_exists("../img/transactions/resized/$cont.jpg")){		
								echo" src='../img/transactions/resized/$cont.jpg?".date("h:i:s")."' />";
							}else{
								echo" src='../img/aircon-parts.png' />";
							}
							echo"
							<div class='hid' style='margin-top:15px;margin-bottom:-5px'>
								<input type=file name='b_file_$cont' id='b_file_$cont' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$cont').click();\"/> 
								<input type=submit name='b_upImg_$cont' id='b_upImg_$cont' value='Upload' style='display:none'/> 
								<input onclick=\"$('#b_file_$cont').click();\" type='button' value='Change Photo' class='btn btn-inverse-primary rounded-pill btn-block' style='padding:8px'/>
							</div>
						</div>";
					?>
					</form>
				</div>
			</div>
		</div>
	
		<div class="col-lg-4 grid-margin stretch-card">
			<div class="card">			
				<div class="card-body">
					<h4 class="card-title">DETAILS</h4>
					<div class="table-responsive" style='border:1px solid gray;border-radius:5px'>
						<table class="table">
							<tbody class="bg-dark">
								<tr>
									<td>Date</td>
									<td width="1%">:</td>
									<td><?php echo $date;?></td>
								</tr>
								<tr>
									<td>Category</td>
									<td width="1%">:</td>
									<td><?php echo $cate;?></td>
								</tr>
								<tr>
									<td>Customer</td>
									<td width="1%">:</td>
									<td><?php echo $fname;?></td>
								</tr>	
								<tr>	
									<td>Position</td> 
									<td width="1%">:</td>
									<td><?php echo $postn;?></td> 
								</tr>
								<tr>
									<td>Address</td> 
									<td width="1%">:</td>
									<td><?php echo $addrs;?></td>
								</tr>
								<tr>								
									<td>Phone No</td></td>  
									<td width="1%">:</td>
									<td><?php echo $phone;?></td> 
								</tr>
								<tr>	
									<td>Unit/Model</td> 
									<td width="1%">:</td>
									<td><?php echo $unit;?> - <?php echo $mode;?></td> 
								</tr>
								<tr>	
									<td>Description</td> 
									<td width="1%">:</td>
									<td><?php echo $desc;?></td> 
								</tr>
								<tr>	
									<td>Technician</td> 
									<td width="1%">:</td>
									<td><?php echo $tech;?></td> 
								</tr>
								<tr>	
									<td>Labor Cost</td> 
									<td width="1%">:</td>
									<td>&#8369; <?php echo number_format($cost,2);?></td> 
								</tr>
								<?php if($rems!=="") 
									echo"
									<tr>
										<td>Remarks</td>
										<td width='1%'>:</td>
										<td>$rems</td>
									</tr>";
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-5 grid-margin stretch-card">
			<div class="card">			
				<div class="card-body">
					<?php

						$exd=$link->query("SELECT * FROM trans_details WHERE serv_id='".$cont."' ");

						if ($exd->num_rows > 0) {
							echo"";
						}else{
							echo"
							<div id='buttons' class='text-center' style='margin-top:20px'>
								 <button onclick=\"jump('transactions_add_parts.php?transactions=$cont')\" class='btn btn-primary'>Add Service Parts</button>
							</div><br>";
						}
						
						if ($exd->num_rows > 0) {

						echo"

						<h4 class='card-title'>REPLACEMENTS &nbsp; 
							<button id='buttons' onclick=\"jump('transactions_add_parts.php?transactions=$cont')\" class='btn btn-sm btn-success'>+ADD</button>
						</h4>	
						<div class='table-responsive' style='border:1px solid #555555'>
							<table class='table table-dark table-hover'>
								<thead class='bg-dark text-uppercase'>
									<tr>
										<th class='text-center'>#</th>
										<th>Parts</th>
										<th>Description</th>
										<th>Amount</th>
										<th class='hid text-center'>Action</th>
									</tr>
								</thead>
								<tbody>";
								
								while($rsd=mysqli_fetch_array($exd)){

								$tds=$link->query("SELECT * FROM products WHERE product_id='".$rsd["product_id"]."' ");
								$tpd=mysqli_fetch_array($tds);	
								
								$sid=$cont;

								$pay=$rs["payment"];
								$dat=$rs["serv_date"];
								$dsc=$tpd["description"];
								$prc=$tpd["product_price"];

								$link->query("UPDATE trans_details SET product_price = '$prc' WHERE product_id='".$tpd[0]."'");
								$link->query("UPDATE trans_details SET serv_date = '$dat' WHERE serv_id='$sid'");
								$link->query("UPDATE trans_details SET payment = '$pay' WHERE serv_id='$sid'");
																
								$cnt = $link->query("SELECT SUM(product_price) AS total FROM trans_details WHERE serv_id='".$cont."' ");
								$res = mysqli_fetch_array($cnt);
								$totMat = $res["total"];
									
								$cls="style='height:35px;padding:5px'";
								
									echo"<tr id='tr_".$rsd[0]."'>
									
										<td $cls class='text-center'>$i.</small></td>
										<td $cls>".$rsd["product_name"]."</td>
										<td $cls>".$dsc."</td>
										<td $cls>&#8369; ".number_format($rsd["product_price"],2)."</td>
										<td $cls class='hid text-center'>
											<a  href='products_edit.php?products=".$rsd["product_id"]."' title='Edit'><i class='fa fa-edit'></i></a> &nbsp;
											<a onclick=\"parts_delete('$rsd[0]');\" title='Delete'><i class='text-danger mdi mdi-close'></i></a>
										</td>
									</tr>";
								  $i++;
								}	
								echo"<!--
								<tfoot>	
									<th $cls></th>
									<th $cls></th>
									<th $cls>TOTAL</th>
									<th $cls>&#8369; ".number_format($totMat,2)."</th>
									<th $cls></th>
								</tfoot>-->
								</tbody>
							</table>
						</div>";		
						}
					?>	
					<h4 class="card-title hid" style="margin-top:20px">SUMMARY</h4>

					<div class="btn btn-dark" style="color:#bbb;width:100%;font-size:30px;padding:10px;margin-bottom:10px">
						Labor &#8369;<b><?php echo number_format($cost,2);?></b>
					</div>
					<div class="btn btn-dark" style="color:#bbb;width:100%;font-size:30px;padding:10px;margin-bottom:10px">
						Materials &#8369;<b><?php echo number_format($totMat,2);?></b>
					</div>
					<div class="btn btn-dark" style="color:#bbb;width:100%;font-size:40px;padding:10px;margin-bottom:10px">
						&#8369;<b><?php echo number_format($totMat+$cost,2);?></b>
					</div>

					<div id="status" class="row" style="font-size:20px;margin:15px 0 15px 0">
						<?php
							$click="onclick=\"jump('transactions_edit.php?transactions=$cont')\"";
							
							if($pays=="Paid"){
								echo"<button class='btn btn-inverse-success btn-block' style='padding:8px' $click> P A I D </button>";
							}
							if($pays=="Pending"){
								echo"<button class='btn btn-inverse-info btn-block' style='padding:8px' $click> P E N D I N G </button>";
							}
							if($pays=="Collectable"){
								echo"<button class='btn btn-inverse-danger btn-block' style='padding:8px' $click> C O L L E C T A B L E </button>";
							}
						?>
					</div>
					
						<div id='subbtn'  class="col-lg-12" style='padding:0'>
							<div class='row'>
							<?php
								echo"						
									<div class='col-lg-3' style='margin-top:10px'>
										<input type=file name='b_file_$cont' id='b_file_$cont' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$cont').click();\"/> 
										<input type=submit name='b_upImg_$cont' id='b_upImg_$cont' value='Upload' style='display:none'/> 
										<input class='btn btn-inverse-success btn-block' value='Change Photo' onclick=\"$('#b_file_$cont').click();\"/>
									</div>
									<div class='col-lg-3' style='margin-top:10px'>
										<input onClick=\"jump('transactions_print.php?transactions=$cont')\" class='btn btn-inverse-primary btn-block' value='Print Preview'>
									</div>
									<div class='col-lg-3' style='margin-top:10px'>
										<input onclick=\"jump('transactions_edit.php?transactions=$cont')\" class='btn btn-inverse-info btn-block' value='Update Details'>
									</div>
									<div class='col-lg-3' style='margin-top:10px'>
										<input onclick=\"trans_delete('$cont');\" class='btn btn-inverse-danger btn-block' value='Delete/Remove'>
									</div>
								
								";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function trans_delete(serv_id){	
		if(confirm("Are you sure you want to Remove this Transaction?")){
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
					$("#div_"+serv_id).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
				}
					$("#div_"+serv_id).animate({
						opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","../admin_transactions_delete.php?serv_id="+serv_id,true);
			xmlhttp.send();
		}
	}

	function parts_delete(dets_idno){	
		if(confirm("Are you sure you want to Remove this Service Parts?")){
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#tr_"+dets_idno).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#tr_"+dets_idno).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","../admin_transactions_details_delete.php?dets_idno="+dets_idno,true);
			xmlhttp.send();
		}
	}
</script>

<?php require("footer.php"); ?>

