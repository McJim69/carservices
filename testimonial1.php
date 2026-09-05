<!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="text-primary text-uppercase">// Testimonial //</h6>
                <h1 class="mb-5">Our Clients Say!</h1>
            </div>
			<div class='owl-carousel testimonial-carousel position-relative'>

				<?php
					$ex=$link->query("SELECT * FROM customers ORDER BY cid LIMIT 1") or die (mysqli_error($link));		

					while($rs=mysqli_fetch_array($ex)){	
					echo"
						<div class='testimonial-item text-center'>
							<img class='bg-light rounded-circle p-2 mx-auto mb-3' src='img/user.png' style='width: 80px; height: 80px'>
							<h5 class='mb-0'>".$rs["fullname"]."</h5>
							<p>".$rs["position"]."</p>
							<div class='testimonial-text bg-light text-center p-4'>
							<p class='mb-0'>".$rs["testimony"]."</p>
							</div>
						</div>
					
					";
					}
				?>
			</div>
        </div>
    </div>
<!-- Testimonial End -->