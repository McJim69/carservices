<?php 
	require("header.php");
	require("navbar.php");
?>

<div class="content-wrapper">
	<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> Services &nbsp; <button class="btn btn-outline-primary" onClick="jump('services_add.php')">Add</button></h3>
	<form action='#' method='POST' enctype='multipart/form-data'>

	<div class="row">

	<?php
		$ex=$link->query("SELECT * FROM services ORDER by service_idno") or die (mysqli_error($link));		

		while($rs=mysqli_fetch_array($ex)){	
					
		$icon=$rs["service_font"];
					
		echo"
			<div class='col-xl-3 col-sm-6 grid-margin stretch-card' id='div_$rs[0]'>
				<div class='card'>
					<div class='card-body'>
						<div class='col-12'>
							<div class='text-center' style='font-size:80px'>
								<i class='$icon text-primary'>&nbsp;</i>
							</div>									
							<div class='text-center' >								
								<input onclick=\"jump('services_edit.php?services=$rs[0]');\" class='btn btn-outline-primary' value='Edit' style='width:120px'> &nbsp; &nbsp; &nbsp;
								<input onclick=\"serveDelete('$rs[0]');\" class='btn btn-outline-primary' value='Delete' style='width:120px'>
							</div><br>
							<div class='text-center'>
								<h4 class='fw-bold mb-0'>".$rs["service_name"]."</h4>
								<small>".$rs["service_qlty"].", ".$rs["service_expt"].", ".$rs["service_mdrn"]." </small>
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
	function serveDelete(service_idno){	
		if(confirm("Are you sure you want to Remove this Services?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#div_"+service_idno).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#div_"+service_idno).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","../admin_services_delete.php?service_idno="+service_idno,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("footer.php");?>
