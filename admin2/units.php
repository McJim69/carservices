<?php 
	require("header.php");
	require("navbar.php");
?>

<div class="content-wrapper">
	<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> Units &nbsp; <button class="btn btn-outline-primary" onClick="jump('units_add.php')">Add</button></h3>
	<form action='#' method='POST' enctype='multipart/form-data'>

	<div class="row">

	<?php
		$ex=$link->query("SELECT * FROM units");
							
		while($rs=mysqli_fetch_array($ex)){	
					
		$title = $rs["unit_name"];
		$udesc = $rs["description"];
					
		echo"
			<div class='col-xl-2 col-sm-4 grid-margin stretch-card' id='div_$rs[0]'>
				<div class='card'>
					<div class='card-body'>
						<div class='col-12 text-center'>
							<div class='row'>
								<div class='col-lg-12'>
									<img src='../img/units.png' class='img-fluid'>
								</div>
							</div>
							<div class='row'>
								<div class='col-lg-12'>
									<h5 class='text-uppercase fw-bold mb-0 text-secondary'>$title -
										<x class='text-capitalize'>$udesc</x>
									</h5>
								</div>
							</div>
							<div class='row'>
								<div class='col-lg-12' style='margin-top:15px'>
									<div class='row'>
										<div class='col-lg-6'>
											<input onclick=\"jump('units_edit.php?units=$rs[0]');\" class='btn btn-outline-primary btn-sm btn-block' value='Edit'>
										</div>
										<div class='col-lg-6'>
											<input onclick=\"deleteUnit('$rs[0]');\" class='btn btn-outline-primary btn-sm btn-block' value='Delete'>								
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				";
			}
		?>

	</div>
</form>
	
</div>

<script>
	function deleteUnit(unit_id){	
		if(confirm("Are you sure you want to Remove this Unit?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#div_"+unit_id).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#div_"+unit_id).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","../admin_units_delete.php?unit_id="+unit_id,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("footer.php");?>
