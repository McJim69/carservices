<?php 
	require("header.php");
	require("navbar.php");
?>

<style>
	.box-item{
		border-radius: 4px;
		background: gray;
		opacity:0.7
	}
	.box-item:hover{
		background: #eee;
		opacity:1
	}
	.box-img{
		width:80%;
		height:80%;
	}
</style>

<div class="content-wrapper">
	<h3 class="card-title">System Settings</h3>
	<div class="row">

		<?php
			$ex=$link->query("SELECT * FROM settings ORDER BY set_id limit 6");
							
			while($rs=mysqli_fetch_array($ex)){	
					
			$title = $rs["set_title"];
			$sdesc = $rs["description"];
			$link1= $rs["set_link"];
						
			echo"
				<div class='text-center col-xl-2 col-sm-6 grid-margin stretch-card' id='div_$rs[0]'>
					<div class='card'>
						<div class='card-body'>
							<div class='row'>
								<div class='col-12' onClick=\"jump('$link1.php')\" style='cursor:pointer'>
									<div class='box-item'>
										<img class='img-fluid box-img' src='../img/system/$link1.png?".date("h:i:s")."'>
									</div>						
									<div class='text-center bg-dark' style='padding:10px 5px 10px 5px;margin-top:10px;margin-bottom:0;border-radius:4px'>
										<h5 class='fw-bold mb-0'>$title</h5>
										<small>$sdesc</small>
									</div>
								</div>
							</div> 
						</div> 
					</div> 
				</div> 
			  ";
			}
		?>
	</div>
</div>

<?php require("footer.php");?>
