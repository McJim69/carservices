<?php 
	require("header.php");
	require("navbar.php");
		
	if(isset($_POST["submit"])){	

	$insert = $link->query("INSERT INTO  videos VALUES (0,'".$_POST["title"]."','".$_POST["source"]."')");

		if(($insert)== TRUE){
			echo"<script>window.location.href = 'videos.php';</script>";
		}
	}
?>

<div class="content-wrapper">
<h3 class="card-title">Galeries <small><i class="fa fa-arrow-right"></i></small> Videos Add</h3>
	<div class="row">
		<div class="col-xl-4 col-sm-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
							<form action="#" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<div>Title</div>
									<input type="text" class="form-control text-secondary" name="title" placeholder="Title" required >
								</div>
								<div class="form-group">
									<div>Video Source (YouTube)</div>
									<input type="text" class="form-control text-secondary" name="source" placeholder="Video Source (YouTube)" required >
								</div>
								<div class="form-group" style="margin-top:20px;margin-bottom:0">
									<button class="btn btn-primary btn-block" type="SUBMIT" name="submit" style="padding:10px">Submit</button>
								</div>
							</form>
						</div>		
					</div>	
				</div>	
			</div>	
		</div><?php require("videos2.php");?>
	</div>
</div>

<?php require("footer.php");?>
