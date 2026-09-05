<!--BACKUP FORM-->
	<!--BACKUP-->
		<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-9">
							<div class="d-flex align-items-center align-self-start">
								<h3 class="mb-0">Backup DB</h3>
								<p class="text-success ml-2 mb-0 font-weight-medium"></p>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="icon text-center">
								<button 
									type="submit" 
									name="backup" 
									class="btn btn-outline-success btn-block" 
									onclick="return confirm('Execute backup now?')"
								><i class="fa fa-database text-center"></i>
								</button>
							</div>
						</div>
					</div><h6 class="text-muted font-weight-normal">Backup Latest Records</h6>
				</div>
			</div>
		</div>	
	<!--RESTORE-->		
		<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-9">
							<div class="d-flex align-items-center align-self-start">
								<h3 class="mb-0">Restore DB</h3>
								<p class="text-success ml-2 mb-0 font-weight-medium"></p>
							</div>
						</div>
						<div class="col-3">
							<div class="icon text-center">
							<button 
								type="button" 
								onclick="$('#file').click();" 
								class="btn btn-outline-success btn-block" 
							><i class="fa fa-upload text-center"></i>
							</button>
							<input 
								id="file" 
								type="file" 
								name="file" 
								style="display:none" 
								onchange="$('#upload').click();" 
							/>
							<input 
								id="upload" 
								type="submit" 
								name="upload" 
								value="Submit" 
								style="display:none" 
							/>							
							</div>
						</div>
					</div><h6 class="text-muted font-weight-normal">Restore Latest Records</h6>
				</div>
			</div>
		</div>	
	<!--EMPTY-->				
		<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-9">
							<div class="d-flex align-items-center align-self-start">
								<h3 class="mb-0">Erase DB</h3>
								<p class="text-success ml-2 mb-0 font-weight-medium"></p>
							</div>
						</div>
						<div class="col-3">
							<div class="icon text-center">
								<button 
									name="erase" 
									type="submit" 
									class="btn btn-outline-success btn-block" 
									onclick="return confirm('WARNING! Are you sure to empty the Database? Make sure to Backup before continuing this operation. If you are not sure, hit Cancel button to discontinue.')" 
								><i class="fa fa-trash text-center"></i>
								</button>
							</div>
						</div>
					</div><h6 class="text-muted font-weight-normal">Empty All Records</h6>
				</div>
			</div>
		</div>	
	<!--EMPTY SELECTED TABLES-->				
		<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-9">
							<div class="d-flex align-items-center align-self-start">
								<h3 class="mb-0">Select DB</h3>
								<p class="text-success ml-2 mb-0 font-weight-medium"></p>
							</div>
						</div>
						<div class="col-3">
							<div class="icon text-center">
								<a 
									href="erase_select.php" 
									class="btn btn-outline-success btn-block" 
								><i class="fa fa-check text-center"></i>
								</a>
							</div>
						</div>
					</div><h6 class="text-muted font-weight-normal">Select Records to Erase</h6>
				</div>
			</div>
		</div>	
	<!--EMPTY SELECTED TABLES-->
<!-- BACKUP FORM END -->

