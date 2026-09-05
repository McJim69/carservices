<?php 
	require("header.php");
	require("navbar.php");
	
	if(isset($_POST['upDate'])){	
		$tid 	  = $_POST['tech_id'];
		$fullname = $_POST['fullname'];
		$position = $_POST['position'];
		$facebook = $_POST['facebook'];
		$mobphone = $_POST['mobphone'];

	$update = $link->query("UPDATE technicians set
		tech_id  = '$tid',
		fullname = '$fullname',
		position = '$position',
		facebook = '$facebook',
		mobphone = '$mobphone' where tech_id = '$tid'");

		if(($update)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>

<?php	
	$technicians="";
	if($_GET["technicians"]!="")
		$technicians=" and tech_id='".$_GET["technicians"]."' ";
												
	$ex = $link->query("select * from technicians where tech_id=tech_id $technicians order by tech_id limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from technicians u where u.tech_id='$rs[0]' and u.tech_id=u.tech_id ");
	$ii=1;

	while($rs = mysqli_fetch_array($ex)){	
	$name="".$rs["fname"]." ".$rs["lname"]."";
	$usid=$rs[0];

	if(isset($_POST["b_upImg_$rs[0]"])){
		move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "../img/technicians/$rs[0].jpg");
		$link->query("update technicians set photo=1 where cid='$rs[0]'");
		jump("");

		$origFile="../img/technicians/$rs[0].jpg";
		$destFile="../img/technicians/resized/$rs[0].jpg";
					
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
	<h2>Edit Technician &nbsp; 
		<a href='technicians.php' title='Back' class='btn btn-sm btn-outline-info'> 
			<i class='mdi mdi-arrow-left'></i>Back
		</a>
		<a href='technicians_edit.php' title='Refresh' class='btn btn-sm btn-outline-info'>
			<i class='mdi mdi-magnify'></i>Refresh
		</a>
	</h2> 
	<div class="row">	
		<div class="col-lg-3">
			<div class="card">
				<div class="card-body">	
				<h4>Technician ID No. <?php echo $rs[0];?></h4>				
					<div class="text-center">
					<?php
						echo"
						<img style='width:100%;border-radius:4px' ";
						if(file_exists("../img/technicians/resized/$rs[0].jpg")){			
							echo" src='../img/technicians/resized/$rs[0].jpg? ".date("h:i:s")." ' />";
						}else{
							echo" src='../img/user.png' style='opacity:.5' />";
						}					
					?>
					</div>
					<form action="#" method="POST" enctype="multipart/form-data">
						<div class="form-group" style="margin-bottom:-5px">
							<?php
							  echo"
								<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
								<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
								<input class='form-control btn btn-outline-info btn-block' value='Change Photo' onclick=\"$('#b_file_$rs[0]').click();\"/>
							  ";
							?>
						</div>
					</form>	
				</div>
			</div>
		</div>
		
	<!-- Submit Form Start-->
		<div class="col-lg-4">
			<div class="card">
				<div class="card-body" style="color:#bbb">
					<h4 class="card-title">Submit Form</h4>
					<div class='row'>
					<form action="#" method="POST" enctype="multipart/form-data">
						<div class='col-lg-12'>
							<div class='row'>
								<div class="col-lg-12 form-group" style="margin-top:12px">				
									<div>Full Name</div>
									<input 
										required 
										type="text" 
										name="fullname" 
										placeholder="First Name" 
										value="<?php echo $rs["fullname"];?>"
										class="form-control bg-dark text-secondary" 
									>
								</div>	
								<div class="col-lg-12 form-group">				
									<div>Position</div>
									<input 
										type="text" 
										name="position" 
										placeholder="Position" 
										value="<?php echo $rs["position"];?>"										
										class="form-control bg-dark text-secondary" 
									>
								</div>	
								<div class="col-lg-12 form-group">				
									<div>Phone Number</div>
									<input 
										required 
										type="text" 
										name="mobphone" 
										placeholder="Phone Number" 
										value="<?php echo $rs["mobphone"];?>"
										class="form-control bg-dark text-secondary" 
									>
								</div>	
								<div class="col-lg-12 form-group">				
									<div>Facebook</div>
									<input 
										required 
										type="text" 
										name="facebook" 
										placeholder="Facebook" 
										value="<?php echo $rs["facebook"];?>"										
										class="form-control bg-dark text-secondary" 
									>
								</div>	
								<div class="col-lg-12 form-group" style="margin-bottom:-5px">
									<button class="form-control btn btn-outline-info btn-block" type="SUBMIT" name="submit">Save & Update</button>
								</div>
							</div>
						</div>
					</form>	
					</div>	
				</div>
			</div>
		</div>

	<?php } } ?>		

<!-- Submit Form End -->
	
	<!-- technicians List Start -->
		<div class="col-lg-5">
			<div class="card">
				<div class="card-body">		
				<h4 class="card-title">Technicians List</h4>									
					<div class="table-responsive" style="height:358px">	
						<table class="table table-dark table-hover">
							<thead class="bg-dark">
								<tr>
									<th>#</th>
									<th>Pic</th>
									<th>Full Name</th>
									<th>Position</th>
									<th>Phone</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
							
								$i=1;
								$ex=$link->query("SELECT * FROM technicians ORDER BY tech_id");
								
								while($rs=mysqli_fetch_array($ex)){
								  echo"
									<tr onclick=\"jump('technicians_edit.php?technicians=$rs[0]')\">
										<td>$i</td>
										<td style='padding:0 0 0 10px;margin:0 0 0 0;'>
										<img style='height:30px;width:30px;border-radius:50%;padding:0;margin:0' ";
											if(file_exists("../img/technicians/resized/$rs[0].jpg")){			
												echo" src='../img/technicians/resized/$rs[0].jpg? ".date("h:i:s")." ' />";
											}else{
												echo" src='../img/user.png' />";
											}

											echo"
										
										</td>
										<td>".$rs["fullname"]." ".$rs["lname"]."</td>
										<td>".$rs["position"]."</td>
										<td>".$rs["mobphone"]."</td>
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
		<!-- technicians List End -->
	</div>
</div>

<?php require("footer.php");?>
