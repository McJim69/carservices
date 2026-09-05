<?php 
	$ID = $_SESSION['usid'];

	if(isset($_POST['todoSubmit'])){
		$insert = $link->query("INSERT INTO todo VALUES(0, '".$_POST['todo_uid']."', '".$_POST['todo_txt']."','')") or die(mysqli_error($link));
	}
?>	

<div class="card">
	<div class="card-body">
		<h4>To Do List</h4>
		<form action="#" method="POST" enctype="multipart/form-data" style="margin-bottom:10px">
			<input type="hidden" value="<?php echo $id;?>" name="todo_uid">
			<div class="co-xl-12 col-lg-12 col-md-12 col-sm-12" style="width:100%;padding:0">
				<input style="width:80%;text-align:left" class="btn btn-secondary" type="text"   name="todo_txt" placeholder="Enter task..." required/>
				<input style="width:18%;padding:7px" class="btn btn-secondary" type="SUBMIT" value="+ADD" name="todoSubmit">
			</div>	
		</form>
		<div class="table-responsive" style="height:342px">
			<table class="table table-dark table-hover">
				<tbody>
				<?php
					
					$i=1;
					
					$cls = "style='height:40px;padding:5px'";
					
					$ext = $link->query("SELECT * FROM todo WHERE todo_uid = '$id' ORDER BY todo_idn DESC");
					
					while($rst=mysqli_fetch_array($ext)){
						
					if($rst["status"]=="OK"){
						$okbtn = "
							<button class='btn btn-sm btn-outline-success'>
								<i class='fa fa-thumbs-up'></i>
							</button>";
						$oktxt = "<x style='text-decoration: line-through;color:gray'>".$rst["todo_txt"]."</x>";
					}else{						
						$okbtn = "
							<button class='btn btn-sm btn-outline-warning' onclick=\"todoUpdate('$rst[0]');\" title='Update'>
								<i class='fa fa-question'></i>
							</button>";
							
						$oktxt = "<x style='text-decoration: none;color:#fff'>".$rst["todo_txt"]."</x>";
					}
					
					echo" 
						<tr class='text-secondary' style='opacity:0.8' id='tr_".$rst[0]."'>
							<td width='1%' $cls class='text-center'>$i.</td>
							<td $cls>$oktxt</td>
							<td width='3%' $cls class='text-center'>$okbtn</td>
						</tr>";
						$i++;
						}
					?>
				</tbody>
			</table>	
		</div>
	</div>
</div>

<script>
	function todoUpdate(todo_idn){	
		if(confirm("Update this list as accomplished?")){
			xmlhttp.open("GET","todo_update.php?todo_idn="+todo_idn,true);
			xmlhttp.send();
		}
		window.location.href = 'index.php';
	}	
</script>