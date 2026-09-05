<?php 
	require("admin_header.php");
	require("admin_topbar.php");
	require("admin_navbar.php");
	
	if(isset($_POST['upDate'])){	
		$picid = $_POST['picid'];
		$title = $_POST['title'];
		$pdesc = $_POST['description'];

	$update = $link->query("UPDATE pictures set
		picid = '$picid',
		title = '$title',
		description = '$pdesc'
		where picid = '$picid'");

		if(($update)== TRUE){
			echo"<script>history.back();</script>";
		}
	}
?>

<script> setActive("gallery"); </script>
<script> setActive("photos"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Update Picture</h1>
				<button onClick="history.back()" class="btn btn-primary">
					<i class="fa fa-arrow-left"></i> Back
				</button>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<?php 
	$cust="";
	if($_GET["pictures"]!="")
		$cust=" and picid='".$_GET["pictures"]."' ";
												
	$ex = $link->query("select * from pictures where picid=picid $cust order by picid limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from pictures t where t.picid='$rs[0]' and t.picid=t.picid ");

		while($rs = mysqli_fetch_array($ex)){	

		if(isset($_POST["b_upImg_$rs[0]"])){
			move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "img/pictures/$rs[0].jpg");
			$link->query("update pictures set photo=1 where picid='$rs[0]'");
			jump("");

			$origFile="img/pictures/$rs[0].jpg";
			$destFile="img/pictures/resized/$rs[0].jpg";
					
			$source = imagecreatefromjpeg($origFile);
			list($width, $height) = getimagesize($origFile);

			$newWidth = 384;
			$newHeight = 512;

			$thumb = imagecreatetruecolor($newWidth, $newHeight);
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
			imagejpeg($thumb, $destFile, 80);
		}						

		echo"
			<form action='#' method='POST' enctype='multipart/form-data'>
				<div class='row justify-content-center' style='margin:5px 5px 50px 5px;padding:10px'>
					<div class='col-lg-4' style='border:1px solid #bbb;background:#eee;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;'>
						<div class='row'>
							<div class='col-lg-5 form-group mt-3'>
								<div class='bg-light text-center' style='margin-bottom:15px;'>
									<img style='border-radius:4px;border:1px solid #bbb;width:100%;background:#fff;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;' ";
									if(file_exists("img/pictures/resized/$rs[0].jpg")){		
										echo" src='img/pictures/resized/$rs[0].jpg?".date("h:i:s")."' />";
									}else{
										echo" src='img/pictures.png' />";
									}
								echo"
								</div>
							</div>
							<div class='col-lg-7 form-group mt-3'>
								<div style='background:#fff;border-radius:4px;background:#fff;border:1px solid #bbb;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px'>
									<div class='text-center' style='margin:20px'>
										<div class='text-center'>
											<h3 class='text-primary text-uppercase'>".$rs["title"]." $rs[0]</h3>
										</div>
									</div>
									<div style='margin:5px' class='form-floating'>
										<input type='hidden' name='picid' value='$rs[0]' />
										<input type='text' class='form-control' name='title' value='".$rs["title"]."' placeholder='Title' required >
										<label for='title'>Title</label>
									</div>
									<div style='margin:5px' class='form-floating'>
										<input type='text' class='form-control' name='description' value='".$rs["description"]."' placeholder='Description' required >
										<label for='description'>Description</label>
									</div>
								</div>
								<div class='text-center' style='margin:20px'>
									<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
									<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
									<input class='btn btn-primary rounded-pill' style='width:100%;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px' value='Change Photo' onclick=\"$('#b_file_$rs[0]').click();\"/>
								</div>
								<div class='text-center' style='margin:20px'>
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