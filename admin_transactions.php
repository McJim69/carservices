<?php
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");	

	$value=$_GET['value'];
				
	$catg="";
		if($_GET["categories"]!="Categories" && $_GET["categories"]!="")
			$catg=" and serv_categ='".$_GET["categories"]."'";
					
	$cust="";
		if($_GET["clients"]!="Clients" && $_GET["clients"]!="")
			$cust=" and serv_client='".$_GET["clients"]."'";

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
		
	$ex=$link->query("select * from transactions t where 
	   (t.serv_id like'%".$value."%' or
  	    t.serv_date like'%".$value."%' or
		t.serv_client like'%".$value."%' or
		t.serv_categ like'%".$value."%' or	
		t.serv_desc like'%".$value."%') $catg $cust order by serv_id LIMIT $from,$to ")or die(mysqli_error($link));		

	$ex1=$link->query("select * from transactions t where 
	   (t.serv_id like'%".$value."%' or
  	    t.serv_date like'%".$value."%' or
		t.serv_client like'%".$value."%' or
		t.serv_categ like'%".$value."%' or	
		t.serv_desc like'%".$value."%') $catg $cust order by serv_id ")or die(mysqli_error($link));		
		
	$sbtn="<button style='margin-top:5px' type='submit' class='btn btn-primary' name='b_search'><i class='fa fa-search'></i></button>";
	$lbtn="<button style='margin-top:5px' class='btn btn-primary'><i class='fa fa-list'></i></button>";
	$abtn="<span style='margin-top:5px' class='btn btn-primary' onClick=\"jump('admin_transactions_add.php')\"><i class='fa fa-plus' title='Add'></i></span>";
?>

<script> setActive("transactions"); </script>

<form action='#' method='POST' enctype='multipart/form-data'>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">
					<span onClick="jump('admin_transactions.php')" class="btn btn-primary rounded-pill"><i class="fa fa-sync" title="Refresh"></i></span>
						Transactions
					<span onClick="jump('admin_transactions.php')" class="btn btn-primary rounded-pill"><i class="fa fa-sync" title="Refresh"></i></span>
				</h1>
				<input style="width:232px;margin-top:5px;text-align:left" type="text" class="btn btn-light text-capitalize" placeholder="Type a keyword" name="t_search" id="t_search" value="<?php if($_POST["t_search"]!=""){echo $_POST["t_search"];} ?>"><?php echo $sbtn;?>
				<select style='width:232px;margin-top:5px;padding:8px;text-align:left' class="btn btn-light" onchange="if(this.value=='Categories')jump('admin_transactions.php'); else jump('admin_transactions.php?categories='+this.value+'&clients=<?php echo $_GET["clients"];?>')">
					<option>Categories</option>
					<?php
						$ex2=$link->query("select serv_categ from transactions where serv_categ='".$_GET["categories"]."' group by serv_categ order by serv_categ")or die(mysqli_error($link));		
						if($_GET["clients"]=="" || $_GET["clients"]=="Clients")							
						$ex2=$link->query("select serv_categ from transactions group by serv_categ order by serv_categ")or die(mysqli_error($link));																	
						while($rs=mysqli_fetch_array($ex2)){
							echo "<option ";
						if($_GET["categories"]===$rs[0])
							echo "selected";
							echo">$rs[0]</option>";
						}
					?>
				</select><?php echo $lbtn;?>
				<select style='width:232px;margin-top:5px;padding:8px;text-align:left' class="btn btn-light" onchange="jump('?categories=<?php echo $_GET["categories"];?>&clients='+this.value)">
					<option>Clients</option>
					<?php
						$ex2=$link->query("select serv_client from transactions where serv_categ='".$_GET["categories"]."' and serv_client='".$_GET["clients"]."' group by serv_client order by serv_client")or die(mysqli_error($link));

						if($_GET["categorie"]=="" || $_GET["categorie"]=="Categorie")

						$ex2=$link->query("select serv_client from transactions group by serv_client order by serv_client")or die(mysqli_error($link));										
						
						while($rs=mysqli_fetch_array($ex2)){
							echo "<option ";
						if($_GET["clients"]===$rs[0])
							echo "selected";
							echo">$rs[0]</option>";
						}
					?>
				</select><?php echo $lbtn;?>
				<button onClick="jump('admin_transactions_add.php')" style='width:232px;margin-top:5px;text-align:left' type='button' class='btn btn-light'>Add Transaction
				</button><?php echo $abtn;?>
			</div>
        </div>
    </div>
<!-- Page Header End -->

<!-- Transaction List -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class='row g-4' style='margin-top:-70px' >

			<?php

				$val=strtoupper($_POST["t_search"]);

				$rep="<b style='color:#0014d0;background:#ffa0a0'>$val</b>";
					
				if ($ex->num_rows > 0) {				
					
				while($rs=mysqli_fetch_array($ex)){
					
				$lab=$rs["labor_cost"];

				$link->query("UPDATE trans_details SET serv_date = '".$rs["serv_date"]."' WHERE serv_id='".$rs[0]."'");
				$link->query("UPDATE trans_details SET payment   = '".$rs["payment"]."'   WHERE serv_id='".$rs[0]."'");

				$exd=$link->query("SELECT * FROM trans_details WHERE serv_id='".$rs[0]."' ");

				while($rsd=mysqli_fetch_array($exd)){
					$tds=$link->query("SELECT * FROM products WHERE product_id='".$rsd["prod_idno"]."' ");
					$tpd=mysqli_fetch_array($tds);																		
				}

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

				echo"
					<div class='col-lg-3 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>
						<div class='box-item'>
							<div class='position-relative overflow-hidden'>
								<img class='img-fluid' width='100%'";
								
									if(file_exists("img/transactions/resized/$rs[0].jpg")){			
										echo" src='img/transactions/resized/$rs[0].jpg? ".date("h:i:s")."' />";
									}else{
										echo" src='img/aircon-parts.jpg' style='background:#bbb'/>";
									}
								
								echo"
								
								<div class='box-overlay' style='position:absolute; top:155px;left:0;right:0'> 						
									<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
									<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
									<input type='button' class='btn' value='Photo' style='width:85px;' onclick=\"$('#b_file_$rs[0]').click();\"/> &nbsp;
									<a href='admin_transactions_edit.php?transactions=$rs[0]'>
									<input type='button' class='btn' value='Update' style='width:85px'></a> &nbsp;
									<input type='button' onclick=\"trans_delete('$rs[0]');\" class='btn' value='Delete' style='width:85px'>
								</div>
								<div class='box-overlay' style='position:absolute; top:200px;left:0;right:0'> 		
									<input type='button' onclick=\"jump('admin_transactions_add_parts.php?transactions=$rs[0]')\" class='btn' value='Parts' style='width:85px'> &nbsp;
									<input type='button' onclick=\"jump('admin_transactions_details.php?transactions=$rs[0]')\" class='btn' value='Print' style='width:85px'> &nbsp;
									<input type='button' onclick=\"jump('admin_transactions_details.php?transactions=$rs[0]')\" class='btn' value='Details' style='width:85px'>
								</div>
							</div>
							<div class='bg-light text-center p-4 overflow-hidden'>
								<div class='btn btn-primary' onclick=\"jump('admin_transactions_details.php?transactions=$rs[0]')\">
									JOB ORDER # ".$tids."
								</div>
								<h5 class='fw-bold mb-0'>".str_replace($val,$rep,$rs["serv_client"])."</h5>
								<small>
									<div><b>".str_replace($val,$rep,$rs["unit_make"])." - ".str_replace($val,$rep,$rs["unit_model"])."</b></div>
									<div>".str_replace($val,$rep,$rs["serv_categ"])."</div>
									<div>".str_replace($val,$rep,$rs["serv_desc"])."</div>
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
<!-- Transaction List End -->

<script>
	function trans_delete(serv_id){	
		if(confirm("Are you sure you want to Remove this Product?")){
			xmlhttp.onreadystatechange=function()
			{
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
</script>

<?php require("admin_footer.php");?>