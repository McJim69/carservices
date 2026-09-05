<?php
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");

	if(!isset($_SESSION['user'])){
		header("location:admin_login.php");
	}	
?>

<script> setActive("system"); </script>
<script> setActive("downloads"); </script>

<!-- Facebox Modal -->	
<link href="facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<script src="facebox/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $('a[rel*=facebox]').facebox({
		loadingImage : 'facebox/loading.gif',
		closeImage   : 'facebox/closelabel.png'
	  })
	})
</script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Downloadables</h1>
				<button onclick="jump('javascript.history.back();')" class="btn btn-primary" style="width:120px">
					<i class="fa fa-arrow-left"></i> Back
				</button>
				<a rel="facebox" href="admin_uploads.php" >
				<button class="btn btn-primary" style="width:120px">
					<i class="fa fa-upload"></i> Upload
				</button>
				</a>
				<a href="download/" >
				<button class="btn btn-primary" style="width:120px">
					<i class="fa fa-list"></i> ListView
				</button>
				</a>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<!-- Downloads Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4" style="min-height:200px;margin-top:-70px">
				<?php
					$ex=$link->query("SELECT * FROM downloads ORDER BY did");
					while($rs=mysqli_fetch_array($ex)){
					$file=$rs["filename"];
					$filename=preg_replace("/\\.[^.\\s]{3,4}$/", "", $file);

					echo"
						<div class='col-lg-3 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>				
							<div class='box-item'>
								<div class='position-relative overflow-hidden'>
									<img src='img/download_now.png' class='img-fluid bg-light' alt='Download' width='100%' style='padding:50px'>
									<div class='box-overlay' style='position:absolute; top:65px;left:0;right:0'>                               
										<a href='download/$file'>
										<button class='btn'><i class='fa fa-download'></i> Download
										</button>
										</a>
									</div>
									<div class='box-overlay' style='position:absolute; top:110px;left:0;right:0'> 
										<button onclick=\"deleteFile('$rs[0]');\" class='btn'><i class='fa fa-trash'></i> Delete</button>								
									</div>
								</div>
								<div class='bg-light text-center p-4'>
									<h5 class='fw-bold mb-0 text-capitalize'>$filename</h5>
									<small>$file</small>
								</div>
							</div>					
						</div>";
					} 
				?>
            </div>
        </div>
    </div>
<!-- Downloads End -->

<script type="text/javascript">
	function deleteFile(did){	
		if(confirm("Are you sure you want to Remove this File?")){
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#div_"+did).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#div_"+did).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","admin_downloads_delete.php?did="+did,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("admin_footer.php"); ?>

