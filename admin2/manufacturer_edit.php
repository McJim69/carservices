<?php 
	require("header.php");
	require("navbar.php");
	
	if(isset($_POST['upDate'])){	
		$mfid  = $_POST['mfid'];
		$name  = $_POST['name'];

	$update = $link->query("UPDATE manufacturer set
		mfid = '$mfid',
		name = '$name' where mfid = '$mfid'");

		if(($update)== TRUE){
			
			echo'
			<script type="text/javascript">
				swal({
				  title: "Success!",
				  text: "Manufacture '.$name.' updated successfully!",
				  type: "success"
				}).then(function() {
					window.location.href = "manufacturer_edit.php?manufacturer='.$mfid.'";
				})
			</script>';
			
		}else{
			$error = mysqli_error($link);
			echo'
			<script type="text/javascript">
				jQuery(function validation(){
					swal("ERROR!", "'.$error.'", "warning", {
						button: "Retry",
					});
				});
			</script>';
		}
	}
?>

<?php 
	$cust="";
	if($_GET["manufacturer"]!="")
		$cust=" and mfid='".$_GET["manufacturer"]."' ";
												
	$ex = $link->query("select * from manufacturer where mfid=mfid $cust order by mfid limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from manufacturer t where t.mfid='$rs[0]' and t.mfid=t.mfid ");

	while($rs = mysqli_fetch_array($ex)){	

	if(isset($_POST["b_upImg_$rs[0]"])){
		move_uploaded_file($_FILES["b_file_$rs[0]"]["tmp_name"], "../img/manufacturer/$rs[0].png");
		$link->query("update manufacturer set logo=1 where mfid='$rs[0]'");
		jump("");
	}			
?>

<div class="content-wrapper">
	<form action='#' method='POST' enctype='multipart/form-data'>
	<div class="row">
		<div class='col-lg-3 col-sm-6 grid-margin stretch-card'>
			<div class='card'>
				<div class='card-body'>
					<h3 class="card-title">Manufacturer <small><i class='fa fa-arrow-right'></i></small> Edit</h3>

					<div class='row-lg-2 bg-light' style='border-radius:4px'>
					<?php
						echo"<img style='width:100%' ";
						if(file_exists("../img/manufacturer/$rs[0].png")){		
							echo" src='../img/manufacturer/$rs[0].png?".date("h:i:s")."' />";
						}else{
							echo" src='../img/logo1.png' />";
						}
					echo"
					</div>
					<div class='row-lg-12'>
						<div style='margin-top:20px'>
							<input type=file name='b_file_$rs[0]' id='b_file_$rs[0]' style='display:none' onchange=\"if(this.value!='')$('#b_upImg_$rs[0]').click();\"/> 
							<input type=submit name='b_upImg_$rs[0]' id='b_upImg_$rs[0]' value='Upload' style='display:none'/> 
							<input class='btn btn-primary btn-block' value='Change Logo' onclick=\"$('#b_file_$rs[0]').click();\" style='padding:10px'/>
						</div>";
					?>
					</div><br>
					<div class='row-lg-12'>
						<div class='form-floating'>	
							<label for='name'>Brand Name</label>
							<input type='hidden' class='form-control' name='mfid' value='<?php echo $rs[0];?>' />
							<input type='text' class='form-control text-uppercase' name='name' value='<?php echo $rs["name"];?>' placeholder='Brand Name' required >
						</div>
					</div>
					<div class='row-lg-12'>
						<div style='margin-top:20px'>
							<button class='btn btn-primary btn btn-block' type='SUBMIT' name='upDate' style='padding:12px'>Save & Update</button>
						</div>
					</div>
					<div class='row-lg-12'>
						<div style='margin-top:35px;margin-bottom:-5px'>
							<a class='btn btn-inverse-primary btn btn-block' style='padding:12px' href='manufacturer_add.php'>Add Manufacturer</a>
						</div>
					</div>
				</div>
			</div>
		</div>
			
<?php
		} 
	} 	
?>

<?php require("manufacturer1.php");?>


</div>

</div>	

<?php require("footer.php");?>

