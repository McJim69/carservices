<?php
	require("header.php");
	require("topbar.php");
	require("navbar.php");	
?>

<script> setActive("gallery"); </script>
<script> setActive("videos"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-1.png);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Galleries</h1>
				<h2>
					<a href="index.php">
						<input type="button" class="btn btn-primary" value="Home" style="width:100px;margin:5px">
					</a>
					<a href="pictures.php">
						<input type="button" class="btn btn-primary" value="Photos" style="width:100px;margin:5px">
					</a>
					<a href="videos.php">
						<input type="button" class="btn btn-primary" value="Videos" style="width:100px;margin:5px">
					</a>
				</h2>				
            </div>
        </div>
    </div>
<!-- Page Header End -->

<?php 
	require("videos1.php");
	require("footer.php");
?>