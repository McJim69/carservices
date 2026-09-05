<?php 
	require("header.php");
	require("navbar.php");
?>

<div class="content-wrapper">
	<h3 class="card-title">DOWNLOADS</h3>
	<div class="row">
		<div class="col-lg-3 grid-margin stretch-card">
			<div class="card">			
				<div class="card-body">
					<h3 class="card-title">File Uploader</h3>
					<form enctype="multipart/form-data" action="../uploads_proc.php" method="POST">
						<div class="form-group">
							<input class="form-control btn bg-light btn-block text-dark text-capitalize" type="file" name="uploaded_file">
						</div>
						<div class="form-group">
							<input class="form-control btn bg-light btn-block text-dark" type="submit" value="UPLOAD">
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="col-lg-9 grid-margin stretch-card">
			<div class="card">			
				<div class="card-body">
					<h3>Uploaded Files</h3>
					<div class="row" style="margin-top:-10px">
					
						<?php
							$ex=$link->query("SELECT * FROM downloads ORDER BY did");
							while($rs=mysqli_fetch_array($ex)){
							$file=$rs["filename"];
							$filename=preg_replace("/\\.[^.\\s]{3,4}$/", "", $file);					
							
							echo"
								<div class='col-lg-3 col-md-6 id='div_$rs[0]' style='margin:20px 0 0 0'>				
									<div class='bg-dark text-center' style='padding-top:15px;border:2px solid #545454;border-radius:5px'>
										<div>
											<div class='text-center'><a href='../download/$file'>                               
												<input class='btn btn-primary' value='Download' style='margin:5px;width:100px'></a>
												<input class='btn btn-primary' onclick=\"deleteFile('$rs[0]');\" value='Remove' style='margin:5px;width:100px'>
											</div>
										</div>
										<div class='text-center p-3'>
											<h5 class='fw-bold mb-0 text-capitalize'>$filename</h5>
											<h7>$file</h7>
										</div>
									</div>					
								</div>";
							} 
						?>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function deleteFile(did){	
		if(confirm("Are you sure you want to Remove this File?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#div_"+did).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#div_"+did).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","downloads_delete.php?did="+did,true);
			xmlhttp.send();
		}
	}	
</script>


<?php require("footer.php");?>
