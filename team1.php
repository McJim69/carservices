<!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container text-center">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">// Our Technicians //</h6>
                <h1 class="mb-5">Our Expert Technicians</h1>
            </div>
            <div class="row g-4 justify-content-center">
				<?php
					$ex=$link->query("SELECT * FROM technicians ORDER by tech_id") or die (mysqli_error($link));		

					while($rs=mysqli_fetch_array($ex)){	
					
					$tecid = $rs[0];
					$fname = $rs["fullname"];
					$postn = $rs["position"];
					$fblnk = $rs["facebook"];
					$phone = $rs["mobphone"];
					
					echo"
						<div class='col-lg-3 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>
							<div class='team-item'>
								<div class='position-relative overflow-hidden'>
									<img class='img-fluid bg-light' src='img/technicians/resized/$tecid.jpg?".date("h:i:s")."' alt='' width='100%'>
									<div class='team-overlay position-absolute start-0 top-0 w-100 h-100'>
										<a class='btn btn-square mx-1' href='$fblnk' title='Facebook'><i class='fab fa-facebook-f'></i></a>
										<a class='btn btn-square mx-1' href='$phone' title='Cell Phone'><i class='fa fa-phone'></i></a>
									</div>
								</div>
								<div class='bg-light text-center p-4'>
									<h5 class='fw-bold mb-0'>$fname</h5>
									<small>$postn</small>
								</div>
							</div>
						</div>
						
						";
					}
				?>
            </div>
        </div>
    </div>
<!-- Team End -->