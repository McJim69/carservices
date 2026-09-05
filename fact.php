<?php
	//Count Technician
	$qryTEK = $link->query("SELECT COUNT(tech_id) AS total FROM technicians");
	$resTEK = mysqli_fetch_array($qryTEK);
	$totTEK = $resTEK["total"];
	
	//Count Clients
	$qryCUS = $link->query("SELECT COUNT(cid) AS total FROM customers");
	$resCUS = mysqli_fetch_array($qryCUS);
	$totCUS = $resCUS["total"];

	//Count Projects
	$qryPRO = $link->query("SELECT COUNT(serv_id) AS total FROM transactions");
	$resPRO = mysqli_fetch_array($qryPRO);
	$totPRO = $resPRO["total"];
?>

<!-- Fact Start -->
    <div class="container-fluid fact bg-dark my-5 py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <i class="fa fa-check fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up"><?php echo date("Y") - _FOUND;?></h2>
                    <p class="text-white mb-0">Years Experience</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <i class="fa fa-users-cog fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up"><?php echo $totTEK;?></h2>
                    <p class="text-white mb-0">Expert Technicians</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <i class="fa fa-users fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up"><?php echo $totCUS;?></h2>
                    <p class="text-white mb-0">Satisfied Clients</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <i class="fa fa-car fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up"><?php echo $totPRO;?></h2>
                    <p class="text-white mb-0">Compleate Projects</p>
                </div>
            </div>
        </div>
    </div>
<!-- Fact End -->
