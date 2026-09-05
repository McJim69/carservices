<?php 
	require("header.php");
	require("navbar.php");
	
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

	$about="";
	if($_GET["about"]!="")
		$about=" and asid='".$_GET["about"]."' ";
												
	$ex = $link->query("select * from about where asid=asid $about order by asid limit 1");

	while($rs = mysqli_fetch_array($ex)){	

	$ex = $link->query("select * from about t where t.asid='$rs[0]' and t.asid=t.asid ");

		while($rs = mysqli_fetch_array($ex)){	
	//
?>
<div class="content-wrapper">
	<h3 class="card-title">Settings <small><i class='fa fa-arrow-right'></i></small> About Edit</h3>
	<form action='#' method='POST' enctype='multipart/form-data'>
	<div class="row">
		<div class='col-xl-4 col-sm-12 grid-margin stretch-card' id='div_$rs[0]'>
			<div class='card'>
				<div class='card-body'>
					<div class='row'>
						<div class='col-12' style='color:#bbb'>
							<div class='form-group text-center'>
								<i class='<?php echo $rs["icon"];?> text-primary' style='margin:10px;font-size:100px'></i>
								<h4 class='text-primary text-uppercase'><?php echo $rs["title"];?></h4>
							</div>
							<div class='form-group'>
								<label for='title'>Title</label>
								<input type='hidden' name='asid' value='<?php echo $rs[0];?>' />
								<input type='text' class='form-control text-secondary' name='title' value='<?php echo $rs["title"];?>' placeholder='Title' required >
							</div>
							<div class='form-group'>
								<label for='description'>Description</label>
								<input type='text' class='form-control text-secondary' name='description' placeholder='Description' value='<?php echo $rs["description"];?>' required >
							</div>
							<div class='form-group'>
								<label for='icon'>Font Awesome Icon</label>
								<input type='text' class='form-control text-secondary' name='icon' placeholder='Font Awesome Icon' value='<?php echo $rs["icon"];?>' required >
							</div>
							<div class='form-group'><br>
								<button class='btn btn-primary btn-block' type='SUBMIT' name='upDate' style='padding:10px'>Save & Update</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
	
</div>
			
<?php } } require("footer.php");?>
