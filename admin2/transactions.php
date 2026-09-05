<?php
	require("header.php");
	require("navbar.php");

	$value=$_GET['value'];
				
	$catg="";
		if($_GET["categories"]!="Categories" && $_GET["categories"]!="")
			$catg=" and serv_categ='".$_GET["categories"]."'";
					
	$cust="";
		if($_GET["clients"]!="Clients" && $_GET["clients"]!="")
			$cust=" and serv_client='".$_GET["clients"]."'";

	$stat="";
		if($_GET["status"]!="Status" && $_GET["status"]!="")
			$stat=" and payment='".$_GET["status"]."'";

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
		t.serv_desc like'%".$value."%') $catg $cust $stat order by serv_date DESC LIMIT $from,$to ")or die(mysqli_error($link));		

	$ex1=$link->query("select * from transactions t where 
	   (t.serv_id like'%".$value."%' or
  	    t.serv_date like'%".$value."%' or
		t.serv_client like'%".$value."%' or
		t.serv_categ like'%".$value."%' or	
		t.serv_desc like'%".$value."%') $catg $cust $stat order by serv_date DESC ")or die(mysqli_error($link));		
	//
?>

<div class="content-wrapper">
	<div class='row'>
		<div class='col-lg-12'>
			<div class='card' style='margin-bottom:-30px'>
				<div class='card-body'>
				<h3 class='card-title'>Transactions List &nbsp;
					<a href='transactions_add.php' class='btn btn-sm btn-outline-info' title='Add Transactions'> 
						<b>+</b> ADD
					</a>
				</h3>
				<!-- Page Header Start -->
				<form action='#' method='POST' enctype='multipart/form-data'>
					<div class='row' style="margin-top:-10px">
						<div class='col-lg-3 btn-group'>
							<a href="transactions.php" title='Refresh' style='margin:5px 0 5px 0' class='btn btn-outline-info'><i class='mdi mdi-refresh'></i></a>
							<input style='text-align:left;margin:5px 0 5px 0;width:72.9%' type="text" class="btn btn-outline-info" placeholder="Type a keyword..." name="t_search" id="t_search" value="<?php if($_POST["t_search"]!=""){echo $_POST["t_search"];} ?>">
							<button style='margin:5px 0 5px 0' type='submit' class='btn btn-outline-info' name='b_search'><i class='mdi mdi-magnify'></i></button>
						</div>
						<div class='col-lg-2 btn-group'>
							<select style='text-align:left;margin:5px 0 5px 0;width:100%' class="btn btn-outline-info" onchange="if(this.value=='Categories')jump('transactions.php'); else jump('transactions.php?categories='+this.value+'&clients=<?php echo $_GET["clients"];?>&staus=<?php echo $_GET["staus"];?>')">
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
							</select>
						</div>
						<div class='col-lg-2 btn-group'>
							<select style='text-align:left;margin:5px 0 5px 0;width:100%' class="btn btn-outline-info" onchange="jump('?categories=<?php echo $_GET["categories"];?>&staus=<?php echo $_GET["staus"];?>&clients='+this.value)">
								<option>Clients</option>
								<?php
									$ex2=$link->query("select serv_client from transactions where serv_categ='".$_GET["categories"]."' and payment='".$_GET["status"]."' group by serv_client order by serv_client")or die(mysqli_error($link));

									if($_GET["categorie"]=="" || $_GET["categorie"]=="Categorie")

									$ex2=$link->query("select serv_client from transactions group by serv_client order by serv_client")or die(mysqli_error($link));										
									
									while($rs=mysqli_fetch_array($ex2)){
										echo "<option ";
									if($_GET["clients"]===$rs[0])
										echo "selected";
										echo">$rs[0]</option>";
									}
								?>
							</select>
						</div>
						<div class='col-lg-2 btn-group'>
							<select style='text-align:left;margin:5px 0 5px 0;width:100%' class="btn btn-outline-info" onchange="jump('?categories=<?php echo $_GET["categories"];?>&clients=<?php echo $_GET["clients"];?>&status='+this.value)">
								<option>Status</option>
								<?php
									$ex2=$link->query("select payment from transactions where serv_categ='".$_GET["categories"]."' and serv_client='".$_GET["clients"]."' group by payment order by payment")or die(mysqli_error($link));

									if($_GET["clients"]=="" || $_GET["clients"]=="Clients")

									$ex2=$link->query("select payment from transactions group by payment order by payment")or die(mysqli_error($link));										
									
									while($rs=mysqli_fetch_array($ex2)){
										echo "<option ";
									if($_GET["status"]===$rs[0])
										echo "selected";
										echo">$rs[0]</option>";
									}
								?>
							</select>
						</div>
					</div>
					</form>			
					<!-- Page Header End -->

					<!-- Transaction Table Start -->
					<div class='row'>
						<div class='col'>
							<div class="table-responsive" style='height:685px;border-radius:4px'>
								<table class="table table-dark table-hover">
									<thead class="text-uppercase bg-dark">
										<tr>
											<th width='1%' class='text-center'>#</th>
											<th width='1%' class='text-center'>PIC</th>
											<th>DATE</th>
											<th>CLIENT</th>
											<th>UNIT-MODEL</th>
											<th>categories</th>
											<th>DESCRIPTION</th>
											<th>TECHNICIAN</th>
											<th>LABOR</th>
											<th>STATUS</th>
											<th>ACTIONS</th>
										</tr>
									</thead>	
									<tbody>

									<?php				
										$i=1;
										$val=strtoupper($_POST["t_search"]);

										$rep="<b style='color:#0014d0;background:#ffa0a0'>$val</b>";
											
										if ($ex->num_rows > 0) {				
											
										while($rs=mysqli_fetch_array($ex)){
											
										$lab=$rs["labor_cost"];

										$link->query("UPDATE trans_details SET serv_date = '".$rs["serv_date"]."' WHERE serv_id='".$rs[0]."'");

										$exd=$link->query("SELECT * FROM trans_details WHERE serv_id='".$rs[0]."' ");

										while($rsd=mysqli_fetch_array($exd)){
											$tds=$link->query("SELECT * FROM products WHERE product_id='".$rsd["prod_idno"]."' ");
											$tpd=mysqli_fetch_array($tds);																		
										}

										$cont = $rs[0];
										$tids = sprintf("%04d", $cont);
										
										$cls="style='height:42px;padding:0 5px 0 5px;margin:0'";
									
										echo"
										<tr id='tr_".$rs[0]."'>
											<td width='1%' $cls class='text-center'>$i</td>
											<td width='1%' $cls class='text-center'><img style='height:25px;width:25px;border-radius:50%' class='cust' ";
												if(file_exists("../img/transactions/resized/$rs[0].jpg")){
													echo"src='../img/transactions/resized/$rs[0].jpg' >";
												}else{
													echo"src='../img/favicon.png' >";
												}
											echo"
											</td>
											<td $cls>".str_replace($val,$rep,$rs["serv_date"])."</td>
											<td $cls>".str_replace($val,$rep,$rs["serv_client"])."</td>
											<td $cls>".str_replace($val,$rep,$rs["unit_make"])." - ".str_replace($val,$rep,$rs["unit_model"])."</td>
											<td $cls>".str_replace($val,$rep,$rs["serv_categ"])."</td>
											<td $cls>".str_replace($val,$rep,$rs["serv_desc"])."</td>
											<td $cls>".str_replace($val,$rep,$rs["technician"])."</td>
											<td $cls>&#8369; ".number_format($rs["labor_cost"],2)."</td>
											<td $cls>";
												if($rs["payment"]=="Paid"){
													echo"<x onclick=\"jump('transactions_details.php?transactions=$rs[0]')\" class='btn-inverse-success btn btn-sm' style='width:90px'>Paid</x>";
												}
												if($rs["payment"]=="Pending"){
													echo"<x onclick=\"jump('transactions_details.php?transactions=$rs[0]')\" class='btn-inverse-info btn btn-sm' style='width:90px'>Pending</x>";
												}
												if($rs["payment"]=="Collectable"){
													echo"<x onclick=\"jump('transactions_details.php?transactions=$rs[0]')\" class='btn-inverse-danger btn btn-sm' style='width:90px'>Collectable</x>";
												}
																					
											echo"
											<td $cls>
												<span 
													onclick=\"jump('transactions_print.php?transactions=$rs[0]')\" 
													class='btn btn-sm btn-inverse-primary' 
													title='Print'>
													<i class='fa fa-print'></i>
												</span>
												<span 
													onclick=\"jump('transactions_details.php?transactions=$rs[0]')\" 
													class='btn btn-sm btn-inverse-info' 
													title='View'>
													<i class='fa fa-eye'></i>
												</span>
												<span 
													onclick=\"jump('transactions_edit.php?transactions=$rs[0]')\" 
													class='btn btn-sm btn-inverse-success' 
													title='Edit'>
													<i class='mdi mdi-grease-pencil'></i>
												</span>
												<span 
													onclick=\"trans_delete('$rs[0]');\" 
													class='btn btn-sm btn-inverse-danger' 
													title='Delete'>
													<i class='mdi mdi-window-close'></i>
												</span>
											</td>
										</tr>";
										$i++;
											}
										} else {
										//No Records Found Error
										$error="
										<div style='text-align:center'><br>
											<div style='text-align:center;font-size:20px'>Searching <b>...</b> $value</div><br><a href='transactions.php'>
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
					<!-- Transaction Table End -->
				</div>
			</div>
		</div>				
	</div>
</div>

<script>
	function trans_delete(serv_id){	
		if(confirm("Are you sure you want to Remove this Transaction?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#tr_"+serv_id).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#tr_"+serv_id).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","../admin_transactions_delete.php?serv_id="+serv_id,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("footer.php");?>
