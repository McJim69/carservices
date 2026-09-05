<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
	if(isset($_POST['upDate'])){	
		$asid  = $_POST['asid'];
		$title = $_POST['title'];
		$pdesc = $_POST['description'];
		$icon  = $_POST['icon'];

	$update = $link->query("UPDATE about set
		asid        = '$asid',
		title       = '$title',
		description = '$pdesc',
		icon        = '$icon'
		where asid  = '$asid'") or die(mysqli_error($link));

		if(($update)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>

<script> setActive("system"); </script>
<script> setActive("about"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Update About</h1>
				<button onClick="history.back()" class="btn btn-primary">
					<i class="fa fa-arrow-left"></i> Back
				</button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<?php 
	$about="";
	if($_GET["about"]!="")
		$about=" and asid='".$_GET["about"]."' ";
												
	$ex = $link->query("select * from about where asid=asid $about order by asid limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from about t where t.asid='$rs[0]' and t.asid=t.asid ");

		while($rs = mysqli_fetch_array($ex)){	

		echo"
			<form action='#' method='POST' enctype='multipart/form-data'>
				<div class='row justify-content-center' style='margin:5px 5px 50px 5px;padding:10px'>
					<div class='col-lg-4' style='border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;'>
						<div class='row'>
							<div class='form-group mt-3'>
								<div class='text-center bg-light'>
									<i class='".$rs["icon"]." text-primary' style='margin:10px;font-size:100px'></i>
									<h4 class='text-primary text-uppercase'>".$rs["title"]."</h4>
								</div>
								<div style='background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'>
									<div style='margin:5px' class='form-floating'>
										<input type='hidden' name='asid' value='$rs[0]' />
										<input type='text' class='form-control' name='title' value='".$rs["title"]."' placeholder='Title' required >
										<label for='title'>Title</label>
									</div>
									<div style='margin:5px' class='form-floating'>
										<textarea type='text' class='form-control' name='description' placeholder='Description' required >".$rs["description"]."</textarea>
										<label for='description'>Description</label>
									</div>
									<div style='margin:5px' class='form-floating'>
										<input type='text' class='form-control' name='icon' placeholder='Font Awesome Icon' value='".$rs["icon"]."' required >
										<label for='icon'>Font Awesome Icon</label>
									</div>
								</div>
								<div class='text-center' style='margin:20px'>
									<button class='btn btn-primary rounded-pill' type='SUBMIT' name='upDate' style='width:200px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;'>SAVE & UPDATE</button>
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