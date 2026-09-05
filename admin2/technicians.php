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
	<div class="col-lg-12">
		<h2>Technicians &nbsp; 
			<a href='index.php' title='Back' class='btn btn-sm btn-outline-info'> 
				<i class='mdi mdi-arrow-left'></i>Back
			</a>
			<a href='technicians_add.php' title='Add' class='btn btn-sm btn-outline-info'>
				<i class='mdi mdi-plus'></i>Add
			</a>
			<a href='technicians.php' title='Add' class='btn btn-sm btn-outline-info'>
				<i class='mdi mdi-magnify'></i>Refresh
			</a>
		</h2> 
	
		<div class="row">
			
		<?php
			$ex=$link->query("SELECT * FROM technicians ORDER by tech_id") or die (mysqli_error($link));		

			while($rs=mysqli_fetch_array($ex)){	

			if(isset($_POST["b_upImg_$rs[0]"])){
				move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "../img/technicians/$rs[0].jpg");
				$link->query("update technicians set photo_id=1 where tech_id='$rs[0]'");
				jump("");

				$origFile="../img/technicians/$rs[0].jpg";
				$destFile="../img/technicians/resized/$rs[0].jpg";
				
				$source = imagecreatefromjpeg($origFile);
				list($width, $height) = getimagesize($origFile);

				$newWidth = 300;
				$newHeight = 300;

				$thumb = imagecreatetruecolor($newWidth, $newHeight);
				imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
				imagejpeg($thumb, $destFile, 80);
			}				
				
			echo"		
				<div id='div_$rs[0]' class='col-xl-2 col-sm-6 grid-margin stretch-card'>
					<div class='card'>
						<div class='card-body'>
							<div class='row'>
								<div class='col text-center mother' 
									onmouseout=\"getID('div_controls_$rs[0]').style.visibility='hidden';\"
									onmousemove=\"getID('div_controls_$rs[0]').style.visibility='visible';\"								
								>	
									<img class='img-fluid' style='width:100%;border-radius:3px' ";
									if(file_exists("../img/technicians/resized/$rs[0].jpg")){			
										echo" src='../img/technicians/resized/$rs[0].jpg?".date("h:i:s")."' />";
									}else{
										echo" src='../img/user.png?".date("h:i:s")."' />";
									}		
									echo"
									<form action='#' method='POST' enctype='multipart/form-data'>
										<div class='child btn-group' id='div_controls_$rs[0]'>	
											<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
											<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
											<input class='btn btn-info' onclick=\"$('#b_file_$rs[0]').click();\" value='Pic' style='width:55px;margin:2px'/>
											<input class='btn btn-info' onclick=\"jump('technicians_edit.php?technicians=$rs[0]');\" value='Edit' style='width:55px;margin:2px'>
											<input class='btn btn-info' onclick=\"deleteTech('$rs[0]');\" value='Del' style='width:55px;margin:2px'>
										</div>
									</form>
								</div>
							</div>

								<div class='text-center' style='margin-bottom:-5px'>	
									<div  style='margin-top:15px'>".$rs["fullname"]."</div>
									<div><small>".$rs["position"]."</small></div>
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

<script>
	function deleteTech(tech_id){	
		if(confirm("Are you sure you want to Remove this Technician?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#div_"+tech_id).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#div_"+tech_id).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","../admin_technicians_delete.php?tech_id="+tech_id,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("footer.php");?>