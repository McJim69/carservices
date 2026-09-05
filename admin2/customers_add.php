<?php 
	require("header.php");
	require("navbar.php");

	$rqry = $link->query("SELECT MAX(cid) FROM customers");
	$resu = $rqry->fetch_array();
	$rsid = $resu[0]+1;

	if(isset($_POST["submit"])){	

	$name = $_POST["fullname"];
	
	$insert = $link->query("INSERT INTO  customers VALUES (
		'".$rsid."',
		'".$_POST["fullname"]."',
		'".$_POST["position"]."',
		'".$_POST["address"]."',
		'".$_POST["phone"]."',
		'".$_POST["testimony"]."',0)");

		if(($insert)== TRUE){
			
			echo'
			<script type="text/javascript">
				swal({
				  title: "Success!",
				  text: "Customer '.$name.' added successfully!",
				  type: "success"
				}).then(function() {
					window.location.href = "customers_edit.php?customers='.$rsid.'";
				})
			</script>';
			
		}else{
			
			$error = mysqli_error($link);
			echo'
			<script type="text/javascript">
				jQuery(function validation(){
					swal("ERROR!", "'.$error.'", "warning", {
						button: "Retry",
					});
				});
			</script>';
		}
	}
?>

<div class="content-wrapper">
	<h2>Add Customer &nbsp; 
		<a href='customers.php' title='Back' class='btn btn-sm btn-outline-info'> 
			<i class='mdi mdi-arrow-left'></i>Back
		</a>
	</h2> 
	<div class="row">	
		<div class="col-lg-3">
			<div class="card">
				<div class="card-body">	
				<h4 class="card-title">Customer Photo</h4>				
					<div class="text-center">
						<img style="width:100%" 
						src="../img/user.png" />
					</div>
					<div class="form-group">
						<span class="form-control btn btn-outline-info btn-block" style="margin-top:5px;margin-bottom:-5px">
							Customer Number: <?php echo $cid;?>
						</span>
					</div>
					<div class="form-group" style="margin-bottom:-8px">
						<input class="form-control btn btn-outline-info btn-block" value="Change Photo Later" onclick="$('#b_file_$cid').click();"/>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card">
				<div class="card-body" style="color:#bbb">
					<h4 class="card-title">Customer Submit Form</h4>
					<form action="#" method="POST" enctype="multipart/form-data">
					<div class="form-group">				
						<label for="fullname">Full Name</label>
						<input type="text" class="form-control bg-dark text-secondary" name="fullname" placeholder="Full Name" required >
					</div>	
					<div class="form-group">								
						<label for="position">Position</label>
						<input type="text" class="form-control bg-dark text-secondary" name="position" placeholder="Position" required >
					</div>	
					<div class="form-group">								
						<label for="address">Address</label>
						<input type="text" class="form-control bg-dark text-secondary" name="address" placeholder="Address" required >
					</div>
					<div class="form-group">								
						<label for="phone">Phone Number</label>
						<input type="text" class="form-control bg-dark text-secondary" name="phone" placeholder="Phone Number" required >
					</div>
					<div class="form-group">								
						<label for="testimony">Testimony</label>
						<input type="text" class="form-control bg-dark text-secondary" name="testimony" placeholder="Testimony">
					</div>
					<div class="form-group" style="margin-bottom:-10px">
						<button class="form-control btn btn-outline-info btn-block" type="SUBMIT" name="submit">Submit</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	
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
									<th>Position</th>
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
									<tr onClick=\"jump('customers_edit.php?customers=$rs[0]')\">
										<td>$i</td>
										<td style='padding:0 0 0 10px;margin:0 0 0 0;'>
										<img style='height:30px;width:30px;border-radius:50%;padding:0;margin:0' ";
											if(file_exists("../img/customers/resized/$rs[0].jpg")){			
												echo" src='../img/customers/resized/$rs[0].jpg? ".date("h:i:s")." ' />";
											}else{
												echo" src='../img/user.png' />";
											}

											echo"
										
										</td>
										<td>".$rs["fullname"]."</td>
										<td>".$rs["position"]."</td>
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
</div>

<?php require("footer.php");?>
