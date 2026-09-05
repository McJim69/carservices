<?php 
	require('header.php');
	require('navbar.php');
?>

<div class='content-wrapper'>

<h3 class='card-title'>Database Management <small><i class='fa fa-arrow-right'></i></small> Tables</h3>

<div class='row'>

<?php
			
	if(isset($_POST["videos"])){
		$empty=$link->query("DROP TABLE IF EXISTS videos");
		$empty=$link->query("CREATE TABLE IF NOT EXISTS videos (
			vid int(4) NOT NULL AUTO_INCREMENT,
			title varchar(200) DEFAULT NULL,
			source varchar(200) DEFAULT NULL,
			PRIMARY KEY (vid))");
	}
	if(isset($_POST["downloads"])){			
		$empty=$link->query("DROP TABLE IF EXISTS downloads");
		$empty=$link->query("CREATE TABLE IF NOT EXISTS downloads (
			did int(11) NOT NULL AUTO_INCREMENT,
			filename varchar(100) DEFAULT NULL,
			PRIMARY KEY (did))")or die(mysqli_error($link));
	}
	if(isset($_POST["pictures"])){			
		$empty=$link->query("DROP TABLE IF EXISTS pictures");
		$empty=$link->query("CREATE TABLE IF NOT EXISTS pictures (
			picid int(11) NOT NULL AUTO_INCREMENT,
			title varchar(100) DEFAULT NULL,
			description varchar(200) DEFAULT NULL,
			photo int(11) NOT NULL DEFAULT '0',
			PRIMARY KEY (picid))")or die(mysqli_error($link));
	}
	if(isset($_POST["products"])){			
		$empty=$link->query("DROP TABLE IF EXISTS products");
		$empty=$link->query("CREATE TABLE IF NOT EXISTS products (
			product_id int(11) NOT NULL AUTO_INCREMENT,
			product_stock int(11) DEFAULT NULL,
			product_unit varchar(10) DEFAULT NULL,
			product_name varchar(50) DEFAULT NULL,
			product_category varchar(50) DEFAULT NULL,
			description varchar(200) DEFAULT NULL,
			product_price int(11) NOT NULL DEFAULT '0',
			prod_min_stock int(11) NOT NULL DEFAULT '0',
			product_img int(4) NOT NULL DEFAULT '0',
			PRIMARY KEY (product_id))")or die(mysqli_error($link));
	}
	if(isset($_POST["technicians"])){			
		$empty=$link->query("DROP TABLE IF EXISTS technicians");
		$empty=$link->query("CREATE TABLE IF NOT EXISTS technicians (
			tech_id int(11) NOT NULL,
			fullname varchar(100) DEFAULT NULL,
			position varchar(100) DEFAULT NULL,
			facebook varchar(100) DEFAULT NULL,
			mobphone varchar(100) DEFAULT NULL,
			photo_id int(4) NOT NULL DEFAULT '0',
			PRIMARY KEY (tech_id))")or die(mysqli_error($link));
	}
	if(isset($_POST["todo"])){			
		$empty=$link->query("DROP TABLE IF EXISTS todo")or die(mysqli_error($link));
		$empty=$link->query("CREATE TABLE IF NOT EXISTS todo (
			todo_idn int(4) NOT NULL AUTO_INCREMENT,
			todo_uid int(4) NOT NULL,
			todo_txt varchar(300) NOT NULL,
			PRIMARY KEY (todo_idn))")or die(mysqli_error($link));
	}
	if(isset($_POST["months"])){			
		$empty=$link->query("DROP TABLE IF EXISTS months")or die(mysqli_error($link));
		$empty=$link->query("CREATE TABLE IF NOT EXISTS months (
			mosid varchar(2) NOT NULL,
			mcode varchar(3) DEFAULT NULL,
			mname varchar(10) DEFAULT NULL)")or die(mysqli_error($link));
	}
	if(isset($_POST["transactions"])){			
		$empty=$link->query("DROP TABLE IF EXISTS transactions")or die(mysqli_error($link));
		$empty=$link->query("CREATE TABLE IF NOT EXISTS transactions (
			serv_id int(11) NOT NULL AUTO_INCREMENT,
			user_id int(11) NOT NULL,
			serv_date date NOT NULL,
			serv_categ varchar(100) DEFAULT NULL,
			serv_client varchar(100) DEFAULT NULL,
			cust_id int(11) NOT NULL,
			unit_make varchar(100) DEFAULT NULL,
			unit_model varchar(100) DEFAULT NULL,
			serv_desc varchar(200) DEFAULT NULL,
			technician varchar(50) NOT NULL,
			labor_cost int(11) DEFAULT NULL,
			payment varchar(50) NOT NULL,
			remarks varchar(200) NOT NULL,
			photo int(4) NOT NULL DEFAULT '0',
			PRIMARY KEY (serv_id))")or die(mysqli_error($link));

		$empty=$link->query("DROP TABLE IF EXISTS trans_details")or die(mysqli_error($link));
		$empty=$link->query("CREATE TABLE IF NOT EXISTS trans_details (
			dets_idno int(11) NOT NULL AUTO_INCREMENT,
			serv_id int(11) NOT NULL,
			product_id int(11) DEFAULT NULL,
			product_name varchar(50) NOT NULL,
			product_stock int(11) NOT NULL,
			product_qnty int(11) NOT NULL,
			product_unit varchar(50) DEFAULT NULL,
			product_price int(11) NOT NULL,
			serv_date date NOT NULL,
			payment varchar(50) DEFAULT NULL,
			PRIMARY KEY (dets_idno),
			KEY product_id (product_id))")or die(mysqli_error($link));					
	}
	if(isset($_POST["units"])){			
		$empty=$link->query("DROP TABLE IF EXISTS units")or die(mysqli_error($link));
		$empty=$link->query("CREATE TABLE IF NOT EXISTS units (
			unit_id int(11) NOT NULL AUTO_INCREMENT,
			unit_name varchar(100) DEFAULT NULL,
			description varchar(200) DEFAULT NULL,
			PRIMARY KEY (unit_id))")or die(mysqli_error($link));
	}
	if(isset($_POST["manufacturer"])){			
		$empty=$link->query("DROP TABLE IF EXISTS manufacturer")or die(mysqli_error($link));
		$empty=$link->query("CREATE TABLE IF NOT EXISTS manufacturer (
		mfid int(11) NOT NULL AUTO_INCREMENT,
		name varchar(100) DEFAULT NULL,
		logo int(4) NOT NULL DEFAULT '0',
		PRIMARY KEY (mfid)
		)")or die(mysqli_error($link));
	}
	if(isset($_POST["customers"])){			
		$empty=$link->query("DROP TABLE IF EXISTS customers")or die(mysqli_error($link));
		$empty=$link->query("CREATE TABLE IF NOT EXISTS customers (
			cid int(11) NOT NULL,
			fullname varchar(100) DEFAULT NULL,
			position varchar(100) DEFAULT NULL,
			address varchar(100) DEFAULT NULL,
			phone varchar(100) DEFAULT NULL,
			testimony varchar(200) DEFAULT NULL,
			photo int(4) NOT NULL DEFAULT '0',
			PRIMARY KEY (cid),
			UNIQUE KEY fullname (fullname))")or die(mysqli_error($link));
	}
	if(isset($_POST["categories"])){			
		$empty=$link->query("DROP TABLE IF EXISTS categories")or die(mysqli_error($link));
		$empty=$link->query("CREATE TABLE IF NOT EXISTS categories (
			cat_id int(11) NOT NULL AUTO_INCREMENT,
			cat_name varchar(100) DEFAULT NULL,
			description varchar(200) DEFAULT NULL,
			fonticon varchar(100) DEFAULT NULL,
			PRIMARY KEY (cat_id))")or die(mysqli_error($link));
	}		

	$i=1;

	$ex=$link->query("SELECT * FROM tables ORDER BY tabname");

	while($rs=mysqli_fetch_array($ex)){
		$tabid=$rs[0];
		$table=$rs["tabname"];
		$query=$rs["tabquery"];

		$qry=$link->query("SELECT * FROM $query");
		$rec=mysqli_num_rows($qry);
		$tot=number_format($rec);

		echo"
		
		<div class='col-xl-3 col-sm-6 grid-margin stretch-card'>
			<div class='card'>
				<div class='card-body'>
					<div class='row'>
						<div class='col-9'>
							<div class='d-flex align-items-center align-self-start'>(<b>$i</b>) &nbsp;
								<h3 class='mb-0'>$table</h3>
								<p class='text-success ml-2 mb-0 font-weight-medium'></p>
							</div>
						</div>
						<div class='col-3'>
							<form action='#' method='POST' enctype='multipart/form-data'>
								<input
									name='$query'
									type='submit'
									value='Empty'
									class='btn btn-outline-success btn-block' 
									onclick=\"return confirm('Are you sure to empty $table Records?')\"
								>
							</form>
						</div>
					</div>
					<h5 class='text-muted font-weight-normal'>
						<a href='$query.php'><i class='fa fa-eye'></i> View</a> 
						<b class='text-success'> $tot</b> Records 
					</h5>
				</div>
			</div>
		</div>	

	";

	$i++;
	}
?>

</div>
</div>

<?php require('footer.php');?>
