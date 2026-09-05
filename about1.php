<!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 pt-4" style="min-height: 400px;">
                    <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                        <img class="position-absolute img-fluid w-100 h-100" src="img/about.jpg?<?php echo date("h:i:s");?>" style="object-fit: cover;" alt="">
                        <div class="position-absolute top-0 end-0 mt-n4 me-n4 py-4 px-5">
                            <h1 class="display-4 text-white mb-0"><?php echo date("Y") - _FOUND;?> <span class="fs-4">Years</span></h1>
                            <h4 class="text-white">Experience</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h6 class="text-primary text-uppercase">// About Us //</h6>
                    <h1 class="mb-4"><span class="text-primary"><?php echo _TITLE;?></span> <?php echo _BESTPLC;?></h1>
                    <p class="mb-4"><?php echo _SPECIAL;?></p>
                    <div class="row g-4 mb-3 pb-3">
					<?php
						$ex=$link->query("SELECT * FROM about");
						while($rs=mysqli_fetch_array($ex)){
						echo"
                        <div class='col-12 wow fadeIn' data-wow-delay='0.1s'>
                            <div class='d-flex'>
                                <div class='bg-primary d-flex flex-shrink-0 align-items-center justify-content-center mt-1' style='width: 45px; height: 45px'>
                                    <span class='fw-bold text-light'>0".$rs[0]."</span>
                                </div>
                                <div class='ps-3'>
                                    <h6><i class='text-primary ".$rs["icon"]."'></i> ".$rs["title"]."</h6>
                                    <span>".$rs["description"]."</span>
                                </div>
                            </div>
                        </div>";
						}
					?>
					</div>
                    <a href="pictures.php" class="btn btn-primary py-3 px-5">Galleries<i class="fa fa-arrow-right ms-3"></i></a>
                </div>
            </div>
        </div>
    </div>
<!-- About End -->