<?php
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");	
?>

<script> setActive("gallery"); </script>
<script> setActive("videos"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center" style="margin-top:-20px;margin-bottom:-20px">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Galleries</h1>
				<h2>
					<button onclick="jump('admin_pictures.php')" class="btn btn-primary" style="width:150px;margin:5px">
						<i class="fa fa-image"></i> Photos
					</button>
					<button onclick="jump('admin_pictures_add.php')" class="btn btn-primary" style="width:150px;margin:5px">
						<i class="fa fa-plus"></i> Add Photo
					</button>						
					<button onclick="jump('admin_videos.php')" class="btn btn-primary" style="width:150px;margin:5px">
						<i class="fa fa-play"></i> Videos
					</button>
					<button onclick="jump('admin_videos_add.php')" class="btn btn-primary" style="width:150px;margin:5px">
						<i class="fa fa-plus"></i> Add Video
					</button>
				</h2>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<form action='#' method='POST' enctype='multipart/form-data'>
    <div class="container-xxl py-5">
        <div class="container">
            <div class='row g-4' style='margin-top:-70px' >

			<?php
				$ex=$link->query("SELECT * FROM videos ORDER by vid") or die (mysqli_error($link));		

				while($rs=mysqli_fetch_array($ex)){	

				$src = $rs["source"];
				$yid = trim($src,"https://www.youtube.com/watch?v=");
				$img = "https://img.youtube.com/vi/$yid/hqdefault.jpg";
				
				echo"
					<div class='col-lg-3 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>
						<div class='team-item'>
							<div class='position-relative overflow-hidden bg-light'>
								<img class='img-fluid' width='100%' src='$img' alt='Youtube'/>
								<div class='team-overlay position-absolute start-0 top-0 w-100 h-100' >								
									<a id='vlink' href='$src' class='venobox play-btn' data-vbtype='video' data-autoplay='true'>
									<input class='btn btn-light' value='Play' style='width:70px;margin:5px'></a>
									<a  href='admin_videos_edit.php?videos=$rs[0]'>
									<input class='btn btn-light' value='Edit' style='width:70px;margin:5px'></a>
									<input onclick=\"vidDelete('$rs[0]');\" class='btn btn-light' value='Del' style='width:70px;margin:5px'>
								</div>
							</div>
							<div class='text-center p-4 bg-primary'>
								<h5 class='text-light fw-bold mb-0 text-uppercase'>".$rs["title"]."</h5>
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
	function vidDelete(vid){	
		if(confirm("Are you sure you want to Remove this Video?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#div_"+vid).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#div_"+vid).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","admin_videos_delete.php?vid="+vid,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("admin_footer.php");?>