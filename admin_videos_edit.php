<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
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

<script> setActive("gallery"); </script>
<script> setActive("videos"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Update Video</h1>
				<button onClick="history.back()" class="btn btn-primary">
					<i class="fa fa-arrow-left"></i> Back
				</button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

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
			<form action='#' method='POST' enctype='multipart/form-data'>
				<div class='row justify-content-center' style='margin:5px 5px 50px 5px;padding:10px'>
					<div class='col-lg-5' style='border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;'>
						<div class='row'>
							<div class='col-lg-6 form-group mt-3'>							
								<div class='team-item'>
									<div class='position-relative overflow-hidden bg-light'>
									<img class='img-fluid' width='100%' src='$img' alt='Youtube' style='border-radius:5px'/>
										<div class='team-overlay position-absolute start-0 top-0 w-100 h-100' style='background:transparent;border:0'>								
											<a id='vlink' href='$src' class='venobox' data-vbtype='video' data-autoplay='true'>
												<img src='img/play.png' height='130' style='border:0'/>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class='col-lg-6 form-group mt-3'>
								<div style='background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'>
									<div class='text-center' style='margin:30px'>
										<div class='text-center'>
											<h3 class='text-primary text-uppercase'>".$rs["title"]."</h3>
										</div>
									</div>
									<div style='margin:5px' class='form-floating'>
										<input type='hidden' class='form-control' name='vid' value='$rs[0]' />
										<input type='text' class='form-control' name='title' value='".$rs["title"]."' placeholder='Title' required >
										<label for='title'>Title</label>
									</div>
									<div style='margin:5px' class='form-floating'>
										<textarea type='text' class='form-control' name='source' placeholder='Source (YouTube)' required >$src</textarea>
										<label for='source'>Source (YouTube)</label>
									</div>
								</div>
								<div class='text-center' style='margin:15px'>
									<button class='btn btn-primary rounded-pill' type='SUBMIT' name='upDate' style='width:100%;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;'>SAVE AND UPDATE</button>
								</div>
							</div>					
						</div>
					</div>
				</div>
			</form>
		  ";
		}		
	}			
?>			

<?php require("admin_footer.php");?>