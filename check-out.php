<?php 
    require 'validator.php';
    require_once 'conn.php';
?>


<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/specialities.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:49 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Hilltop - Programme</title>
		
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
				
					<!-- Page Content -->
			<div class="content">
				<div class="container">

					<div class="row">
						<div class="col-md-7 col-lg-8">
							<div class="card">
								<div class="card-body">
								
								<?php 

									$pid = $_REQUEST["pid"];
									date_default_timezone_set("Asia/Colombo");
                 					$today = date('Y-m-d');
									$query1 = mysqli_query($conn, "SELECT * FROM `programmes` WHERE programmes.`p_id` = '$pid'") or die(mysqli_error());

									$fetch1 = mysqli_fetch_array($query1);

								?>


									<!-- Checkout Form -->
									<form method="POST" action="donation.php" enctype="multipart/form-data">
									
										<!-- Personal Information -->
										<div class="info-widget">
											<h4 class="card-title">Personal Information</h4>
											<p><?php echo $today ?></p>
											<div class="row">

												<div class="col-12">
													<div class="form-group card-label">
														<input style="display:none;" class="form-control" type="text" name="pid" value="<?php echo $fetch1['p_id']; ?>" readonly="" required="">
														<input style="display:none;" class="form-control" type="text" name="d_date" value="<?php echo $today ?>" readonly="" required="">
													</div>
												</div>

                                                <div class="col-md-6 col-sm-12">
													<div class="form-group card-label">
														<label>Name of Person</label>
														<input class="form-control" type="text" name="name" required="">
													</div>
												</div>

												<div class="col-md-6 col-sm-12">
													<div class="form-group card-label">
														<label>Mobile No</label>
														<input class="form-control" type="text" name="mobile" required="">
													</div>
												</div>

												<div class="col-12 col-md-6 col-sm-12">
													<div class="form-group card-label">
														<label>Amount</label>
														<?php

															$amount = $fetch1['rate'];

															if($amount == 0.00)
															{?>
																<input class="form-control" type="number" name="amount" required="">
													<?php	}

															else
															{?>
																<input class="form-control" type="number" name="amount" value="<?php echo $fetch1['rate']; ?>" required="">
													<?php	}

														?>
														
													</div>
												</div>

												<div class="col-12 col-md-6 col-sm-12">
													<div class="form-group card-label">
														<label>Payment Method</label>
														<select class="form-control" name="method" required="">
															<option value="Cash">Cash</option>
															<option value="Credit/Debit Card">Credit/Debit Card</option>
															<option value="Cheque">Cheque</option>
														</select>
													</div>
												</div>

												<div class="col-12">
													<div class="form-group card-label">
														<label>Remarks</label>
														<textarea id="my-text" required="" class="form-control" type="text" name="remarks"></textarea>
														<p id="count-result">0/150</p>
													</div>
												</div>
											</div>
										</div>
										<!-- /Personal Information -->
										
										<div class="payment-widget">
											<!-- Submit Section -->
											<div class="submit-section mt-4">
												<button type="submit" name="save" class="btn btn-primary submit-btn">Confirm</button>
											</div>
											<!-- /Submit Section -->
											
										</div>
									</form>
									<!-- /Checkout Form -->
									
								</div>
							</div>
							
						</div>
						
						<div class="col-md-5 col-lg-4 theiaStickySidebar">
						
							<!-- Booking Summary -->
							<div class="card booking-card">
								<div class="card-header">
									<h4 class="card-title">Summary</h4>
								</div>
								<div class="card-body">
									<!-- Booking Doctor Info -->
									<div class="booking-doc-info">
										<div class="booking-info">
											<h4><a href=""><?php echo $fetch1['p_name']; ?></a></h4>
											<div class="clinic-details">
												<p class="doc-location"> <lable class="doc-department"> <b>
													<?php 
														$day = $fetch1['p_date'];
														if($day == 1)
														{
															echo "Monday";
														}
														if($day == 2)
														{
															echo "Tuesday";
														}
														if($day == 3)
														{
															echo "Wednesday";
														}
														if($day == 4)
														{
															echo "Thursday";
														}
														if($day == 5)
														{
															echo "Friday";
														}
														if($day == 6)
														{
															echo "Saturday";
														}
														if($day == 7)
														{
															echo "Sunday";
														}
													?></b></lable></p>
											</div>
										</div>
									</div>
									<!-- Booking Doctor Info -->
									
									<div class="booking-summary">
										<div class="booking-item-wrap"><br>
											<ul class="booking-fee">
												<li><b>Description:</b> <span><?php echo $fetch1['p_description']; ?></span></li>
											</ul>
											<div class="booking-total">
												<ul class="booking-total-list">
													<li>
														<span><b>Amount:</b></span>
														<span class="total-cost"> LKR 
															<?php
															 	$rate = $fetch1['rate'];
																if($rate == 0.00)
																{
																	echo "N/A";
																}
																else
																{
																	echo $rate;
																} 
															?>
														</span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Booking Summary -->
							
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->

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

		<script>
			let myText = document.getElementById("my-text");
			let result = document.getElementById("count-result");
			myText.addEventListener("input", () => {
    			let limit = 150;
    			let count = (myText.value).length;
    			document.getElementById("count-result").textContent = `${count} / ${limit}` ;

    			if(count > limit)
    			{
        			myText.style.borderColor = "#F08080";
					result.style.color = "#F08080";
    			}
				else
				{
					myText.style.borderColor = "#1ABC9C";
					result.style.color = "#333";
				}
			});
		</script>
		
    </body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/specialities.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:51 GMT -->
</html>