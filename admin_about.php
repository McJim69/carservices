<?php
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");	
?>

<script> setActive("system"); </script>
<script> setActive("about"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">About Us</h1>
				<button style="margin:5px;width:100px" onClick="history.back()" type="button" class="btn btn-primary">
					<i class="fa fa-arrow-left"></i> Back 
				</button>
				<button style="margin:5px;width:100px" onClick="jump('admin_about_add.php')" type="button" class="btn btn-primary">
					<i class="fa fa-plus"></i> Add 
				</button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<!-- about List Start -->
<form action='#' method='POST' enctype='multipart/form-data'>
    <div class="container-xxl py-5" style="min-height:220px">
        <div class="container">
            <div class='row g-4' style='margin-top:-70px' >
				<?php
					$ex=$link->query("SELECT * FROM about ORDER by asid") or die (mysqli_error($link));		

					while($rs=mysqli_fetch_array($ex)){	
					
					$icon=$rs["icon"];
					
						echo"
							<div class='col-lg-4 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>
								<div class='team-item'>
									<div class='bg-light position-relative overflow-hidden'>
										<div class='text-center' style='font-size:50px'>
											<i class='$icon text-primary'>&nbsp;</i>
										</div>									
										<div class='team-overlay position-absolute start-0 top-0 w-100 h-100' >								
											<a href='admin_about_edit.php?about=$rs[0]'>
											<input class='btn btn-light' value='Edit' style='width:120px'></a> &nbsp; &nbsp; &nbsp;
											<input onclick=\"aboutDelete('$rs[0]');\" class='btn btn-light' value='Delete' style='width:120px'>
										</div>
									</div>
									<div class='bg-light text-center p-2'>
										<h5 class='fw-bold mb-0'>".$rs["title"]."</h5>
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
			xmlhttp.open("GET","admin_about_delete.php?asid="+asid,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("admin_footer.php"); ?>
