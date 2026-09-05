<?php 
	require("header.php");
	require("navbar.php");
?>

<style>
	.mother{
		position: relative;
	}
	.child{
		top: 50%;
		left: 50%;
		margin: 0;
		position: absolute;
		transform: translate(-50%, -50%);
	}
</style>

<div class="content-wrapper">
	<h3 class="card-title">Galleries <small><i class='fa fa-arrow-right'></i></small> Pictures &nbsp; <button class="btn btn-outline-primary" onClick="jump('pictures_add.php')">Add</button></h3>
	<form action='#' method='POST' enctype='multipart/form-data'>								
	<div class="row">

		<?php
			$ex=$link->query("SELECT * FROM pictures ORDER by picid") or die (mysqli_error($link));		

			while($rs=mysqli_fetch_array($ex)){	

			if(isset($_POST["b_upImg_$rs[0]"])){
				move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "../img/pictures/$rs[0].jpg");
				$link->query("update pictures set photo=1 where picid='$rs[0]'");
				jump("");

				$origFile="../img/pictures/$rs[0].jpg";
				$destFile="../img/pictures/resized/$rs[0].jpg";
				
				$source = imagecreatefromjpeg($origFile);
				list($width, $height) = getimagesize($origFile);

				$newWidth = 384;
				$newHeight = 512;

				$thumb = imagecreatetruecolor($newWidth, $newHeight);
				imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
				imagejpeg($thumb, $destFile, 80);
			}	
			
			echo"
				<div 
					id='div_$rs[0]'
					class='text-center col-xl-2 col-sm-6 grid-margin stretch-card mother' 
					onmouseout=\"getID('div_controls_$rs[0]').style.visibility='hidden';\"
					onmousemove=\"getID('div_controls_$rs[0]').style.visibility='visible';\"
				>
					<div class='card'>
						<div class='card-body'>
							<div class='row' style='position:relative'>
								<div class='col box-item' style='margin:-12px 0 -12px 0;padding:0'>
									<img style='width:100%' ";								
										if(file_exists("../img/pictures/resized/$rs[0].jpg")){			
											echo" src='../img/pictures/resized/$rs[0].jpg?".date("h:i:s")."' />";
										}else{
											echo" src='../img/pictures.png?".date("h:i:s")."' />";
										}
									
									echo"
									<div class='child btn-group' id='div_controls_$rs[0]'>
										<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
										<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'> 
										<input class='btn btn-danger' value='PIC' onclick=\"$('#b_file_$rs[0]').click();\" style='width:60px;margin:2px'>
										<input class='btn btn-danger' onclick=\"jump('pictures_edit.php?pictures=$rs[0]');\" value='EDIT' style='width:60px;margin:2px'>
										<input class='btn btn-danger' onclick=\"picDelete('$rs[0]');\" value='DEL' style='width:60px;margin:2px'>
									</div>
									
									<div class='bg-dark' style='position:absolute;bottom:0;opacity:.7;width:100%'>
										<div style='margin:5px 5px 0 5px'><h4>".$rs["title"]."</h4></div>
										<div style='margin:-10px 5px 5px 5px'><small>".$rs["description"]."</small></div>
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
			xmlhttp.open("GET","../admin_pictures_delete.php?picid="+picid,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("footer.php");?>
