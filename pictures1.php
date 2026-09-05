<link href="lib/owlcarousel/owl.carousel.min.css" rel="stylesheet" type="text/css" />

<!-- Pictures Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s" style="margin-top:-40px">
        <div class="container">
            <div class="text-center">
                <h6 class="text-primary text-uppercase">// Photos //</h6>
                <h1 class="mb-5">Pictures</h1>
            </div>
		</div>
		
		<div class="owl-carousel slider_carousel" style="padding:10px">
		<?php
			$ex=$link->query("SELECT * FROM pictures ORDER by picid") or die (mysqli_error($link));		
					
			while($rs=mysqli_fetch_array($ex)){	
			echo"<a href='img/pictures/$rs[0].jpg' class='button' id='$rs[0]'>
					<div class='card_box'>
						<img class='img-fluid w-100' src='img/pictures/resized/$rs[0].jpg'/>
						<div class='card_text text-center' style='margin-top:10px'>
							<h4>".$rs["title"]." $rs[0]</h4>
							<p style='margin-top:-5px'>".$rs["description"]." $rs[0]</p>
						</div>
					</div>
				</a>
				";
			}
		?>
		</div>
	</div>
<!-- Pictures End -->