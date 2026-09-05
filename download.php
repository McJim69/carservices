<?php
	require("header.php");
	require("topbar.php");
	require("navbar.php");	
?>

<script> setActive("link"); </script>
<script> setActive("downloads"); </script>

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Downloadables</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page"><a href="download" style="color:#eee">Download</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<!-- Page Header End -->

<!-- Downloads Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4" style="min-height:200px;margin-top:-70px">
				<?php
					$directoryPath = 'Download'; // Replace with the actual path to your folder

					if (is_dir($directoryPath)) {
						$filesAndFolders = scandir($directoryPath);

						// Remove "." and ".." from the array
						$filteredContents = array_diff($filesAndFolders, array('.', '..'));

						$i=1;
						echo "<h2>Contents of " . htmlspecialchars($directoryPath) . "ables</h2>";
						echo "<div class='col-lg-3 col-md-6 wow fadeInUp' data-wow-delay='0.1s'>";				
						echo "<div class='box-item'>";
						echo "<ul>";
						foreach ($filteredContents as $item) {

							$fullPath = $directoryPath . '/' . $item;
							if (is_file($fullPath)) {
								echo "<li>File $i: <a href='download/" . htmlspecialchars($item) . "'>" . htmlspecialchars($item) . "</a></li>";
							$i++;
							} elseif (is_dir($fullPath)) {
								echo "<li>Folder: " . htmlspecialchars($item) . "</li>";
							}
						}
						echo "</ul></div></div>";
						
					} else {
						echo "Error: Directory not found or not accessible.";
					}
				?>
            </div>
        </div>
    </div>
<!-- Downloads End -->

<?php require("footer.php"); ?>

