<?php
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");	
?>

<script> setActive("brand"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Manufacturers</h1>
				<button class="btn btn-primary" onClick="jump('admin_manufacturer_add.php')" style="width:150px;margin:5px"> 
					<i class="fa fa-plus"></i> Add Brand 
				</button>
				<button class="btn btn-primary" onClick="jump('admin_products.php')" style="width:150px;margin:5px">
					<i class="fa fa-eye"></i> Products 
				</button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<form action='#' method='POST' enctype='multipart/form-data'>
    <div class="container-xxl py-5" style="min-height:220px">
        <div class="container">
            <div class='row g-4' style='margin-top:-70px' >

			<?php
				$ex=$link->query("SELECT * FROM manufacturer ORDER by mfid") or die (mysqli_error($link));		

				while($rs=mysqli_fetch_array($ex)){	
								
				if(isset($_POST["b_upImg_$rs[0]"])){
					move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "img/manufacturer/$rs[0].png");
					$link->query("update manufacturer set logo=1 where mfid='$rs[0]'");
					jump("");
				}						
								
				echo"
					<div class='col-lg-3 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>
						<div class='team-item'>
							<div class='position-relative overflow-hidden bg-light'>
								<img class='img-fluid' width='100%' ";
								
									if(file_exists("img/manufacturer/$rs[0].png")){			
										echo" src='img/manufacturer/$rs[0].png?".date("h:i:s")."' />";
									}else{
										echo" src='img/brand.jpg?".date("h:i:s")."' />";
									}
								
								echo"
								
								<div class='team-overlay position-absolute start-0 top-0 w-100 h-100' >								
									<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
									<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
									<input class='btn btn-light' value='Logo' style='width:70px' onclick=\"$('#b_file_$rs[0]').click();\"/> &nbsp; &nbsp;
									<a href='admin_manufacturer_edit.php?manufacturer=$rs[0]'>
									<input class='btn btn-light' value='Edit' style='width:70px'></a> &nbsp; &nbsp;
									<input onclick=\"mfDelete('$rs[0]');\" class='btn btn-light' value='Del' style='width:70px'>
								</div>
							</div>
							<div class='text-center p-4 bg-light'>
								<h5 class='fw-bold mb-0 text-uppercase'>".$rs["name"]."</h5>
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

<script>
	function mfDelete(mfid){	
		if(confirm("Are you sure you want to Remove this Manufacturer?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#div_"+mfid).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#div_"+mfid).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","admin_manufacturer_delete.php?mfid="+mfid,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("admin_footer.php"); ?>
