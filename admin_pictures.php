<?php
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");	
?>

<script> setActive("gallery"); </script>
<script> setActive("photos"); </script>

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
    <div class="container-xxl py-5" style="min-height:220px">
        <div class="container">
            <div class='row g-4' style='margin-top:-70px' >

			<?php
				$ex=$link->query("SELECT * FROM pictures ORDER by picid") or die (mysqli_error($link));		

				while($rs=mysqli_fetch_array($ex)){	

				if(isset($_POST["b_upImg_$rs[0]"])){
					move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "img/pictures/$rs[0].jpg");
					$link->query("update pictures set photo=1 where picid='$rs[0]'");
					jump("");

					$origFile="img/pictures/$rs[0].jpg";
					$destFile="img/pictures/resized/$rs[0].jpg";
					
					$source = imagecreatefromjpeg($origFile);
					list($width, $height) = getimagesize($origFile);

					$newWidth = 384;
					$newHeight = 512;

					$thumb = imagecreatetruecolor($newWidth, $newHeight);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
					imagejpeg($thumb, $destFile, 80);
				}						
								
				echo"
					<div class='col-lg-2 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>
						<div class='team-item border border-light'>
							<div class='position-relative overflow-hidden bg-light'>
								<img class='img-fluid' width='100%' ";
								
									if(file_exists("img/pictures/resized/$rs[0].jpg")){			
										echo" src='img/pictures/resized/$rs[0].jpg?".date("h:i:s")."' />";
									}else{
										echo" src='img/pictures.png?".date("h:i:s")."' />";
									}
								
								echo"
								
								<div class='team-overlay position-absolute start-0 top-0 w-100 h-100' >								
									<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
									<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
									<input class='btn btn-light' value='Pic' style='width:55px;padding:2px' onclick=\"$('#b_file_$rs[0]').click();\"/> &nbsp;
									<a  href='admin_pictures_edit.php?pictures=$rs[0]'>
									<input class='btn btn-light' value='Edit' style='width:55px;padding:2px'></a> &nbsp;
									<input onclick=\"picDelete('$rs[0]');\" class='btn btn-light' value='Del' style='width:55px;padding:2px'>
								</div>
							</div>
							<div class='text-center p-4 bg-light'>
								<h5 class='fw-bold mb-0 text-uppercase'>".$rs["title"]." $rs[0]</h5>
								<small>".$rs["description"]." $rs[0]</small>
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
	function picDelete(picid){	
		if(confirm("Are you sure you want to Remove this Picture?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#div_"+picid).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#div_"+picid).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","admin_pictures_delete.php?picid="+picid,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("admin_footer.php"); ?>
