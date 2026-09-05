<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");	

	if(isset($_POST['upDate'])){	
		$serv_id     = $_POST['serv_id'];
		$user_id     = $_POST['user_id'];
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
		user_id 	 = '$user_id',
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

		if(($update)== TRUE){
			echo"<script>window.location.href='admin_transactions_details.php?transactions=$serv_id';</script>";
		}else{
			echo mysqli_error($link);
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

<script> setActive("transactions"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Update Transaction</h1>
				<button onClick="history.back()" class="btn btn-primary">
					<i class="fa fa-arrow-left"></i> Back
				</button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<form action='#' method='POST' enctype='multipart/form-data'>
	<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
		<div class="container text-center" style="margin-top:-50px">

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
					<div class='row justify-content-center'>
						<div class='col-lg-7' style='border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;'>
						  <h2 class='text-primary' style='margin-top:20px'>Job Order $tids</h2>
							<div class='row'>
								<div class='col-lg-4 form-group mt-3'>
									<div class='bg-light text-center'>
										<img style='border-radius:4px;border:1px solid #bbb;width:100%;background:#fff;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;' ";
											if(file_exists("img/transactions/resized/$rs[0].jpg")){			
												echo" src='img/transactions/resized/$rs[0].jpg? ".date("h:i:s")." ' />";
											}else{
												echo" src='img/aircon-parts.jpg' style='opacity:.5' />";
											}

										echo"
									</div>
								</div>
								<div class='col-lg-4 form-group mt-3'>
									<div class='form-floating'>
										<input type='hidden' name='serv_id' value='$rs[0]' />
										<input type='hidden' name='user_id' value='".$rs["user_id"]."' />
										<input style='margin-bottom:4px' type='date' onfocus=\"(this. type='date')\" class='form-control' name='serv_date' value='".$rs["serv_date"]."' required >
										<label for='serv_date'>Service Date</label>
									</div>
									<div class='form-floating'>
										<select style='background:#fff;margin:0 0 4px 0' type='text' class='form-control' name='serv_categ' required >
											<option value='".$rs["serv_categ"]."'>".$rs["serv_categ"]."</option>
												".fill_categories($pdo)."
										</select>
										<label for='serv_categ'>Service categories</label>
									</div>
									<div class='form-floating'>
										<select style='background:#fff;margin:0 0 4px 0' type='text' class='form-control' name='serv_client' required >
											<option value='".$rs["serv_client"]."'>".$rs["serv_client"]."</option>
												".fill_client($pdo)."
										</select>
										<label for='serv_client'>Customer</label>
									</div>
									<div class='form-floating'>
										<select style='background:#fff;margin:0 0 4px 0' type='text' class='form-control' name='unit_make' required >
											<option value='".$rs["unit_make"]."'>".$rs["unit_make"]."</option>
												".fill_brand($pdo)."
										</select>
										<label for='unit_make'>Unit Make</label>
									</div>
									<div class='form-floating'>
										<input style='margin:0 0 4px 0' type='text' class='form-control' name='unit_model' value='".$rs["unit_model"]."' placeholder='Unit Model' required >
										<label for='unit_model'>Unit Model</label>
									</div>
								</div>
								<div class='col-lg-4 form-group mt-3'>
									<div class='form-floating'>
										<textarea style='margin:0 0 4px 0' type='text' rows='2' class='form-control' name='serv_desc' placeholder='Service Description' required >".$rs["serv_desc"]."</textarea>
										<label for='serv_desc'>Service Description</label>
									</div>
									<div class='form-floating'>
										<select style='background:#fff;margin:0 0 4px 0' type='text' class='form-control' name='technician' required >
											<option value='".$rs["technician"]."'>".$rs["technician"]."</option>
											".fill_tech($pdo)."
										</select>
										<label for='technician'>Technician</label>
									</div>
									<div class='form-floating'>
										<input style='margin:0 0 4px 0' type='number=' class='form-control' name='labor_cost' value='".$rs["labor_cost"]."' required >
										<label for='labor_cost'>Labor Cost</label>
									</div>
									<div class='form-floating'>
										<select style='background:#fff;margin:0 0 4px 0' type='text' class='form-control' name='payment' required >
											<option value='".$rs["payment"]."'>".$rs["payment"]."</option>
											<option value='Paid'>Paid</option>
											<option value='Pending'>Pending</option>
											<option value='Collectable'>Collectable</option>
										</select>
										<label for='payment'>Payment Status</label>
									</div>
									<div class='form-floating'>
										<input style='margin:0 0 4px 0' type='text' class='form-control' name='remarks' value='".$rs["remarks"]."' placeholder='Remarks'>
										<label for='remarks'>Remarks</label>
									</div>
								</div>	
							</div>
							<div class='row text-center'>
								<div class='col' style='margin:20px'>	
									<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
									<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
									<input type='button' class='btn btn-primary rounded-pill' value='Change Photo' style='width:200px;' onclick=\"$('#b_file_$rs[0]').click();\"/> &nbsp;
									<button style='width:200px;margin:5px' type='SUBMIT' class='btn btn-primary rounded-pill' name='upDate'>Save & Update</button>
								</div>
							</div> 
						</div> 
					</div>
					
					";
				}		
			}			
		?>			
		</div>
	</div>
</form>

<?php require("admin_footer.php");?>