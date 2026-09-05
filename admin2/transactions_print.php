<?php 
	require("connect.php");
	require("language.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta content="<?php echo _TITLE;?>" name="keywords">
    <meta content="Car Aircon, <?php echo _DESC;?>" name="description">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo _TITLE;?> - Admin</title>
    <link rel="shortcut icon" href="../favicon.png">
	<link href="../lib/font-awesome/css/all.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

	<script>
		if (window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");				
		
		function conf(){
			return confirm("Are you sure?");
		}
		function getID(id){
			return document.getElementById(id);
		}		
		function jump(page){
			window.location=page;
		}
	</script>
	
</head>

<?php
	function jump($page){
		echo "<script>window.location='$page'</script>";
	}
?>	

<?php 
	$i=1;

	$tran="";
	if($_GET["transactions"]!="")
		$tran=" and serv_id='".$_GET["transactions"]."' ";
												
	$ex = $link->query("select * from transactions where serv_id=serv_id $tran order by serv_id limit 1");
	  
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

	$tsc = $link->query("SELECT * FROM customers WHERE cid='".$rs["cust_id"]."' ");
	while($tcn=mysqli_fetch_array($tsc)){
		$fname = $tcn["fullname"];
		$postn = $tcn["position"];
		$addrs = $tcn["address"];
		$phone = $tcn["phone"];
	}

	$spc = $link->query("SELECT * FROM customers WHERE fullname='".$rs["cust_id"]."' ");
	
?>

<body>

<center>

<div class="row justify-content-center">

<div class="col-xl-4 col-lg-4 col-md-5 col-sm-5 text-dark bg-light" style="margin:50px;padding:20px;border-radius:10px;border:2px solid #545454">
	
	<div style="position:relative" class="row text-center" id="printButton">
		<div class="col-lg-6" align="left" style="position:absolute;top:0;left:0">
			<span class="btn btn-outline-dark" onClick="jump('transactions_details.php?transactions=<?php echo $cont;?>')"><i class="far fa-arrow-alt-circle-left"></i>Cancel</span>
		</div>
		<div class="col-lg-6" align="right" style="position:absolute;top:0;right:0">
			<span class="btn btn-outline-dark" onClick="printF()" ><i class="fa fa-print"></i>Print</span>
		</div>
	</div>

	<div class="text-center">
		<img class="img-fluid" src="../img/logo_receipt.png?<?php echo date("h:i:s");?>"/>
		<div>
		<h4 class='text-uppercase'><?php echo _DESC;?></h4>	
			<small>
				<?php echo _HOMEADD;?><br>
				<?php echo _EMAIL1;?> &bull; www.<?php echo _DOMAIN;?><br>
				<?php echo _PHONE1;?> &bull; <?php echo _PHONE2;?><br>
			</small>
		</div><small>-oOo-</small>
		<h2>JOB ORDER</h2>
		<!--<h2>OFFICIAL RECEIPT</h2>-->
		<div class='text-dark' style="background:#bbb;border:1px solid #000;border-radius:5px;font-size:20px">
			JO-<b><?php echo $tids;?></b>-<?php echo date('Y', strtotime($rs["serv_date"]));?>
		</div>
	</div>
	<br>
	<h3 style="text-align:left">Details</h3>


	<div class="table-responsive" style="border: 1px solid #555555;border-radius:5px">
		<table class="table">
			<tr>
				<td style="height:35px;padding:0 10px 0 10px">Date</td>
				<td style="height:35px;padding:0 10px 0 10px">: &nbsp; <?php echo $date;?></td>
			</tr>
			<tr>
				<td style="height:35px;padding:0 10px 0 10px">Category</td>
				<td style="height:35px;padding:0 10px 0 10px">: &nbsp; <?php echo $cate;?></td>
			</tr>
			<tr>
				<td style="height:35px;padding:0 10px 0 10px">Customer</td>
				<td style="height:35px;padding:0 10px 0 10px">: &nbsp; <?php echo $fname;?></td>
			</tr>	
			<tr>	
				<td style="height:35px;padding:0 10px 0 10px">Position</td> 
				<td style="height:35px;padding:0 10px 0 10px">: &nbsp; <?php echo $postn;?></td> 
			</tr>
			<tr>
				<td style="height:35px;padding:0 10px 0 10px">Address</td> 
				<td style="height:35px;padding:0 10px 0 10px">: &nbsp; <?php echo $addrs;?></td>
			</tr>
			<tr>								
				<td style="height:35px;padding:0 10px 0 10px">Phone No</td></td>  
				<td style="height:35px;padding:0 10px 0 10px">: &nbsp; <?php echo $phone;?></td> 
			</tr>
			<tr>	
				<td style="height:35px;padding:0 10px 0 10px">Unit/Model</td> 
				<td style="height:35px;padding:0 10px 0 10px">: &nbsp; <?php echo $unit;?> - <?php echo $mode;?></td> 
			</tr>
			<tr>	
				<td style="height:35px;padding:0 10px 0 10px">Description</td> 
				<td style="height:35px;padding:0 10px 0 10px">: &nbsp; <?php echo $desc;?></td> 
			</tr>
			<tr>	
				<td style="height:35px;padding:0 10px 0 10px">Technician</td> 
				<td style="height:35px;padding:0 10px 0 10px">: &nbsp; <?php echo $tech;?></td> 
			</tr>
			<tr>	
				<td style="height:35px;padding:0 10px 0 10px">Labor Cost</td> 
				<td style="height:35px;padding:0 10px 0 10px">: &nbsp; &#8369; <?php echo number_format($cost,2);?></td> 
			</tr>
			<?php if($rems!=="") 
			echo"
			<tr>
				<td style='height:35px;padding:0 10px 0 10px'>Remarks</td>
				<td style='height:35px;padding:0 10px 0 10px'>: &nbsp; $rems</td>
			</tr>";
			?>
		</table>
	</div>

	<?php
		$trth="style='height:40px'";

		$exd=$link->query("SELECT * FROM trans_details WHERE serv_id='".$rs[0]."' ");
		
		if ($exd->num_rows > 0) {
	
		echo"<br>
		<h3 style='text-align:left'>Replacements</h3>
		<div class='table-responsive' style='border:1px solid #545454;border-radius:4px'>
			<table class='table'>
				<thead class='text-uppercase' style='background:#bbb;border-radius:4px'>
					<tr>
						<th $trth class='text-dark text-center'>#</th>
						<th $trth class='text-dark'>Description</th>
						<th $trth class='text-dark'>Amount</th>
					</tr>
				</thead>
				<tbody class='text-dark'>";
				
				while($rsd=mysqli_fetch_array($exd)){

				$tds=$link->query("SELECT * FROM products WHERE product_id='".$rsd["product_id"]."' ");
				$tpd=mysqli_fetch_array($tds);	
				
				$sid=$rs[0];

				$dat=$rs["serv_date"];
				$dsc=$tpd["description"];
				$prc=$tpd["product_price"];

				$link->query("UPDATE trans_details SET product_price = '$prc' WHERE product_id='".$tpd[0]."'");
				$link->query("UPDATE trans_details SET serv_date = '$dat' WHERE serv_id='$sid'");
				$link->query("UPDATE trans_details SET payment = '$pay' WHERE serv_id='$sid'");
												
				$cnt = $link->query("SELECT SUM(product_price) AS total FROM trans_details WHERE serv_id='".$rs[0]."' ");
				$res = mysqli_fetch_array($cnt);
				$totMat = $res["total"];
					
				$trtd="style='height:40px;padding:5px'";
				
					echo"<tr id='tr_".$rsd[0]."'>
						<td $trtd class='text-center'>$i.</small></td>
						<td $trtd>".$dsc."</td>
						<td $trtd>&#8369; ".number_format($rsd["product_price"]).".00</td>
					</tr>";
				  $i++;
				}	
				echo"			
				</tbody>
			</table>
		</div>";		
		}
		
		$tabb = "style='padding:0 0 0px 15px;height:40px;font-size:18px'";
		$tabh = "style='padding:0 0 12px 15px;height:45px;font-size:18px'";
	?>	
	<br>
	<h3 style="text-align:left">Summary</h3>
	<div class="table-responsive" style='border:1px solid #545454;border-radius:4px'>
		<table class="table">
			<thead style="background:#bbb;border-radius:4px">
				<tr>
					<th class="text-dark" <?php echo $tabh;?>>PARTICULAR</th>
					<th class="text-dark" <?php echo $tabh;?>>AMOUNT</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="text-dark" <?php echo $tabb;?>>Labor Cost</td>
					<td class="text-dark" <?php echo $tabb;?>>&#8369; <?php echo number_format($cost,2);?></td>
				</tr>
				<tr>
					<td class="text-dark" <?php echo $tabb;?>>Parts Cost</td>
					<td class="text-dark" <?php echo $tabb;?>>&#8369; <?php echo number_format($totMat,2);?></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th class="text-dark" <?php echo $tabb;?>>TOTAL</th>
					<th class="text-dark" <?php echo $tabb;?>>&#8369; <?php echo number_format($totMat+$cost,2);?></th>				
				</tr>
			</tfoot>
		</table>
	</div>
	<br>
	<div style="padding:15px;border:1px solid #545454;border-radius:5px">					
		<p style="text-align:left">Encoded by:</p>
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
			<small>Printed: <?php echo date("l F d, Y h:i:s");?></small> 
		</div>
	</div>

</div>

</div>

</center>

<?php } } ?>

<script>
	function printF(){	
		getID('printButton').style.display='none';	
		window.print();
		getID('printButton').style.display='block';	
		window.location.href = 'transactions_details.php?transactions=<?php echo $cont;?>';
	}	
</script>

</body>

</html>