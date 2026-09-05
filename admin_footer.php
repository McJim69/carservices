<!-- Footer Start -->
    <div id="footer" class="container-fluid bg-dark text-light footer pt-6 mt-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Address</h4>
                    <p class="mb-2"><i class="fa fa-home me-3"></i><?php echo _POSTAL;?></p>
                    <p class="mb-2"><i class="fa fa-phone me-3"></i><?php echo _PHONE1;?> &bull; <?php echo _PHONE2;?></p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i><?php echo _EMAIL1;?></p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="<?php echo _FBPAGE;?>" target="_blank" title="Facebook Page"><i class="fab fa-facebook-f"></i></a> &nbsp; &nbsp;
                        <a class="btn btn-outline-light btn-social" href="<?php echo _YTPAGE;?>" target="_blank" title="Youtube Channel"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Opening Hours</h4>
                    <h6 class="text-light"><?php echo _ODAYS1;?>:</h6>
                    <p class="mb-4"><?php echo _OHOURS1;?></p>
                    <h6 class="text-light"><?php echo _ODAYS2;?>:</h6>
                    <p class="mb-0"><?php echo _OHOURS2;?></p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Services</h4>
                    <a class="btn btn-link" href="service.php"><?php echo _SRVCAR;?></a>
                    <a class="btn btn-link" href="service.php"><?php echo _OFFICE;?></a>
					<a class="btn btn-link" href="service.php"><?php echo _HOMEAC;?></a>
                    <a class="btn btn-link" href="service.php"><?php echo _HOMEAP;?></a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Certifications</h4>
                    <a class="btn btn-link" href=""><?php echo _CERTPG;?></a>
					<a class="btn btn-link" href=""><?php echo _CERTBP;?></a>
					<a class="btn btn-link" href=""><?php echo _CERTTI;?></a>
                    <a class="btn btn-link" href=""><?php echo _CERTEC;?></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <?php echo _FOUND;?> - <?php echo date("Y");?> &nbsp; <a class="border-bottom" href="#">Louie Car Aircon</a>, Cotabato PH &nbsp; &bull; &nbsp;
                        Powered By <a class="border-bottom" href="https://mcjim-server.com" target="_blank">McJim Cyberworks</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="index.php">Home</a>
                            <a href="disclaimer.php">Disclaimer</a>
                            <a href="terms.php">Terms</a>
                            <a href="privacy.php">Privacy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Footer End -->

<!-- Back to Top -->
<a id="backtotop" href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="lib/main/main.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/chart/chart.min.js"></script>
<script src="lib/chart/canvasjs.min.js"></script>
<script src="lib/chart/chart.loader.js"></script>
<script src="lib/chart/chart.loader.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- VenoBox Video Plugin -->
<script>
	$(document).ready(function(){
		/* default settings */
		$('.venobox').venobox(); 
		/* open content with custom settings */
		$('.venobox_custom').venobox({
			framewidth: '300px',
			frameheight: '250px',
			border: '6px',
			bordercolor: '#ba7c36',
			numeratio: true
		});
		/* auto-open #firstlink on page load */
		//$("#vlink").venobox().trigger('click');
	});
</script>

<script src="lib/venobox/venobox.min.js"></script>

</body>

</html>