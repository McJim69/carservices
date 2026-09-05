<?php 
	require("header.php");
	require("navbar.php");
?>

<style>
	.box-item{
		padding:15px;
		background: #000;
		border-radius: 5px;
	}
	.box-item img{
		width:100%;
		border-radius: 4px;
		background:#bbb;
		opacity: .7;
	}
	.box-item img:hover{
		background: #eee;
		opacity: 1;
	}

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
	<div class='row'>
		<div class='col-lg-12'>
			<div class='card'>
				<div class='card-body'>
					<h3 class="card-title">Manufacturer &nbsp; 
						<button style="width:70px" onClick="jump('manufacturer_add.php')" class="btn btn-sm btn-outline-success">
							+ ADD
						</button>
					</h3>
					<div class='row'>
						<?php
							$ex=$link->query("SELECT * FROM manufacturer ORDER by mfid") or die (mysqli_error($link));		

							while($rs=mysqli_fetch_array($ex)){	
													
							if(isset($_POST["b_upImg_$rs[0]"])){
								move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "../img/manufacturer/$rs[0].png");
								$link->query("update manufacturer set logo=1 where mfid='$rs[0]'");
								jump("");
							}						
													
							echo"

							<div 
								id='div_$rs[0]' 
								style='margin-bottom:20px'
								class='col-xl-2 col-lg-3 col-sm-4 mother' 
								onmouseout=\"getID('div_controls_$rs[0]').style.visibility='hidden';\"
								onmousemove=\"getID('div_controls_$rs[0]').style.visibility='visible';\"
							>
								<div class='text-center box-item'>
									<img class='img-fluid' ";								
										if(file_exists("../img/manufacturer/$rs[0].png")){			
											echo" src='../img/manufacturer/$rs[0].png?".date("h:i:s")."' />";
										}else{
											echo" src='../img/brand.jpg?".date("h:i:s")."' />";
										}
									echo"		
									<form action='#' method='POST' enctype='multipart/form-data'>

									<div class='btn-group child' id='div_controls_$rs[0]' style='margin:10px 0 10px 0'>
										<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\" > 
										<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none' > 
										<input class='btn btn-danger' value='Logo' onclick=\"$('#b_file_$rs[0]').click();\" style='width:60px;margin:1px' >
										<input class='btn btn-danger' onclick=\"jump('manufacturer_edit.php?manufacturer=$rs[0]');\" value='Edit' style='width:60px;margin:1px' >
										<input class='btn btn-danger' onclick=\"mfDelete('$rs[0]');\" value='Del' style='width:60px;;margin:1px' >
									</div>

									</form>

									<div class='text-center' style='margin:13px 0 -5px 0'>
										<h4 class='text-uppercase'>".$rs["name"]."</h4>
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
</div>

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
			xmlhttp.open("GET","../admin_manufacturer_delete.php?mfid="+mfid,true);
			xmlhttp.send();
		}
	}	
</script>

<?php require("footer.php");?>
