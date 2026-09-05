<?php 
	require("header.php");
	require("navbar.php");
?>

<div class="content-wrapper">
	<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> About &nbsp; <button class="btn btn-outline-primary" onClick="jump('about_add.php')">Add</button></h3>
	<form action='#' method='POST' enctype='multipart/form-data'>

	<div class="row">

	<?php
		$ex=$link->query("SELECT * FROM about ORDER by asid") or die (mysqli_error($link));		

		while($rs=mysqli_fetch_array($ex)){	
					
		$icon=$rs["icon"];
					
		echo"
			<div class='col-xl-4 col-sm-12 grid-margin stretch-card' id='div_$rs[0]'>
				<div class='card'>
					<div class='card-body'>
						<div class='row'>
							<div class='col-12'>
								<div class='text-center' style='font-size:80px'>
									<i class='$icon text-primary'></i>
								</div>									
								<div class='row'>
									<div class='col-lg-6'>
										<input class='btn btn-outline-primary btn-block' onclick=\"jump('about_edit.php?about=$rs[0]')\" value='Edit'>
									</div>
									<div class='col-lg-6'>	
										<input class='btn btn-outline-primary btn-block' onclick=\"aboutDelete('$rs[0]');\" value='Delete'>
									</div>											
								</div><br>
								<div class='text-center bg-dark border-primary' style='padding:20px'>
									<h4 class='fw-bold mb-0'>".$rs["title"]."</h4>
									<small>".$rs["description"]."</small>
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
	function aboutDelete(asid){	
		if(confirm("Are you sure you want to Remove this About?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#div_"+asid).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#div_"+asid).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","../admin_about_delete.php?asid="+asid,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("footer.php");?>
