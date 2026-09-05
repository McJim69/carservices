<!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">

				<?php
					$ex=$link->query("SELECT * FROM about");
					while($rs=mysqli_fetch_array($ex)){

					echo"
					
					<div class='col-lg-4 col-md-6 wow fadeInUp' data-wow-delay='0.1s'>
						<div class='d-flex bg-light py-5 px-4'>
							<i class='".$rs["icon"]." fa-3x text-primary flex-shrink-0'></i>
							<div class='ps-4'>
								<h5 class='mb-3'>".$rs["title"]."</h5>
								<p>".$rs["description"]."</p>
							</div>
						</div>
					</div>";
					
					}
				?>
			
            </div>
        </div>
    </div>
<!-- Service End -->