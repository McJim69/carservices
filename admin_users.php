<?php
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");	
?>

<script> setActive("system"); </script>
<script> setActive("users"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">System Users</h1>
				<button style="margin:5px;width:100px" onClick="history.back()" type="button" class="btn btn-primary">
					<i class="fa fa-arrow-left"></i> Back
				</button>
				<button style="margin:5px;width:100px" onClick="jump('admin_users_add.php')" class="btn btn-primary">
					<i class="fa fa-plus"></i> Add
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
				$ex=$link->query("SELECT * FROM users ORDER by usrid") or die (mysqli_error($link));		

				while($rs=mysqli_fetch_array($ex)){	
				
				if(isset($_POST["b_upImg_$rs[0]"])){
					move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "img/users/$rs[0].jpg");
					$link->query("update users set photo=1 where usrid='$rs[0]'");
					jump("");

					$origFile="img/users/$rs[0].jpg";
					$destFile="img/users/resized/$rs[0].jpg";
					
					$source = imagecreatefromjpeg($origFile);
					list($width, $height) = getimagesize($origFile);

					$newWidth  = 300;
					$newHeight = 300;

					$thumb = imagecreatetruecolor($newWidth, $newHeight);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
					imagejpeg($thumb, $destFile, 80);
				}						
				
				echo"
					<div class='col-lg-3 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>
						<div class='team-item'>
							<div class='position-relative overflow-hidden'>
								<img class='img-fluid bg-light'  alt='' width='100%' ";
									if(file_exists("img/users/resized/$rs[0].jpg")){			
										echo" src='img/users/resized/$rs[0].jpg?".date('h:i:s')."' />";
									}else{
										echo" src='img/user.png?".date('h:i:s')."' />";
									}
								echo"
								<div class='team-overlay position-absolute start-0 top-0 w-100 h-100'>
									<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
									<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
									<input class='btn btn-light' value='Pic' style='width:70px' onclick=\"$('#b_file_$rs[0]').click();\"/> &nbsp; &nbsp;
									<a  href='admin_users_edit.php?users=$rs[0]'>
									<input class='btn btn-light' value='Edit' style='width:70px'></a> &nbsp; &nbsp;
									<input onclick=\"deleteUser('$rs[0]');\" class='btn btn-light' value='Del' style='width:70px'>
								</div>
							</div>
							<div class='bg-light text-center p-4'>
								<h5 class='fw-bold mb-0'>".$rs["fname"]." ".$rs["lname"]."</h5>
								<small>".$rs["account"]."</small>
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
	function deleteUser(usrid){	
		if(confirm("Are you sure you want to Remove this User?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#div_"+usrid).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#div_"+usrid).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","admin_users_delete.php?usrid="+usrid,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("admin_footer.php");?>