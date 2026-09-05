<!-- Topbar Start -->
    <div class="container-fluid bg-light p-0" id="topbar">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-home text-primary me-2"></small>
                    <small><?php echo _POSTAL;?></small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-user text-primary me-2"></small>
                    <small>Welcome &nbsp; <b><?php echo $_SESSION["fnam"];?> <?php echo $_SESSION["lnam"];?></b></small>
                </div>
				&nbsp; &nbsp;
                <div class="h-100 d-inline-flex align-items-center py-3">
					<a href="download/louie-car-aircon.apk">
					<small class="fa fa-download text-primary me-2"></small>
					<small>Download Apps</small>
					</a>
                </div>
				&nbsp; &nbsp;
				<?php
					$ex = $link->query("SELECT site_mode FROM siteinfo") or die (mysqli_error($link));
					while($rs=mysqli_fetch_array($ex)){	
						if(($rs[0])!=="Production"){ 
							echo"
								<div class='h-100 d-inline-flex align-items-center py-3'>
									<small class='fa fa-bullhorn text-primary me-2'></small>
									<small class='text-danger blinking'>"._SMODE." Mode</small>
								</div>
							";
						}
					}
				?>			
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small><?php require("time.php");?></small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="<?php echo _FBPAGE;?>" target="_blank" title="Facebook Page"><i class="fab fa-facebook-f"></i></a> &nbsp; &nbsp;
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="<?php echo _YTPAGE;?>" target="_blank" title="Youtube Channel"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>	
<!-- Topbar End -->
