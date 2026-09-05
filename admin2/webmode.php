<?php 
	require("header.php");
	require("navbar.php");
?>

<div class="content-wrapper">
	<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> Webmode &nbsp; <button class="btn btn-outline-primary" onClick="jump('webmode_add.php')">Add</button></h3>
	<form action='#' method='POST' enctype='multipart/form-data'>

	<div class="row">

	<?php
		$ex=$link->query("SELECT * FROM site_mode ORDER by mode_id") or die (mysqli_error($link));		

		while($rs=mysqli_fetch_array($ex)){	
					
		$icon=$rs["fonticon"];
					
		echo"
			<div class='col-xl-3 col-sm-6 grid-margin stretch-card' id='div_$rs[0]'>
				<div class='card'>
					<div class='card-body'>
						<div class='col-lg-12'>
							<div class='text-center' style='font-size:50px'>
								<i class='$icon text-primary'></i>
							</div>									
							<div class='row'>
								<div class='col-lg-12'>
									<div class='row'>
										<div class='col-lg-6'>
											<input onclick=\"jump('webmode_edit.php?site_mode=$rs[0]');\" class='btn btn-outline-primary btn-block' value='Edit'>
										</div>
										<div class='col-lg-6'>
											<input onclick=\"deleteMode('$rs[0]');\" class='btn btn-outline-primary btn-block' value='Delete'>
										</div>
									</div>
								</div>
							</div>
							<div class='text-center' style='margin: 20px 0 0 0'>
								<h5 class='fw-bold mb-0'>".$rs["mode_name"]."</h5>
								<small>".$rs["description"]."</small>
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
	function deleteMode(mode_id){	
		if(confirm("Are you sure you want to Remove this Site Mode?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#div_"+mode_id).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#div_"+mode_id).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","../admin_webmode_delete.php?mode_id="+mode_id,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("footer.php");?>
