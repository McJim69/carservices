<style>
	.box-item{
		padding:15px;
		background: #000;
		border-radius: 5px;
		cursor:pointer;
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
	<div class='col-lg-9 grid-margin stretch-card'>
		<div class='card'>
			<div class='card-body'>
				<h3 class="card-title">Manufacturer &nbsp; 
					<a href="manufacturer.php" class="btn btn-sm btn-outline-success">
						+ View All
					</a>
				</h3>
				<div class='row'  style='margin-bottom:-20px'>
					<?php
						$ex=$link->query("SELECT * FROM manufacturer ORDER BY rand() LIMIT 18") or die (mysqli_error($link));		

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
							class='col-xl-2 col-lg-2 col-sm-6 mother' 
							onmouseout=\"getID('div_controls_$rs[0]').style.visibility='hidden';\"
							onmousemove=\"getID('div_controls_$rs[0]').style.visibility='visible';\"
						>
							<div class='text-center box-item' onclick=\"jump('manufacturer_edit.php?manufacturer=$rs[0]');\">
								<img class='img-fluid' ";								
									if(file_exists("../img/manufacturer/$rs[0].png")){			
										echo" src='../img/manufacturer/$rs[0].png?".date("h:i:s")."' />";
									}else{
										echo" src='../img/brand.jpg?".date("h:i:s")."' />";
									}
								echo"		
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