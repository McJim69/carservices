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

<div class="row">
	<div class="col grid-margin stretch-card">
		<div class='card'>
			<div class='card-body' style='padding-bottom:2px'>
				<h4 class="card-title">Customers &nbsp; 
					<button style="width:70px" onClick="jump('customers.php')" class="btn btn-sm btn-outline-success">
						View All
					</button>
					<button style="width:70px" onClick="jump('customers_add.php')" class="btn btn-sm btn-outline-success">
						+ ADD
					</button>
				</h4>
				<div class='row'>
					<?php
						$ex=$link->query("SELECT * FROM customers ORDER by cid LIMIT 12") or die (mysqli_error($link));		

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
										
							echo"
							
							<div 
								id='div_$rs[0]'
								class='col-xl-2 col-sm-4 grid-margin stretch-card mother' 
								onmouseout=\"getID('div_controls_$rs[0]').style.visibility='hidden';\"
								onmousemove=\"getID('div_controls_$rs[0]').style.visibility='visible';\"
							>
								<div class='card' style='margin:0;padding:0'>
									<div class='card-body  bg-dark' style='border-radius:5px;margin:0;padding:20px 0 10px 0'>
										<div class='row' style='margin:0;padding:0'>
											<div class='text-center col-lg-12' style='margin:0;padding:0'>	
												<img class='img-fluid' style='width:85%;border-radius:3px' ";
												
													if(file_exists("../img/customers/resized/$rs[0].jpg")){			
														echo" src='../img/customers/resized/$rs[0].jpg?".date("h:i:s")."' />";
													}else{
														echo" src='../img/user.png?".date("h:i:s")."' />";
													}
													
													echo"
												</div>
											</div>
											<form action='#' method='POST' enctype='multipart/form-data'>

											<div class='child btn-group' id='div_controls_$rs[0]'>	
												<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
												<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
												<input class='btn btn-info' value='Pic' style='width:60px;margin:2px' onclick=\"$('#b_file_$rs[0]').click();\"/>
												<input class='btn btn-info' onclick=\"jump('customers_edit.php?customers=$rs[0]');\" value='Edit' style='width:60px;margin:2px'>
												<input class='btn btn-info' onclick=\"deleteCustomer('$rs[0]');\" value='Del' style='width:60px;margin:2px'>
											</div>
										
											</form>

											<div class='text-center' style='margin-top:5px'>	
												<div>".$rs["fullname"]."</div>
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