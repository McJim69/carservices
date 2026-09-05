<?php
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");	
?>

<script> setActive("system"); </script>
<script> setActive("webmode"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Website Modes</h1>
				<button style="margin:5px;width:100px" onClick="history.back()" type="button" class="btn btn-primary">
					<i class="fa fa-arrow-left"></i> Back 
				</button>
				<button style="margin:5px;width:100px" onClick="jump('admin_webmode_add.php')" type="button" class="btn btn-primary">
					<i class="fa fa-plus"></i> Add 
				</button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<!-- site_mode List Start -->
<form action='#' method='POST' enctype='multipart/form-data'>
    <div class="container-xxl py-5" style="min-height:220px">
        <div class="container">
            <div class='row g-4' style='margin-top:-70px' >
				<?php
					$ex=$link->query("SELECT * FROM site_mode ORDER by mode_id") or die (mysqli_error($link));		

					while($rs=mysqli_fetch_array($ex)){	
					
					$icon=$rs["fonticon"];
					
						echo"
							<div class='col-lg-3 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>
								<div class='team-item'>
									<div class='bg-light position-relative overflow-hidden'>
										<div class='text-center' style='font-size:50px'>
											<i class='$icon text-primary'>&nbsp;</i>
										</div>									
										<div class='team-overlay position-absolute start-0 top-0 w-100 h-100' >								
											<a href='admin_webmode_edit.php?site_mode=$rs[0]'>
											<input class='btn btn-light' value='Edit' style='width:120px'></a> &nbsp; &nbsp; &nbsp;
											<input onclick=\"deleteMode('$rs[0]');\" class='btn btn-light' value='Delete' style='width:120px'>
										</div>
									</div>
									<div class='bg-light text-center p-2'>
										<h5 class='fw-bold mb-0'>".$rs["mode_name"]."</h5>
										<small>".$rs["description"]."</small>
									</div>
								</div>
							</div>
						";
					}
				?>
            </div>
        </div>
    </div>
</form>
<!-- Page Header End -->

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
			xmlhttp.open("GET","admin_webmode_delete.php?mode_id="+mode_id,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("admin_footer.php"); ?>
