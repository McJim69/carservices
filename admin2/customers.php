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
	<div class="row">
		<div class="col-lg-12">
			<h2>Customers &nbsp; 
				<a href="index.php" title="Back" class="btn btn-sm btn-outline-info"> 
					<i class="mdi mdi-arrow-left"></i>Back
				</a>
				<a href="customers_add.php" title="Add" class="btn btn-sm btn-outline-info">
					<i class="mdi mdi-plus"></i>Add
				</a>
				<a href="customers.php" title="Refresh" class="btn btn-sm btn-outline-info">
					<i class="mdi mdi-magnify"></i>Refresh
				</a>
			</h2> 
			<div class="row">

			<?php
				$ex=$link->query("SELECT * FROM customers ORDER by cid") or die (mysqli_error($link));		

				while($rs=mysqli_fetch_array($ex)){	

					if(isset($_POST["b_upImg_$rs[0]"])){
						move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "../img/customers/$rs[0].jpg");
						$link->query("update customers set photo_id=1 where cid='$rs[0]'");
						jump("");

						$origFile="../img/customers/$rs[0].jpg";
						$destFile="../img/customers/resized/$rs[0].jpg";
									
						$source = imagecreatefromjpeg($origFile);
						list($width, $height) = getimagesize($origFile);

						$newWidth = 300;
						$newHeight = 300;

						$thumb = imagecreatetruecolor($newWidth, $newHeight);
						imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
						imagejpeg($thumb, $destFile, 80);
					}						
								
					echo"<div 
						id='div_$rs[0]'					
						class='col-xl-2 col-sm-4 grid-margin stretch-card mother' 
						onmouseout=\"getID('div_controls_$rs[0]').style.visibility='hidden';\"
						onmousemove=\"getID('div_controls_$rs[0]').style.visibility='visible';\"
					>
						<div class='card'>
							<div class='card-body' style='padding:15px'>
								<div class='row'>
									<div class='text-center col-lg-12'>									
										<img class='img-fluid' style='width:100%;border-radius:3px;z-index:1' ";
											if(file_exists("../img/customers/resized/$rs[0].jpg")){			
												echo" src='../img/customers/resized/$rs[0].jpg?".date("h:i:s")."' />";
											}else{
												echo" src='../img/user.png?".date("h:i:s")."' />";
											}
											
										echo"

										<form action='#' method='POST' enctype='multipart/form-data'>

										<div class='text-center child btn-group' id='div_controls_$rs[0]'>	
											<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
											<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'> 
											<input class='btn btn-info' value='Pic' onclick=\"$('#b_file_$rs[0]').click();\" style='width:55px;margin:2px'>
											<input class='btn btn-info' onclick=\"jump('customers_edit.php?customers=$rs[0]');\" value='Edit' style='width:55px;margin:2px'>
											<input class='btn btn-info' onclick=\"deleteCustomer('$rs[0]');\" value='Del' style='width:55px;margin:2px'>
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
</div>

<script>
	function deleteCustomer(cid){	
		if(confirm("Are you sure you want to Remove this Customer?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#div_"+cid).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#div_"+cid).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","../admin_customers_delete.php?cid="+cid,true);
			xmlhttp.send();
		}
	}	
</script>	

<?php require("footer.php");?>