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

<?php 
	$sink="http://google.com";
	if (@fopen($sink,"r")) {
?>

<!-- Page Header Start -->
<div class="content-wrapper">
<form action='#' method='POST' enctype='multipart/form-data'>
	<h3 class="card-title">Galleries <small><i class='fa fa-arrow-right'></i></small> Videos &nbsp; 
		<span class="btn btn-outline-primary" onClick="jump('videos_add.php')">Add</span>
	</h3>

	<div class="row">

	<?php
		$ex=$link->query("SELECT * FROM videos ORDER by vid") or die (mysqli_error($link));		

		while($rs=mysqli_fetch_array($ex)){	

		$src = $rs["source"];
		$yid = trim($src,"https://www.youtube.com/watch?v=");
		$img = "https://img.youtube.com/vi/$yid/hqdefault.jpg";
		
		echo"
			<div 
				id='div_$rs[0]'
				class='col-xl-2 col-sm-4 grid-margin stretch-card' 
				onmouseout=\"getID('div_controls_$rs[0]').style.visibility='hidden';\"
				onmousemove=\"getID('div_controls_$rs[0]').style.visibility='visible';\"
			>				
				<div class='card'>
					<div class='card-body' style='padding:15px'>
						<div class='mother'>
							<a id='vlink' href='$src' class='venobox play-btn' data-vbtype='video' data-autoplay='true'>
								<img class='img-fluid' width='100%' src='$img' alt='Youtube'/>
							<div class='child btn-group' id='div_controls_$rs[0]'>
								<input style='width:60px;margin:2px' class='btn btn-danger' value='Play'></a>
								<input style='width:60px;margin:2px' class='btn btn-danger' onclick=\"jump('videos_edit.php?videos=$rs[0]');\" value='Edit'>
								<input style='width:60px;margin:2px' class='btn btn-danger' onclick=\"vidDelete('$rs[0]');\" value='Del'>
							</div>
						</div>
						<div class='text-center p-3' style='margin:0 0 -10px 0'>
							<h5 class='text-light fw-bold mb-0 text-uppercase'>".$rs["title"]."</h5>
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

<?php require("footer.php");?>