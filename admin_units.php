<?php
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");		
?>

<script> setActive("system"); </script>
<script> setActive("units"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Measurement Units</h1>
				<button onclick="history.back()" class="btn btn-primary" style="width:100px">
					<i class="fa fa-arrow-left"></i> Back
				</button>
				<button onclick="jump('admin_units_add.php')" class="btn btn-primary" style="width:100px">
					<i class="fa fa-plus"></i> Add
				</button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<!-- Daschboard Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class='row g-4' style='margin-top:-70px'>

				<?php
					$ex=$link->query("SELECT * FROM units");
							
					while($rs=mysqli_fetch_array($ex)){	
					
					$title = $rs["unit_name"];
					$udesc = $rs["description"];
						
					echo"
					<div class='col-lg-2 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>
						<div class='team-item' style='background:#eee;border:1px solid #bbb;border-radius:5px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;'>
							<div class='bg-light position-relative overflow-hidden'>
								<img src='img/units.png' class='img-fluid' width='100%'>
								<div class='team-overlay position-absolute start-0 top-0 w-100 h-100' style='border-radius:3px;padding:-5px'>
									<a href='admin_units_edit.php?units=$rs[0]'>
									<input class='btn btn-light' value='Edit' style='width:75px'></a> &nbsp; &nbsp;
									<input onclick=\"deleteUnit('$rs[0]');\" class='btn btn-light' value='Del' style='width:75px'>								
								</div>
							</div>
							<div class='text-center' style='padding:5px'>
								<h5 class='text-uppercase fw-bold mb-0 text-secondary'>$title</h5>
								<small class='text-capitalize'>$udesc</small>
							</div>
						</div>
					</div> 
					
					";
					}
				?>
			</div>
        </div>
    </div>
<!-- Daschboard End -->

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
			xmlhttp.open("GET","admin_units_delete.php?unit_id="+unit_id,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("admin_footer.php"); ?>
