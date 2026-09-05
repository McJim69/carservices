<?php
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");	

	function fill_tech($pdo){
		$output= '';
		$select = $pdo->prepare("SELECT * FROM technicians order by tech_id");
		$select->execute();
		$result = $select->fetchAll();

		foreach($result as $row){
			$cont = $row["fullname"];
			$cont = ucwords(strtolower($cont));
			
			$output.='<option value="'.$cont.'">'.$cont.'</option>';
		} 	return $output;
	}
    	
	if(isset($_POST["search"])){
		$dafr=$_POST["from"];
		$dato=$_POST["dato"];
		$tech=$_POST["tech"];

		if($_POST["tech"]==""){
			$tran="and technician=technician";
		}else{
			$tran="and technician='$tech'";
		}
			   
		$ext=$link->query("SELECT * FROM transactions WHERE serv_date BETWEEN '$dafr' AND '$dato' $tran ORDER BY serv_id") or die(mysqli_error($link));				

		$sum = $link->query("SELECT SUM(labor_cost) FROM transactions WHERE serv_date BETWEEN '$dafr' AND '$dato' $tran ORDER BY serv_id") or die(mysqli_error($link));
		$res = mysqli_fetch_array($sum);			
		$TOT = $res[0];
	}	
?>

<script> setActive("reports"); </script>

<style>
	td{
		height: 15px;
		padding-top: 0;
		padding-bottom: 0;
	}
	.btn{
		border-radius:4px;
	}
	.contab{
		text-align: center;
		border-radius: 4px;
		background: #545454;
		margin: 10px 0 10px 0;
		box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
	}
	.chartd{
		text-align: center;
		border-radius: 4px;
		border: 1px solid #eee;
		background: #fff;
		margin: 10px 0 10px 0;
		box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
	}
</style>

<!-- Page Header Start -->
    <div id="header1" class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Sales Report</h1>
				<button class="btn btn-primary" onClick="history.back()" style="width:120px;margin:5px"> 
					<i class="fa fa-arrow-left"></i> Back 
				</button>
				<button class="btn btn-primary" onClick="jump('admin_reports.php')" style="width:120px;margin:5px"> 
					<i class="fa fa-sync"></i> Refresh 
				</button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<!-- Reports Start -->
<form action="#" method="post" enctype="multipart/form-data">
<div style="min-height:550px;margin-top:-20px">
	<div id="header2" class="container">	
		<h2>Select Transaction Date</h2>
		<div class='row row-cols-12'>
			<div class='col-lg-2' style='margin-bottom:10px'>
				<input class="form-control btn btn-sm btn-light" style="margin-top:5px;border:1px solid #bbb" onfocus="(this. type='date')" placeholder="Date from" name="from" required>
			</div>
			<div class='col-lg-2' style='margin-bottom:10px'>
				<input class="form-control btn btn-sm btn-light" style="margin-top:5px;border:1px solid #bbb" onfocus="(this. type='date')" placeholder="Date to" name="dato" required>
			</div>
			<div class='col-lg-2' style='margin-bottom:10px'>
				<select class="form-control btn btn-sm btn-light" style="text-align:left;margin-top:5px;border:1px solid #bbb" name="tech">
					<option value="">Technician (ALL)</option>
					<?php echo fill_tech($pdo);?>
				</select>
			</div>
			<div class='col-lg-2 text-center' style='margin-bottom:10px'>
				<button class="btn btn-sm btn-primary" style="width:90px;margin-top:5px" type="submit" name="search" onchange="this.form.submit()"><i class="fa fa-search"></i> Search</button>
				<button class="btn btn-sm btn-primary" style="width:90px;margin-top:5px" onClick="printF()"><i class="fa fa-print"></i> Print</button>
			</div>
		</div>
	</div>

	<div class="container">			

		<?php	
			$i=1;
			if(isset($_POST["search"])){
					
			$date1=date_create($dafr);
			$date2=date_create($dato);

			$trans=number_format(mysqli_num_rows($ext),0);
			
			echo"
			<div class='hid text-secondary row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 row-cols-xl-6'>
				<div class='col' style='margin-bottom:10px'>
					<div class='btn-sm form-control text-center text-secondary text-uppercase'>
						<b>"; if($tech=="") echo"All Technicians"; else echo $tech; echo"</b>
					</div>
				</div>
				<div class='col' style='margin-bottom:10px'>
					<div class='btn-sm form-control text-center text-secondary'>
						From: <b>".date_format($date1,"M d, Y")."</b>
					</div>
				</div>
				<div class='col' style='margin-bottom:10px'>
					<div class='btn-sm form-control text-center text-secondary'>
						To: <b>".date_format($date2,"M d, Y")."</b>
					</div>
				</div>
				<div class='col' style='margin-bottom:10px'>
					<div class='btn-sm form-control text-center text-secondary'>
						<b>$trans</b> Transactions
					</div>
				</div>
			</div>";
			
			if($trans > 0){
			
			echo"	
			<div style='overflow-x:auto'>
				<table class='table table-responsive text-light contab'>
					<thead style='text-transform:uppercase'>
						<tr>
							<th width='2%' scope='col' style='text-align:center'><small>#</small></th>
							<th scope='col'><small>Client</small></th>
							<th scope='col'><small>Unit/Model</small></th>
							<th scope='col'><small>Description</small></th>
							<th scope='col'><small>Technician</small></th>
							<th scope='col'><small>Date</small></th>
							<th scope='col' style='text-align:right'><small>Labor</small></th>
							<th scope='col' style='text-align:right'><small>Materials</small></th>
							<th scope='col' style='text-align:right'><small>Total</small></th>
						</tr>
					</thead>";

					$Ltot=0;
					$Mtot=0;
					$Gtot=0;

					while($rsi=mysqli_fetch_array($ext)){
					
					$qrym = $link->query("SELECT SUM(product_price) FROM trans_details WHERE serv_id='".$rsi[0]."'") or die(mysqli_error($link));
					$arym = mysqli_fetch_array($qrym);			

					$mate = $arym[0];
					$labr = $rsi["labor_cost"];					
					$tots = $mate+$labr;

					$cls="onclick=\"jump('admin_transactions_details.php?transactions=$rsi[0]')\"";

					echo"<tbody style='border-left:1px solid #bbb;border-right:1px solid #bbb'>";
					
					if($i%2==0) echo"<tr class='odd' id='tr_".$rsi[0]."'>"; else echo"<tr class='even' id='tr_".$rsi[0]."'>";
						echo"
							<td scope='row' $cls><small><b>$i.</b></small></td>
							<td scope='row' $cls style='text-align:left'><small class='text-uppercase'>".$rsi["serv_client"]."</small></td>
							<td scope='row' $cls><small>".$rsi["unit_make"]."-".$rsi["unit_model"]."</small></td>
							<td scope='row' $cls><small>".$rsi["serv_desc"]."</small></td>
							<td scope='row' $cls><small>".$rsi["technician"]."</small></td>
							<td scope='row' $cls><small>".$rsi["serv_date"]."</small></td>
							<td scope='row' $cls style='text-align:right'><small>".number_format($labr,2)."</small></td>
							<td scope='row' $cls style='text-align:right'><small>".number_format($mate,2)."</small></td>
							<td scope='row' $cls style='text-align:right'><small>".number_format($tots,2)."</small></td>
						</tr>
					</tbody>";

					$Ltot+=$labr;
					$Mtot+=$mate;
					$Gtot+=$tots;
																														
					$i++;
				} 
				echo"
					<tfoot>
						<th scope='col'><small></small></th>
						<th scope='col'><small></small></th>
						<th scope='col'><small></small></th>
						<th scope='col'><small></small></th>
						<th scope='col'><small>TOTALS</small></th>
						<th scope='col'><small></small></th>
						<th scope='col' style='text-align:right'><small>&#8369; ".number_format($Ltot,2)."</small></th>
						<th scope='col' style='text-align:right'><small>&#8369; ".number_format($Mtot,2)."</small></th>
						<th scope='col' style='text-align:right'><small>&#8369; ".number_format($Gtot,2)."</small></th>
					</tfoot>
				</table>
			</div>";		

			}
			
			}else{
						
				if(isset($_POST['year'])){ 	
					$post = $_POST['year'];								
					$Year = "serv_date BETWEEN '$post-01-01' and '$post-12-31'"; 
				}else{
					$post = date("Y");
					$Year = "serv_date BETWEEN '".date("Y")."-01-01' and '".date("Y")."-12-31'";
				}

				echo"
					<select class='btn btn-sm btn-light' style='background:#eee;text-align:left;border:1px solid #bbb' name='year' type='submit' onchange='this.form.submit()'>	
						<option value='1'>$post</option>";
						$stryear = date("Y")-3;
						$endyear = date("Y"); 
						for($j=$stryear;$j<=$endyear;$j++){      
							echo"<option value='$j'>$j</option>";
						}
				echo"</select>";
					
				$ConT=0;
				$LabT=0;
				$MatT=0;
				$GrdT=0;

				$month = $link->query("SELECT
					serv_id AS id,
					DATE_FORMAT(serv_date, '%M') AS month, 
					DATE_FORMAT(serv_date, '%Y') AS year, 
					SUM(labor_cost) AS labor,
					COUNT(serv_id) AS count,
					serv_id AS id
					FROM transactions
					WHERE $Year GROUP BY MONTH(serv_date), 
					YEAR(serv_date)");							
					
				if($month->num_rows > 0){
					
				if(isset($_POST['year'])){ 			
					
			echo"
					
			<div style='overflow-x:auto'>";
						while($row = $month->fetch_assoc()) {

							$tqry = $link->query("SELECT SUM(labor_cost) FROM transactions WHERE $Year") or die(mysqli_error($link));
							$tary = mysqli_fetch_array($tqry);	

							$mqry = $link->query("SELECT SUM(product_price) FROM trans_details WHERE $Year AND serv_id='".$row["id"]."'") or die(mysqli_error($link));
							$mary = mysqli_fetch_array($mqry);	
								
							$count = $row["count"];
							$labor = $row["labor"];
							$mater = $mary[0];
							$total = $labor+$mater;

							$ConT+=$count;
							$LabT+=$labor;
							$MatT+=$mater;
							$GrdT+=$total;
															
						$i++;
					}				
				}
				}else{
					echo"  <span class='text-primary'>No records found for <b>$post</b>.</span><br><br>";
				}
				
					if($month->num_rows > 0){ 
					require("admin_reports_chart.php");
					echo"
					<div id='charts' class='text-center'>
						<div class='row lg-12 chartd'>
						<h4 style='margin-top:20px'>$post Total Sales &#8369;".number_format($sales,2)."</h4>
							<div class='col-lg-6'>&#8369;".number_format($sales,2)." 								
								<div id='chartContainer1' style='margin-bottom:12px;min-height: 300px; width: 100%'></div>													
							</div>
							<div class='col-lg-6'>&#8369;".number_format($stat,2)."
								<div id='chartContainer2' style='margin-bottom:12px;min-height: 300px; width: 100%'></div>													
							</div>
						</div>
					</div>";
				}
				echo"
			</div>";
			}
		?>
	</div>
</div>
</form>	
<!-- Reports End -->

<!-- Print Function Start -->
<script>
	function printF(){		
		getID('topbar').style.display='none';
		getID('navbar').style.display='none';
		getID('header1').style.display='none';
		getID('header2').style.display='none';
	//	getID('charts').style.display='none';
		getID('footer').style.display='none';
		getID('backtotop').style.display='none';
		$(".hid").css("display","none");

	window.print();
		getID('topbar').style.display='block';
		getID('navbar').style.display='block';
		getID('header1').style.display='block';
		getID('header2').style.display='block';
	//	getID('charts').style.display='block';
		getID('footer').style.display='block';
		getID('backtotop').style.display='block';
		$(".hid").css("display","block");

		window.location.href = 'admin_reports.php';
	}	
</script>
<!-- Print Function End -->

<?php require("admin_footer.php");?>

<script src="lib/chart/canvasjs.min.js"></script>
