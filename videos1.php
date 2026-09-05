<!-- Videos Start -->
    <div class="container-xxl py-5" style='margin-top:-70px'>
        <div class="container">		
            <div class="text-center">
                <h6 class="text-primary text-uppercase">// Videos //</h6>
                <h1 class="mb-5">Videos</h1>
            </div>
				
            <div class='row g-4'>
			<?php
				$ex=$link->query("SELECT * FROM videos ORDER by vid") or die (mysqli_error($link));		

				while($rs=mysqli_fetch_array($ex)){	
				
				$src = $rs["source"];
				$yid = trim($src,"https://www.youtube.com/watch?v=");
				$img = "https://img.youtube.com/vi/$yid/hqdefault.jpg";

				echo"
					<div class='col-lg-3 col-md-6 wow fadeInUp' data-wow-delay='0.1s' id='div_$rs[0]'>
						<div class='team-item'>
							<div class='position-relative overflow-hidden bg-light'>
							<img class='img-fluid' width='100%' src='$img' title='Youtube' alt='Youtube' />
								<div class='team-overlay position-absolute start-0 top-0 w-100 h-100' style='background:transparent;border:0'>								
									<a id='vlink' href='$src' class='venobox' data-vbtype='video' data-autoplay='true'>
										<img src='img/play.png' height='150' style='border:0'/>
									</a>
								</div>
							</div>
							<div class='text-center p-4 bg-primary'>
								<h5 class='text-light fw-bold mb-0 text-uppercase'>".$rs["title"]."</h5>
							</div>
						</div>
					</div>
					
					";
				}
			?>
            </div>
        </div>
    </div>
<!-- Videos End -->	