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

<?php 
	$sink="http://google.com";
	if (@fopen($sink,"r")) {
?>

	<div class="col grid-margin stretch-card">
		<div class='card'>
			<div class='card-body'>
				<h4 class="card-title">Videos &nbsp; 
					<a style="width:70px" href="videos.php" class="btn btn-sm btn-outline-success">
						View All
					</a>
					<a style="width:70px" href="videos_add.php" class="btn btn-sm btn-outline-success">
						+ ADD
					</a>
				</h4>
				<div class='row' style='margin-bottom:-25px'>

					<?php
						$ex=$link->query("SELECT * FROM videos ORDER by rand() LIMIT 8") or die (mysqli_error($link));		

						while($rs=mysqli_fetch_array($ex)){	

							$src = $rs["source"];
							$yid = trim($src,"https://www.youtube.com/watch?v=");
							$img = "https://img.youtube.com/vi/$yid/hqdefault.jpg";
										
							echo"
							
							<div 
								id='div_$rs[0]'
								class='col-xl-3 col-sm-6 grid-margin stretch-card' 
								onmouseout=\"getID('div_controls_$rs[0]').style.visibility='hidden';\"
								onmousemove=\"getID('div_controls_$rs[0]').style.visibility='visible';\"
							>
								<div class='card'>
									<div class='card-body' style='background:#000;border-radius:5px;padding:0 0 20px 0'>
										<div class='mother' style='padding:10px'>
											<a id='vlink' href='$src' class='venobox play-btn' data-vbtype='video' data-autoplay='true' title='".$rs["title"]."'>
												<img class='img-fluid' src='$img' alt='Youtube' style='width:100%' />
											<div class='child btn-group' id='div_controls_$rs[0]'>	
												<input class='btn btn-danger' value='Play' style='width:60px;margin:1px' /></a>
												<input class='btn btn-danger' onclick=\"jump('videos_edit.php?videos=$rs[0]');\" value='Edit' style='width:60px;margin:1px'>
												<input class='btn btn-danger' onclick=\"vidDelete('$rs[0]');\" value='Del' style='width:60px;margin:1px'>
											</div>
										</div>
										<div class='text-center text-light' style='background:#000;margin:-15px 0 -5px 0'>
											".$rs["title"]."
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

<?php } else { ?>

	<div class="col grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Videos</h4>
				<div class="row" style="margin-bottom:-25px">
					<div class='col-xl-6 col-sm-12 grid-margin stretch-card'>
						<div class='card'>
							<div class='card-body' style='background:#000;border-radius:5px;padding:0 0 20px 0'>
								<div class='mother' style='padding:10px'>
									No Internet Connection.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php } ?>

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
			xmlhttp.open("GET","../admin_videos_delete.php?vid="+vid,true);
			xmlhttp.send();
		}
	}	
</script>