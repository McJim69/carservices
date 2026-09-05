<?php 
	require("header.php");
	require("navbar.php");
	
	if(isset($_POST['upDate'])){	
		$vid = $_POST['vid'];
		$tit = $_POST['title'];
		$src = $_POST['source'];

	$update = $link->query("UPDATE videos set
		vid = '$vid',
		title = '$tit',
		source = '$src'
		where vid = '$vid'");

		if(($update)== TRUE){
			echo"<script>history.back();</script>";
		}
	}		
?>


<div class="content-wrapper">
<form action='#' method='POST' enctype='multipart/form-data'>
<h3 class="card-title">Galleries
	<small> <i class='fa fa-arrow-right'></i> </small> Videos
	<small> <i class='fa fa-arrow-right'></i> </small> Edit
</h3>
<div class="row">

<?php 

	$cust="";
	if($_GET["videos"]!="")
		$cust=" and vid='".$_GET["videos"]."' ";
												
		$ex = $link->query("select * from videos where vid=vid $cust order by vid limit 1");

		while($rs = mysqli_fetch_array($ex)){	

		$ex = $link->query("select * from videos t where t.vid='$rs[0]' and t.vid=t.vid ");

		while($rs = mysqli_fetch_array($ex)){	

		$src = $rs["source"];
		$yid = trim($src,"https://www.youtube.com/watch?v=");
		$img = "https://img.youtube.com/vi/$yid/hqdefault.jpg";
	
		echo"
			<div class='col-xl-4 col-sm-6 grid-margin stretch-card'>
				<div class='card'>
					<div class='card-body'>
						<div class='row' style='margin-bottom:-15px'>
							<div class='col-lg-12 form-group mt-3'>							
								<div class='position-relative'  style='margin-top:-15px'>
									<a id='vlink' href='$src' class='venobox' data-vbtype='video' data-autoplay='true'>
										<img class='img-fluid' width='100%' src='$img' alt='Youtube'/>
									</a>
								</div><br>
								<div class='form-group'>
									<label for='title'>Title</label>
									<input type='hidden' class='form-control' name='vid' value='$rs[0]' />
									<input type='text' class='bg-dark form-control text-secondary' name='title' value='".$rs["title"]."' placeholder='Title' required >
								</div>
								<div class='form-group'>
									<label for='source'>Source (YouTube)</label>
									<input type='text' class='bg-dark form-control text-secondary' name='source' placeholder='Source (YouTube)' value='$src' required >
								</div>
								<div style='margin-top:20px'>
									<button class='btn btn-primary btn-block' type='SUBMIT' name='upDate' style='padding:10px'>Save & Update</button>
								</div>
							</div>	
						</div>	
					</div>
				</div>
			</div>
		  ";
		}		
	}			
?>	

<?php require("videos2.php");?>

</div>

</form>
	
</div>
			
<?php require("footer.php");?>
