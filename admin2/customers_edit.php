<?php 
	require("header.php");
	require("navbar.php");

	if(isset($_POST['upDate'])){	
		$cid 	   = $_POST['cid'];
		$fullname  = $_POST['fullname'];
		$position  = $_POST['position'];
		$address   = $_POST['address'];
		$phone 	   = $_POST['phone'];
		$testimony = $_POST['testimony'];

	$update = $link->query("UPDATE customers set
		cid  	  = '$cid',
		fullname  = '$fullname',
		position  = '$position',
		address   = '$address',
		phone 	  = '$phone',
		testimony = '$testimony' where cid = '$cid'");

		if(($update)== TRUE){
			header("location:customers_edit.php?customers=$cid");
		}
	}		

	$cust="";
	if($_GET["customers"]!="")
		$cust=" and cid='".$_GET["customers"]."' ";
												
	$ex = $link->query("select * from customers where cid=cid $cust order by cid limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from customers t where t.cid='$rs[0]' and t.cid=t.cid ");

	while($rs = mysqli_fetch_array($ex)){	

	if(isset($_POST["b_upImg_$rs[0]"])){
		move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "../img/customers/$rs[0].jpg");
		$link->query("update customers set photo_id=1 where cid='$rs[0]'");
		jump("");

		$origFile="../img/customers/$rs[0].jpg";
		$destFile="../img/customers/resized/$rs[0].jpg";
					
		$source = imagecreatefromjpeg($origFile);
		list($width, $height) = getimagesize($origFile);

		$newWidth = 300;
		$newHeight = 300;

		$thumb = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		imagejpeg($thumb, $destFile, 80);
	}					
?>
	
<div class="content-wrapper">
	<h2>Edit Customer &nbsp; 
		<a href='customers.php' title='Back' class='btn btn-sm btn-outline-info'> 
			<i class='mdi mdi-arrow-left'></i>Back
		</a>
	</h2> 
	
	<form action="#" method="POST" enctype="multipart/form-data">
	
	<div class="row">	
		<div class="col-lg-3">
			<div class="card">
				<div class="card-body">	
				<h4 class="card-title">Customer Photo</h4>				
					<div class="text-center">
					<?php
						echo"<img style='border-radius:5px;width:100%' ";
						if(file_exists("../img/customers/resized/$rs[0].jpg")){			
							echo" src='../img/customers/resized/$rs[0].jpg?".date("h:i:s")."' />";
						}else{
							echo" src='../img/user.png?".date("h:i:s")."' />";
						}
					?>
					</div>
					<div class="form-group">
						<span class="form-control btn btn-outline-info btn-block" style="margin-top:10px;margin-bottom:-5px">
							Customer ID Number: <?php echo $rs["cid"];?>
						</span>
					</div>
					<div class="form-group" style="margin-bottom:-8px">
					<?php 
						echo"
							<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
							<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
							<input class='btn btn-outline-info btn-block' value='Change Photo' onclick=\"$('#b_file_$rs[0]').click();\"/>
						";
					?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card">
				<div class="card-body" style="color:#bbb">
					<h4 class="card-title">Update Form</h4>
					<div class="form-group">
						<input 
							name="cid" 
							type="hidden" 
							class="form-control bg-dark text-secondary" 
							value="<?php echo $rs["cid"];?>" 
							readonly
						>
					</div>
					<div class="form-group">				
						<label for="fullname">Full Name</label>
						<input type="text" 
							name="fullname" 
							class="form-control bg-dark text-secondary" 
							value="<?php echo $rs["fullname"];?>" 
							required 
						>
					</div>	
					<div class="form-group">								
						<label for="position">Position</label>
						<input 
							type="text" 
							name="position" 
							class="form-control bg-dark text-secondary" 
							value="<?php echo $rs["position"];?>" 
							required
						>
					</div>	
					<div class="form-group">								
						<label for="address">Address</label>
						<input 	
							type="text" 
							name="address" 
							class="form-control bg-dark text-secondary" 
							value="<?php echo $rs["address"];?>" 
							required 
						>
					</div>
					<div class="form-group">								
						<label for="phone">Phone Number</label>
						<input 
							type="text" 
							name="phone" 
							class="form-control bg-dark text-secondary" 
							value="<?php echo $rs["phone"];?>" 
							required 
						>
					</div>
					<div class="form-group">								
						<label for="testimony">Testimony</label>
						<input 
							type="text" 
							name="testimony" 
							class="form-control bg-dark text-secondary" 
							value="<?php echo $rs["testimony"];?>" 
						>
					</div>
					<div style="margin:20px 0 -10px 0">
						<input class='btn btn-outline-info btn-block' type="SUBMIT" name="upDate" value="Save & Update" style="padding:8px">
					</div>
				</div>
			</div>
		</div>
<?php 
		}		
	}			
?>			
	
		<div class="col-lg-5">
			<div class="card">
				<div class="card-body">		
				<h4 class="card-title">Customers List</h4>									
					<div class="table-responsive" style="height:420px">	
						<table class="table table-dark table-hover">
							<thead class="bg-dark">
								<tr>
									<th>#</th>
									<th>Pic</th>
									<th>Name</th>
								<!--<th>Position</th>-->
									<th>Address</th>
									<th>Phone</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$i=1;
								$ex=$link->query("SELECT * FROM customers ORDER BY cid");
								while($rs=mysqli_fetch_array($ex)){
								  echo"
									<tr onClick=\"jump('customers_edit.php?customers=$rs[0]')\" style='cursor:pointer'>
										<td>$i</td>
										<td style='padding:0 0 0 10px;margin:0 0 0 0;'>
										<img style='height:30px;width:30px;border-radius:5px;padding:0;margin:0' ";
											if(file_exists("../img/customers/resized/$rs[0].jpg")){			
												echo" src='../img/customers/resized/$rs[0].jpg? ".date("h:i:s")." ' />";
											}else{
												echo" src='../img/user.png' />";
											}

										echo"
										
										</td>
										<td>".$rs["fullname"]."</td>
									<!--<td>".$rs["position"]."</td>-->
										<td>".$rs["address"]."</td>
										<td>".$rs["phone"]."</td>
									</tr>
								  ";
								$i++;
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
