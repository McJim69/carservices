<?PHP
	require("connect.php");
	if(!empty($_FILES['uploaded_file'])){
		
		$path = "Download/";
		$path = $path . basename( $_FILES['uploaded_file']['name']);

		if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
    
			$file = basename( $_FILES['uploaded_file']['name']);		
					
			$link->query("INSERT INTO downloads VALUES(0, '".$file."')");
			
			header("location:admin_downloads.php");
			
			}else{
				
			echo"
			<script>
				alert('There was an error uploading $file file, please try again!');
				window.location.href = 'admin_downloads.php';
			</script>";
		}
	}
?>
