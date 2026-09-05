<?php
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");	
?>

<script> setActive("transactions"); </script>

<?php
	error_reporting(0);

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

	if(isset($_POST["b_upImg_$rs[0]"])){
		move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "img/transactions/$rs[0].jpg");

		$link->query("update transactions set serv_photo=1 where serv_id='$rs[0]'");
		jump("");

		$origFile="img/transactions/$rs[0].jpg";
		$destFile="img/transactions/resized/$rs[0].jpg";
							
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
	
	$divID="div_$rs[0]";
?>

<!-- Page Header Start -->
    <div id="link-icons" class="hid container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Transaction</h1>
				<div>
					<button style="margin:3px;width:150px" onClick="jump('admin_transactions.php')" class="btn btn-primary">
						<i class="fa fa-arrow-left"></i> Back to List
					</button>
					<button style="margin:3px;width:150px" onClick="printF();" class="btn btn-primary">
						<i class="fa fa-print"></i> Receipt
					</button>
					<button style="margin:3px;width:150px" onClick="jump('admin_transactions_details.php?transactions=<?php echo $rs[0];?>');" class="btn btn-primary">
						<i class="fa fa-sync"></i> Refresh
					</button>
					<button style="margin:3px;width:150px" onClick="jump('admin_transactions_edit.php?transactions=<?php echo $rs[0];?>')" class="btn btn-primary">
						<i class="fa fa-edit"></i> Update
					</button>
				</div>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<!-- Transaction Details Start -->
	<div class="container-xxl py-5" id="<?php echo $divID;?>">
		<div class="hid" style="margin-top:-50px"> </div>
		<div class="container">
			<div class="row" style="padding:10px;border-radius:5px;border:1px solid #bbb;box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px, rgb(51, 51, 51) 0px 0px 0px 3px;">
				<div class='col-lg-3 col-md-6' style='margin:20px 0 20px 0'>
					<form action='#' method='POST' enctype='multipart/form-data'>
					<?php
						echo"<img id='photo' class='img-fluid transactions-image' style='border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;' ";
						if(file_exists("img/transactions/resized/$rs[0].jpg")){		
							echo" src='img/transactions/resized/$rs[0].jpg?".date("h:i:s")."' />";
						}else{
							echo" src='img/aircon-parts.png' />";
						}
						echo"
						<div class='hid' style='margin-top:30px'>
							<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
							<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
							<input onclick=\"$('#b_file_$rs[0]').click();\" type='button' value='Change Photo' class='btn btn-primary rounded-pill' style='width:100%;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'/>
						</div>";
					?>
					</form>
					<div id='logo' class='text-center' style='margin:-20px 0 -20px 0;display:none'>
						<img class='img-fluid transactions-image' src='img/logo_receipt.png?<?php echo date("h:i:s");?>' />
						<div>
						<h4 class='text-uppercase'><?php echo _DESC;?></h4>	
							<small>
								<?php echo _HOMEADD;?><br>
								<?php echo _EMAIL1;?> &bull; www.<?php echo _DOMAIN;?><br>
								<?php echo _PHONE1;?> &bull; <?php echo _PHONE2;?><br>
							</small>
						</div><small>-oOo-</small>
						<h2>OFFICIAL RECEIPT</h2>
						<div class="bg-primary"><h2 class="text-light">JO-<b><?php echo $tids;?></b>-<?php echo $rs["serv_date"];?></h2></div>
					</div>
				</div>
				<div class='col-lg-4 col-md-8' data-wow-delay='0.1s' style='margin-top:10px;margin-bottom:10px;'>
					<h2>Transaction Details <b class="hid text-primary"> <?php echo $tids;?></b></h2>
					<div class="row">
						<div class='col-md-12' style='margin-top:5px'>
							<h6> SERVICE DATE/CATEGORIES</h6>
							<input class="form-control text-secondary" value="<?php echo $rs["serv_date"];?> - <?php echo $rs["serv_categ"];?>" readonly style="margin-top:-5px;background:#eee;padding:5px 10px 5px 10px;border-radius:5px">
						</div>
						<div class='col-md-12' style='margin-top:8px'>
							<h6> SERVICE CLIENT</h6>
							<input class="form-control text-secondary" value="<?php echo $fname;?>, <?php echo $postn;?>" readonly style="margin-top:-5px;margin-bottom:5px;background:#eee;padding:5px 10px 5px 10px;border-radius:5px">
							<input class="form-control text-secondary" value="<?php echo $addrs;?>, <?php echo $phone;?>" readonly style="margin-top:5px;background:#eee;padding:5px 10px 5px 10px;border-radius:5px">
						</div>
						<div class='col-md-12' style='margin-top:8px'>
							<h6> SERVICE UNIT</h6>
							<input class="form-control text-secondary" value="<?php echo $rs["unit_make"];?> - <?php echo $rs["unit_model"];?>" readonly style="margin-top:-5px;background:#eee;padding:5px 10px 5px 10px;border-radius:5px">
						</div>
						<div class='col-md-12' style='margin-top:8px'>
							<h6> JOB DESCRIPTION</h6>
							<input class="form-control text-secondary" value="<?php echo $rs["serv_desc"];?>" readonly style="margin-top:-5px;background:#eee;padding:5px 10px 5px 10px;border-radius:5px">
						</div>
						<div class='col-md-12' style='margin-top:8px'>
							<h6> TECHNICIAN</h6>
							<input class="form-control text-secondary" value="<?php echo $rs["technician"];?>" readonly style="margin-top:-5px;background:#eee;padding:5px 10px 5px 10px;border-radius:5px">
						</div>
					</div>
					<?php 
						if($rs["remarks"]!==""){
						echo"
						<div class='col-md-12' style='margin-top:8px'>
								<h6> REMARKS</h6>
								<input class='form-control text-secondary' value='".$rs["remarks"]."' readonly style='margin-top:-5px;background:#eee;padding:5px 10px 5px 10px;border-radius:5px'>
							</div>";
						}
					?>
				</div>

				<div class='col'>
					<?php

						$exd=$link->query("SELECT * FROM trans_details WHERE serv_id='".$rs[0]."' ");

						if ($exd->num_rows > 0) {
							echo"";
						}else{
							echo"
							<a onclick=\"jump('admin_transactions_add_parts.php?transactions=$rs[0]')\">
							<div id='buttons' class='text-center' style='margin-top:20px'>
								 <button class='btn btn-primary'>Add Service Parts</button>
							</div><br></a>";
						}
						
						if ($exd->num_rows > 0) {

						echo"

						<h2 style='margin-top:10px'>Replacements &nbsp; 
							<button id='buttons' onclick=\"jump('admin_transactions_add_parts.php?transactions=$rs[0]')\" class='btn btn-sm btn-primary'>Add Parts</button>
						</h2>	
							<table class='table'>
								<thead class='bg-secondary text-light'>
									<tr>
										<th class='bg-secondary text-center'>#</th>
										<th class='bg-secondary'>Parts</th>
										<th class='bg-secondary'>Description</th>
										<th class='bg-secondary'>Amount</th>
										<th class='hid bg-secondary text-center'>Action</th>
									</tr>
								</thead>";
								
								while($rsd=mysqli_fetch_array($exd)){

								$tds=$link->query("SELECT * FROM products WHERE product_id='".$rsd["product_id"]."' ");
								$tpd=mysqli_fetch_array($tds);	
								$dsc=$tpd["description"];
								$prc=$tpd["product_price"];
								$sid=$rs[0];
								$dat=$rs["serv_date"];
								$pay=$rs["payment"];

								$link->query("UPDATE trans_details SET product_price = '$prc' WHERE product_id='".$tpd[0]."'");
								$link->query("UPDATE trans_details SET serv_date = '$dat' WHERE serv_id='$sid'");
								$link->query("UPDATE trans_details SET payment = '$pay' WHERE serv_id='$sid'");
																
								$cnt = $link->query("SELECT SUM(product_price) AS total FROM trans_details WHERE serv_id='".$rs[0]."' ");
								$res = mysqli_fetch_array($cnt);
								$totMat = $res["total"];
									
								$cls="style='font-size:15px;border-bottom:1px solid #bbb;height:20px;padding:4px'";
								
									echo"<tbody style='border:1px solid #bbb'>";
										if($i%2==0) echo"<tr class='odd' id='tr_".$rsd[0]."' >"; else echo"<tr class='even' id='tr_".$rsd[0]."' >";
										echo"
											<td $cls class='text-center'>$i.</small></td>
											<td $cls>".$rsd["product_name"]."</td>
											<td $cls>".$dsc."</td>
											<td $cls>&#8369;".number_format($rsd["product_price"]).".00</td>
											<td $cls class='hid text-center'>
												<a  href='admin_products_edit.php?products=".$rsd["product_id"]."' title='Edit'><img src='img/_edit.png' style='height:17px;margin-top:-5px'/></a>&nbsp;&nbsp;
												<input onclick=\"parts_delete('$rsd[0]');\" type=image src='img/_delete.png' style='margin-bottom:-6px;height:23px;padding:0' title='Delete'/>
											</td>
										</tr>
									</tbody>";
								  $i++;
								}	
							echo"</table>";		
						}
					?>	
					
					<h2>Payment Summary</h2>

					<div class="text-secondary" style="border:1px solid #bbb;text-align:right;background:#bbb;margin:5px 0 5px 0;border-radius:5px;font-size:20px;padding:5px 15px 5px 5px;">
						Labor &#8369;<b><?php echo"".number_format($rs["labor_cost"]).".00";?></b>
					</div>

					<div class="text-secondary bg-warning" style="border:1px solid #bbb;text-align:right;margin:5px 0 5px 0;border-radius:5px;font-size:20px;padding:5px 15px 5px 5px;">
						Materials &#8369;<b><?php echo"".number_format($totMat).".00";?></b>
					</div>

					<div class="bg-secondary text-light" style="border:1px solid #bbb;text-align:right;margin:5px 0 5px 0;border-radius:5px;font-size:40px;padding:5px 15px 5px 5px;">
						&#8369;<b><?php echo"".number_format($totMat+$rs["labor_cost"]).".00";?></b>
					</div>
					<div id="status" class="row text-center" style="font-size:20px;margin:15px 0 15px 0;color:#fff;border-radius:5px;">
						<?php
							if($rs["payment"]=="Paid"){
								echo"<button class='btn btn-success' style='border-radius:5px'> P a i d </button>";
							}
							if($rs["payment"]=="Pending"){
								echo"<button class='btn btn-warning' style='border-radius:5px'> P e n d i n g </button>";
							}
							if($rs["payment"]=="Collectable"){
								echo"<button class='btn btn-danger blinking' style='border-radius:5px'> C o l l e c t a b l e </button>";
							}
						?>
					</div>

					<?php
						if(isset($_POST["b_upImg_$rs[0]"])){
							move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "img/transactions/$rs[0].jpg");
							$link->query("update transactions set serv_photo=1 where serv_id='$rs[0]'");
							jump("");
						}						
					?>
					
					<form action='#' method='POST' enctype='multipart/form-data'>

					<?php
						echo"
						<div id='sub-btn' class='row text-center' style='background:#bbb;margin:15px 0 15px 0;border-radius:5px;padding:5px;'>
							<div class='col'>
								<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
								<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
								<input class='btn btn-success btn-sm' value='Photo' style='width:95px;margin:5px 0 5px 0' onclick=\"$('#b_file_$rs[0]').click();\"/>
							</div>
							<div class='col'>
								<input onclick='printF()' class='btn btn-dark btn-sm' value='Print' style='width:95px;margin:5px 0 5px 0'>
							</div>
							<div class='col'>
								<input onclick=\"jump('admin_transactions_edit.php?transactions=$rs[0]')\" class='btn btn-secondary btn-sm' value='Update' style='width:95px;margin:5px 0 5px 0'>
							</div>
							<div class='col'>
								<input onclick=\"trans_delete('$rs[0]');\" class='btn btn-primary btn-sm' value='Delete' style='width:95px;margin:5px 0 5px 0'>
							</div>
						</div>
						";
					?>
					</form>
					<div id="sign" style="hid margin-bottom:12px;padding:15px;border:1px solid #bbb;border-radius:5px;display:none">					
						Encoded by: <br>
						<?php 
							$uid = $_SESSION["usid"];	
							$exu = $link->query("SELECT * FROM users WHERE usrid = '$uid' ");
							$rsu = mysqli_fetch_array($exu);
						?>
						<div class='text-center text-uppercase'>
							<b><?php echo $rsu["fname"];?> &nbsp; <?php echo $rsu["lname"];?> </b> <br>
						</div>
						<div class='text-center'>
							<?php echo $rsu["account"];?> 
						</div>
						<div class='text-center'>
							<small><?php echo date("l F d, Y h:i:s");?></small> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<script>
	function printF(){		
		getID('topbar').style.display='none';
		getID('navbar').style.display='none';
		getID('photo').style.display='none';
		getID('logo').style.display='block';
		getID('link-icons').style.display='none';
		getID('status').style.display='none';
		getID('sign').style.display='block';
		getID('buttons').style.display='none';
		getID('sub-btn').style.display='none';
		getID('footer').style.display='none';
		getID('backtotop').style.display='none';
		$(".hid").css("display","none");

	window.print();
		getID('topbar').style.display='block';
		getID('navbar').style.display='block';
		getID('photo').style.display='block';
		getID('logo').style.display='none';
		getID('link-icons').style.display='block';		
		getID('status').style.display='block';
		getID('sign').style.display='none';
		getID('buttons').style.display='block';
		getID('sub-btn').style.display='block';
		getID('footer').style.display='block';
		getID('backtotop').style.display='block';
		$(".hid").css("display","block");

		window.location.href = 'admin_transactions_details.php?transactions=<?php echo $rs[0];?>';
	}	
</script>

<?php } } require("admin_footer.php"); ?>
<!-- <!-- Transaction Details End -->

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
			xmlhttp.open("GET","admin_transactions_delete.php?serv_id="+serv_id,true);
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
			xmlhttp.open("GET","admin_transactions_details_delete.php?dets_idno="+dets_idno,true);
			xmlhttp.send();
		}
	}
</script>