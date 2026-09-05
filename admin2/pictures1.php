<style>
	.mother{
		position: relative;
		padding:-10px;
	}
	.child{
		top: 50%;
		left: 50%;
		margin: 0;
		position: absolute;
		transform: translate(-50%, -50%);
	}
	.mother img{
		width:100%;
	}
	.img-cont{
		border-radius:4px;
		border:10px solid #000;
		margin-bottom:20px;
	}
</style>

<div class='col-lg-9 grid-margin stretch-card'>
	<div class='card'>
	<div class='card-body' style='padding-bottom:5px'>
		<h4 class="card-title">Galleries 
			<small><i class='fa fa-arrow-right'></i></small> Pictures
			<small><i class='fa fa-arrow-right'></i></small> List
		</h4>
		<div class='row'>
			<?php
				$ex=$link->query("SELECT * FROM pictures ORDER BY picid LIMIT 18") or die (mysqli_error($link));		

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
					<div id='div_$rs[0]' class='text-center col-xl-2 col-lg-12'>
						<div class='row'>
							<div 
								class='col-lg-12 mother'
								onmouseout=\"getID('div_controls_$rs[0]').style.visibility='hidden';\"
								onmousemove=\"getID('div_controls_$rs[0]').style.visibility='visible';\"
							>
								<div class='img-cont' style='position:relative'>
									<img ";								
										if(file_exists("../img/pictures/resized/$rs[0].jpg")){			
											echo" src='../img/pictures/resized/$rs[0].jpg?".date("h:i:s")."' />";
										}else{
											echo" src='../img/pictures.png?".date("h:i:s")."' />";
										}
									
									echo"
									<div class='bg-dark' style='position:absolute;bottom:0;opacity:.7;width:100%'>
										<div style='margin:5px 5px 0 5px'><h4>".$rs["title"]."</h4></div>
										<div style='margin:-10px 5px 5px 5px'><small>".$rs["description"]."</small></div>
									</div>
								</div>
								<div class='child btn-group' id='div_controls_$rs[0]'>
									<input class='btn btn-danger' onclick=\"jump('pictures_edit.php?pictures=$rs[0]');\" value='EDIT' style='width:60px;margin:2px'>
									<input class='btn btn-danger' onclick=\"picDelete('$rs[0]');\" value='DEL' style='width:60px;margin:2px'>
								</div>							
							</div>
						</div>
					</div>
					";
				}
				?>
			</div>	
		</div>			
	</div>
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
