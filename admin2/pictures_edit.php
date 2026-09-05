<?php 
	require("header.php");
	require("navbar.php");
	
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

	$cust="";
	if($_GET["pictures"]!="")
		$cust=" and picid='".$_GET["pictures"]."' ";
												
	$ex = $link->query("select * from pictures where picid=picid $cust order by picid limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from pictures t where t.picid='$rs[0]' and t.picid=t.picid ");

	while($rs = mysqli_fetch_array($ex)){	

	if(isset($_POST["b_upImg_$rs[0]"])){
		move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "../img/pictures/$rs[0].jpg");
		$link->query("update pictures set photo=1 where picid='$rs[0]'");
		jump("");

		$origFile="../img/pictures/$rs[0].jpg";
		$destFile="../img/pictures/resized/$rs[0].jpg";
				
		$source = imagecreatefromjpeg($origFile);
		list($width, $height) = getimagesize($origFile);

		$newWidth = 384;
		$newHeight = 512;

		$thumb = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		imagejpeg($thumb, $destFile, 80);
	}			
?>

<div class="content-wrapper">
	<div class="row">
		<div class='col-lg-3 grid-margin stretch-card'>
			<div class='card'>
				<div class='card-body'>
					<h4 class="card-title">Galleries 
						<small><i class='fa fa-arrow-right'></i></small> Pictures 
						<small><i class='fa fa-arrow-right'></i></small> Edit
					</h4>
					<div class='row'>
						<div class='col'>
							<div class='text-center'>
								<?php
									echo"<img style='border-radius:4px;width:100%' ";
									if(file_exists("../img/pictures/resized/$rs[0].jpg")){		
										echo" src='../img/pictures/resized/$rs[0].jpg?".date("h:i:s")."' />";
									}else{
										echo" src='../img/pictures.png' />";
									}
								?>
							</div><br>
							<form action='#' method='POST' enctype='multipart/form-data'>
							<div class='text-center'>
								<?php
									echo"
									<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
									<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
									<input class='btn btn-inverse-primary btn-block' value='Change Photo' onclick=\"$('#b_file_$rs[0]').click();\" style='padding:10px'/>
									";
								?>
							</div><br>
							<div class='form-group'>
								<input type='hidden' name='picid' value='<?php echo $rs[0];?>' />
								<input type='text' class='form-control text-light' name='title' value='<?php echo $rs["title"];?>' placeholder='Title' required >
							</div>
							<div class='form-form-group'>
								<input type='text' class='form-control text-light' name='description' value='<?php echo $rs["description"];?>' placeholder='Description' required >
							</div><br>
							<div class='form-form-group' style='margin-top:20px;margin-botto:0'>
								<button class='btn btn-inverse-primary btn-block' type='SUBMIT' name='upDate' style='padding:10px'>Save & Update</button>
							</div>
							</form>
						</div>
					</div>		
				</div>
			</div>
		</div>

		<?php } } require("pictures1.php");?>

	</div>	
</div>
			
<?php require("footer.php");?>
