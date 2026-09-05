<!-- Service Start -->
    <div class="container-xxl service py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">// Our Services //</h6>
                <h1 class="mb-5">Explore Our Services</h1>
            </div>
            <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-4">
                    <div class='nav w-100 nav-pills me-4'>
						<?php 
							$ex=$link->query("SELECT * FROM services");
							while($rs=mysqli_fetch_array($ex)){ 
								echo"
								<button class='nav-link w-100 d-flex align-items-center text-start p-4 mb-4 ";
									if($rs[0]=="1"){ echo" active'";} else { echo" '";}
								echo"
									 data-bs-toggle='pill' data-bs-target='#tab-pane-".$rs[0]."' type='button'>
									<i class='fa ".$rs["service_font"]." fa-2x me-3'></i>
									<h4 class='m-0'>".$rs["service_name"]."</h4>
								</button>";
							} 
						?>
					</div>
                </div>
				<div class='col-lg-8'>
					<div class='tab-content w-100'>
						<?php 
							$ex=$link->query("SELECT * FROM services");
							while($rs=mysqli_fetch_array($ex)){ 	
							$exp = date("Y") - _FOUND;
							echo"
								<div class='tab-pane fade ";
								if($rs[0]=="1"){ echo" show active'";} else { echo" show'";} 
								echo" id='tab-pane-".$rs[0]."'>
									<div class='row g-4'>
										<div class='col-md-6' style='min-height: 350px'>
											<div class='position-relative h-100'>
												<img class='position-absolute img-fluid w-100 h-100' src='img/services/".$rs[0].".jpg?".date("h:i:s")."'
													style='object-fit: cover' alt=''>
											</div>
										</div>
										<div class='col-md-6'>
											<h3 class='mb-3'>".$exp." Years Experience ".$rs["service_name"]." Services</h3>
											<p class='mb-4'>We've specialized in ".$rs["service_name"]." Repair and Maintenance since "._FOUND.".</p>
											<p><i class='fa fa-check text-success me-3'></i>".$rs["service_expt"]."</p>
											<p><i class='fa fa-check text-success me-3'></i>".$rs["service_qlty"]."</p>
											<p><i class='fa fa-check text-success me-3'></i>".$rs["service_mdrn"]."</p>
											<a href='products.php' class='btn btn-primary py-3 px-5 mt-3'>Products<i class='fa fa-arrow-right ms-3'></i></a>
										</div>
									</div>
								</div>";							
							} 
						?>
					</div>
				</div>
			</div>
		</div>				
    </div>
<!-- Service End -->
