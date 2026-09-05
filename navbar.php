<!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary">
				<i class="fa fa-car me-3"></i>
				<!--<img src="img/favicon.png" height="40" style="margin:0">-->
				<?php echo _TITLE;?>
			</h2>
			<div style="margin-left:10px">
				<?php
					$ex = $link->query("SELECT site_mode FROM siteinfo") or die (mysqli_error($link));
					while($rs=mysqli_fetch_array($ex)){	
						if(($rs[0])!=="Production"){ 
							echo"<small class='blinking text-primary'>"._SMODE."</small>";
						}
					}
				?>
			</div>			
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" id="home" class="nav-item nav-link">Home</a>
                <a href="about.php" id="about" class="nav-item nav-link">About</a>
                <a href="service.php" id="service" class="nav-item nav-link">Services</a>
				<a href="products.php" id="products" class="nav-item nav-link">Products</a>
				<a href="booking.php" id="booking" class="nav-item nav-link">Booking</a>
                <a href="contact.php" id="contact" class="nav-item nav-link">Contact</a>
                <div class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="link" data-bs-toggle="dropdown">Links</a>
                    <div class="dropdown-menu fade-up m-0">
						<a href="pictures.php" id="pictures" class="dropdown-item">Galleries</a>
                        <a href="disclaimer.php" id="disclaimer" class="dropdown-item">Disclaimer</a>
						<a href="team.php" id="teams" class="dropdown-item">Technician</a>
						<!--<a href="testimonial.php" id="clients" class="dropdown-item">Testimonial</a>-->
                        <a href="terms.php" id="terms" class="dropdown-item">Terms of Use</a>
						<a href="privacy.php" id="privacy" class="dropdown-item">Privacy Policy</a>
						<a href="download.php" id="downloads" class="dropdown-item">Downloadable</a>
                    </div>
				</div>
                <a href="admin2/" id='admin' class="nav-item nav-link">Admin</a>
            </div>
        </div>
    </nav>
<!-- Navbar End -->