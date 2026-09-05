<?php 
	require("header.php");
	require("topbar.php");
	require("navbar.php");
?>

<script> setActive("link"); </script>
<script> setActive("disclaimer"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Disclaimer</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Links</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Disclaimer</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<!-- Disclaimer Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div style="text-align:justify;margin-top:-50px">
					<h2>Disclaimer</h2>
					<p>
						All the information on this website <a href="https://<?php echo _DOMAIN;?>" target="_blank">www.<?php echo _DOMAIN;?></a> - 
						is published in good faith and for general information purpose only. Louie Car Aircon does not make any warranties 
						about the completeness, reliability and accuracy of this information. Any action you take upon the information you 
						find on this website (Louie Car Aircon), is strictly at your own risk. Louie Car Aircon will not be liable for any 
						losses and/or damages in connection with the use of our website.
					</p>
					<p>
						From our website, you can visit other websites by following hyperlinks to such external sites. While we strive to 
						provide only quality links to useful and ethical websites, we have no control over the content and nature of these sites. 
						These links to other websites do not imply a recommendation for all the content found on these sites. Site owners and 
						content may change without notice and may occur before we have the opportunity to remove a link which may have gone 'bad'.
					</p>
					<p>
						Please be also aware that when you leave our website, other sites may have different privacy policies and terms which are 
						beyond our control. Please be sure to check the <a href="privacy.php">Privacy Policies</a> of these sites as well as their 
						"<a href="terms.php">Terms of Service</a>" before engaging in any business or uploading any information.
					</p>

					<h3>Consent</h3>
					<p>
						By using our website, you hereby consent to our disclaimer and agree to its terms.
					</p>

					<h3>Update</h3>
					<p>
						Should we update, amend or make any changes to this document, those changes will be prominently posted here.
					</p>
					<h3>Contact Us</h3>
					<p>If you have any questions about this Privacy Policy, You can contact us:</p>
					<ul>
					<li>
					<p>By email: <a href="contact.php"> <?php echo _EMAIL1;?></a></p>
					</li>
					<li>
					<p>By phone: <?php echo _PHONE1;?> &bull; <?php echo _PHONE2;?></p>
					</li>
					</ul>						
					</p>
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php">Go Back To Home</a>
                </div>
            </div>
        </div>
    </div>
<!-- Disclaimer End -->
        
<?php require("footer.php");?>