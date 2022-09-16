<?php 
    require 'validator.php';
    require_once 'conn.php'
?>


<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/specialities.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:49 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Hilltop - Donations</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="assets/css/feathericon.min.css">
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

		<style>
		
		.date
		{
  			cursor: pointer;
  			padding: 18px;
  			width: 100%;
  			border: none;
  			text-align: left;
  			outline: none;
		}

		.date:hover
		{
			background-color: #1ABC9C;
			color:#ffff;
		}

		.programme-list
		{
			margin-top:20px;
			margin-bottom:20px;
		}

		.programme-list a
		{
			color:#333;
		}

		.programme-list a:hover
		{
			color:#117A65;
		}

		.fa-caret-down
		{
			float:right;
		}

		.fa-bars
		{
			font-size:25px;
		}

		.fa-check-circle-o
		{
			color:#CB4335;
		}

		</style>

    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="home.php" class="logo">
						<img src="assets/img/logo.png" alt="Logo">
					</a>
					<a href="home.php" class="logo logo-small">
						<img src="assets/img/logo-small.png" alt="Logo" width="30" height="30">
					</a>
                </div>
				<!-- /Logo -->
				
				<a href="javascript:void(0);" id="toggle_btn">
					<i class="fe fe-text-align-left"></i>
				</a>
				
				<!-- Mobile Menu Toggle -->
				<a class="mobile_btn" id="mobile_btn">
					<i class="fa fa-bars"></i>
				</a>
				<!-- /Mobile Menu Toggle -->
				
				<!-- Header Right Menu -->
				<ul class="nav user-menu">
					
					<!-- User Menu -->
					<?php 
                		$query = mysqli_query($conn, "SELECT * FROM `admin` WHERE `user_id` = '$_SESSION[user]'") or die(mysqli_error());
                		$fetch = mysqli_fetch_array($query);
            		?>
					<li class="nav-item dropdown has-arrow">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img"><img class="rounded-circle" src="<?php echo $fetch['img']; ?>" width="31" alt="Ryan Taylor"></span>
						</a>
						<div class="dropdown-menu">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src="<?php echo $fetch['img']; ?>" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6><?php echo $fetch['name']; ?></h6>
									<p class="text-muted mb-0"><?php echo $fetch['status']; ?></p>
								</div>
							</div>
							<a class="dropdown-item" href="profile.php">My Profile</a>
							<a class="dropdown-item" href="logout.php">Logout</a>
						</div>
					</li>
					<!-- /User Menu -->
					
				</ul>
				<!-- /Header Right Menu -->
				
            </div>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li> 
								<a href="home.php"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>

							<li> 
								<a href="programmes.php"><i class="fe fe-activity"></i> <span>Programmes</span></a>
							</li>

							<li class="active"> 
								<a href="booking.php"><i class="fe fe-bookmark"></i> <span>Donations</span></a>
							</li>

							<div class="brand-logo">
								<img class="img-fluid" src="assets/img/eternity-white.png" alt="Logo">
							</div>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-7 col-auto">
								<h3 class="page-title">Donations</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Donations</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover table-center mb-0">
											<thead>
												<tr>
													<th class="text-left">List of Dates</th>
												</tr>
											</thead>
											<tbody>

											<tr>
												<td>
													<h3><button type="button" class="date" data-toggle="collapse" data-target="#Sunday"><i class="fa fa-bars" aria-hidden="true"></i> Sunday <i class="fa fa-caret-down" aria-hidden="true"></i></button></h3>
														<div id="Sunday" class="collapse">
														<p style="margin-left:20px; margin-top:20px;">Programme List</p>
															<ul style="list-style: none;">

																<?php
																	$day = 7;
																	$z = $conn->query("SELECT * FROM programmes WHERE `p_date` = '$day' ORDER BY p_id ASC") or die ($conn->error());
																	$rowcount=mysqli_num_rows($z);
																	
																	if($rowcount == 0)
																	{?>
																		<p style="color:#CB4335;"><?php echo "No Programmes Available!"; ?></p>
															<?php	}

																	while($row = $z->fetch_array())
																	{
																	?>
																		<li class="programme-list"><a href="check-out.php?pid=<?php echo $row['p_id']; ?>"><h4><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo $row['p_name']; ?><div class="badge badge-info" style="font-size: 20px; float:right; margin-right:30px;">LKR <?php echo $row['rate']; ?></div></h4></a></li>
															<?php   }

																?>

															</ul>
														</div>
												</td>
											</tr>
											
											<tr>
												<td>
													<h3><button type="button" class="date" data-toggle="collapse" data-target="#Monday"><i class="fa fa-bars" aria-hidden="true"></i> Monday <i class="fa fa-caret-down" aria-hidden="true"></i></button></h3>
														<div id="Monday" class="collapse">
															<p style="margin-left:20px; margin-top:20px;">Programme List</p>
															<ul style="list-style: none;">

																<?php
																	$day = 1;
																	$z = $conn->query("SELECT * FROM programmes WHERE `p_date` = '$day' ORDER BY p_id ASC") or die ($conn->error());
																	$rowcount=mysqli_num_rows($z);
																	
																	if($rowcount == 0)
																	{?>
																		<p style="color:#CB4335;"><?php echo "No Programmes Available!"; ?></p>
															<?php	}

																	while($row = $z->fetch_array())
																	{
																	?>
																		<li class="programme-list"><a href="check-out.php?pid=<?php echo $row['p_id']; ?>"><h4><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo $row['p_name']; ?> <div class="badge badge-info" style="font-size: 20px; float:right; margin-right:30px;">LKR <?php echo $row['rate']; ?></div></h4></a></li>
															<?php   }

																?>

															</ul>
														</div>
												</td>
											</tr>

											<tr>
												<td>
													<h3><button type="button" class="date" data-toggle="collapse" data-target="#Tuesday"><i class="fa fa-bars" aria-hidden="true"></i> Tuesday <i class="fa fa-caret-down" aria-hidden="true"></i></button></h3>
														<div id="Tuesday" class="collapse">
														<p style="margin-left:20px; margin-top:20px;">Programme List</p>
															<ul style="list-style: none;">

																<?php
																	$day = 2;
																	$z = $conn->query("SELECT * FROM programmes WHERE `p_date` = '$day' ORDER BY p_id ASC") or die ($conn->error());
																	$rowcount=mysqli_num_rows($z);
																	
																	if($rowcount == 0)
																	{?>
																		<p style="color:#CB4335;"><?php echo "No Programmes Available!"; ?></p>
															<?php	}

																	while($row = $z->fetch_array())
																	{
																	?>
																		<li class="programme-list"><a href="check-out.php?pid=<?php echo $row['p_id']; ?>"><h4><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo $row['p_name']; ?><div class="badge badge-info" style="font-size: 20px; float:right; margin-right:30px;">LKR <?php echo $row['rate']; ?></div></h4></a></li>
															<?php   }

																?>

															</ul>
														</div>
												</td>
											</tr>

											<tr>
												<td>
													<h3><button type="button" class="date" data-toggle="collapse" data-target="#Wednesday"><i class="fa fa-bars" aria-hidden="true"></i> Wednesday <i class="fa fa-caret-down" aria-hidden="true"></i></button></h3>
														<div id="Wednesday" class="collapse">
														<p style="margin-left:20px; margin-top:20px;">Programme List</p>
															<ul style="list-style: none;">

																<?php
																	$day = 3;
																	$z = $conn->query("SELECT * FROM programmes WHERE `p_date` = '$day' ORDER BY p_id ASC") or die ($conn->error());
																	$rowcount=mysqli_num_rows($z);
																	
																	if($rowcount == 0)
																	{?>
																		<p style="color:#CB4335;"><?php echo "No Programmes Available!"; ?></p>
															<?php	}

																	while($row = $z->fetch_array())
																	{
																	?>
																		<li class="programme-list"><a href="check-out.php?pid=<?php echo $row['p_id']; ?>"><h4><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo $row['p_name']; ?><div class="badge badge-info" style="font-size: 20px; float:right; margin-right:30px;">LKR <?php echo $row['rate']; ?></div></h4></a></li>
															<?php   }

																?>

															</ul>
														</div>
												</td>
											</tr>

											<tr>
												<td>
													<h3><button type="button" class="date" data-toggle="collapse" data-target="#Thursday"><i class="fa fa-bars" aria-hidden="true"></i> Thursday <i class="fa fa-caret-down" aria-hidden="true"></i></button></h3>
														<div id="Thursday" class="collapse">
														<p style="margin-left:20px; margin-top:20px;">Programme List</p>
															<ul style="list-style: none;">

																<?php
																	$day = 4;
																	$z = $conn->query("SELECT * FROM programmes WHERE `p_date` = '$day' ORDER BY p_id ASC") or die ($conn->error());
																	$rowcount=mysqli_num_rows($z);
																	
																	if($rowcount == 0)
																	{?>
																		<p style="color:#CB4335;"><?php echo "No Programmes Available!"; ?></p>
															<?php	}

																	while($row = $z->fetch_array())
																	{
																	?>
																		<li class="programme-list"><a href="check-out.php?pid=<?php echo $row['p_id']; ?>"><h4><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo $row['p_name']; ?><div class="badge badge-info" style="font-size: 20px; float:right; margin-right:30px;">LKR <?php echo $row['rate']; ?></div></h4></a></li>
															<?php   }

																?>

															</ul>
														</div>
												</td>
											</tr>

											<tr>
												<td>
													<h3><button type="button" class="date" data-toggle="collapse" data-target="#Friday"><i class="fa fa-bars" aria-hidden="true"></i> Friday <i class="fa fa-caret-down" aria-hidden="true"></i></button></h3>
														<div id="Friday" class="collapse">
														<p style="margin-left:20px; margin-top:20px;">Programme List</p>
															<ul style="list-style: none;">

																<?php
																	$day = 5;
																	$z = $conn->query("SELECT * FROM programmes WHERE `p_date` = '$day' ORDER BY p_id ASC") or die ($conn->error());
																	$rowcount=mysqli_num_rows($z);
																	
																	if($rowcount == 0)
																	{?>
																		<p style="color:#CB4335;"><?php echo "No Programmes Available!"; ?></p>
															<?php	}

																	while($row = $z->fetch_array())
																	{
																	?>
																		<li class="programme-list"><a href="check-out.php?pid=<?php echo $row['p_id']; ?>"><h4><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo $row['p_name']; ?><div class="badge badge-info" style="font-size: 20px; float:right; margin-right:30px;">LKR <?php echo $row['rate']; ?></div></h4></a></li>
															<?php   }

																?>

															</ul>
														</div>
												</td>
											</tr>

											<tr>
												<td>
													<h3><button type="button" class="date" data-toggle="collapse" data-target="#Saturday"><i class="fa fa-bars" aria-hidden="true"></i> Saturday <i class="fa fa-caret-down" aria-hidden="true"></i></button></h3>
														<div id="Saturday" class="collapse">
														<p style="margin-left:20px; margin-top:20px;">Programme List</p>
															<ul style="list-style: none;">

																<?php
																	$day = 6;
																	$z = $conn->query("SELECT * FROM programmes WHERE `p_date` = '$day' ORDER BY p_id ASC") or die ($conn->error());
																	$rowcount=mysqli_num_rows($z);
																	
																	if($rowcount == 0)
																	{?>
																		<p style="color:#CB4335;"><?php echo "No Programmes Available!"; ?></p>
															<?php	}

																	while($row = $z->fetch_array())
																	{
																	?>
																		<li class="programme-list"><a href="confirm.php?pid=<?php echo $row['p_id']; ?>"><h4><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo $row['p_name']; ?><div class="badge badge-info" style="font-size: 20px; float:right; margin-right:30px;">LKR <?php echo $row['rate']; ?></div></h4></a></li>
															<?php   }

																?>

															</ul>
														</div>
												</td>
											</tr>

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>			
					</div>
				</div>			
			</div>
			<!-- /Page Wrapper -->
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatables/datatables.min.js"></script>
		
		<!-- Custom JS -->
		<script  src="assets/js/script.js"></script>
		
    </body>
</html>