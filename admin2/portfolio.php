<div class="row">
<?php require("outofstock.php");?>

	<div class="col-md-4 col-xl-3 grid-margin stretch-card">
		<div class="card">
			<div class="card-body"><h4 class="card-title">Photos</h4>
				<div class="owl-carousel owl-theme full-width owl-carousel-dash portfolio-carousel" id="owl-carousel-basic">
				<?php 
					$picQ=$link->query("SELECT * FROM pictures") or die(mysqli_error($link));
					while($picR=mysqli_fetch_array($picQ)){
					echo"
						<a href='../img/pictures/$picR[0].jpg' target='_blank'>
							<div class='item'>
								<div class='text-center' style='position:relative'>
									<img src='../img/pictures/resized/$picR[0].jpg' alt='Pictures' style='height:410px'>
									<div style='position: absolute;top: 50%;left:50%;transform: translate(-50%, -50%);'>
										<div class='btn btn-dark'>".$picR["title"]." ".$picR[0]."</div>
									</div>
								</div>
							</div>
						</a>

					  ";
					}
				?>
				</div>
			</div>
		</div>
	</div>

	<?php require("videos1.php");?>

</div>