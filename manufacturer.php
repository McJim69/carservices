<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="lc-block">
				<div id="carouselLogos" class="carousel slide pt-5 pb-4" data-bs-ride="carousel">
					<div class="carousel-inner px-5">
						<div class="carousel-item active">
							<div class="row">
								<?php
									$ex=$link->query("SELECT * FROM manufacturer ORDER BY mfid limit 6") or die (mysqli_error($link));		
									while($rs=mysqli_fetch_array($ex)){	
										echo
										"<div class='col-6 col-lg-2 align-self-center'>
											<img class='d-block w-100 px-3 mb-3' src='img/manufacturer/".$rs[0].".png?".date("h:i:s")."' alt='".$rs["name"]."'>
										</div>";
									}
								?>
							</div>
						</div>
						<div class="carousel-item">
							<div class="row">
								<?php
									$ex=$link->query("SELECT * FROM manufacturer ORDER BY mfid DESC limit 6") or die (mysqli_error($link));		
									while($rs=mysqli_fetch_array($ex)){	
										echo"
										<div class='col-6 col-lg-2 align-self-center'>
											<img class='d-block w-100 px-3 mb-3' src='img/manufacturer/".$rs[0].".png?".date("h:i:s")."' alt='".$rs["name"]."'>
										</div>";
									}
								?>
							</div>
						</div>
					</div>

					<div class="w-100 px-3 text-center mt-4">
						<a class="carousel-control-prev position-relative d-inline me-4" href="#carouselLogos" data-bs-slide="prev">
							<svg width="2em" height="2em" viewBox="0 0 16 16" class="text-dark" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
							</svg>
							<span class="visually-hidden">Previous</span>
						</a>
						<a class="carousel-control-next position-relative d-inline" href="#carouselLogos" data-bs-slide="next">
							<svg width="2em" height="2em" viewBox="0 0 16 16" class="text-dark" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
							</svg>
							<span class="visually-hidden">Next</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>