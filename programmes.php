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
        <title>Hilltop - Programmes</title>
		
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

				<div class="top-nav-search">
					<form method="POST" action="programmes.php">
						<select style="appearance: none;" name="parm" class="form-control">
							<option value="All">All</option>
							<option value="1">Monday</option>
							<option value="2">Tuesday</option>
						    <option value="3">Wednesday</option>
							<option value="4">Thursday</option>
							<option value="5">Friday</option>
							<option value="6">Saturday</option>
							<option value="7">Sunday</option>
						</select>
						<button class="btn" type="submit" name="search" ><i class="fa fa-search"></i></button>
					</form>
				</div>

				<div class="top-nav-search">
					<form method="POST" action="programmes.php">
						<input type="text" name="parm1" class="form-control" placeholder="Search">
						<button class="btn" type="submit" name="search1" ><i class="fa fa-search"></i></button>
					</form>
				</div>
				
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

							<li class="active"> 
								<a href="programmes.php"><i class="fe fe-activity"></i> <span>Programmes</span></a>
							</li>

							<li> 
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
								<h3 class="page-title">Programmes</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Programmes</li>
								</ul>
							</div>
							<div class="col-sm-5 col">
								<a href="#Add_Programmes" data-toggle="modal" class="btn btn-success float-right mt-2">Add Programmes</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="datatable table table-hover table-center mb-0">
											<thead>
												<tr>
													<th class="text-center">Programme Id</th>
													<th class="text-center">Programme Name</th>
													<th class="text-center">Programme Description</th>
													<th class="text-center">Programme Day</th>
													<th class="text-center">Programme Rate (LKR)</th>
													<th class="text-center">Actions</th>
												</tr>
											</thead>
											<tbody>
												<tr>

												<?php

													if(ISSET($_POST['search']))
													{
														$prm = $_POST['parm'];

														if($prm == "All")
														{
															$z = $conn->query("SELECT * FROM programmes ORDER BY p_id ASC") or die ($conn->error());
														}
														else
														{
															$z = $conn->query("SELECT * FROM programmes WHERE p_date = '$prm' ORDER BY p_id ASC") or die ($conn->error());
														}
                              							  while($row = $z->fetch_array())
                              							  {
                      								?>
													<td class="text-center">
														<h2 class="table-avatar">
															<p><?php echo $row['p_id']; ?></p>
														</h2>
													</td>
													
													<td class="text-center">
														<h2 class="table-avatar">
															<p><?php echo $row['p_name']; ?></p>
														</h2>
													</td>

													<td class="text-center">
														<h2 class="table-avatar">
															<textarea class="form-control" rows="4" cols="70" readonly="true"><?php echo $row['p_description']; ?></textarea>
															
														</h2>
													</td>

													<td class="text-center">
														<h2 class="table-avatar">
															<p>
																<?php 
																	$date = $row['p_date'];
																	
																	if($date == 1)
																	{?>
																		<p class="badge badge-info">Monday</p>
															<?php	}

															if($date == 2)
																	{?>
																		<p class="badge badge-info">Tuesday</p>
															<?php	}

															if($date == 3)
																	{?>
																		<p class="badge badge-info">Wednesday</p>
															<?php	}

															if($date == 4)
																	{?>
																		<p class="badge badge-info">Thursday</p>
															<?php	}

															if($date == 5)
																	{?>
																		<p class="badge badge-info">Friday</p>
															<?php	}

															if($date == 6)
																	{?>
																		<p class="badge badge-warning">Saturday</p>
															<?php	}
															
															if($date == 7)
																	{?>
																		<p class="badge badge-danger">Sunday</p>
															<?php	}
																	
																?>
															</p>
														</h2>
													</td>

													<td class="text-center">
														<h2 class="table-avatar">
															<p>
																<?php 
																	$rate = $row['rate'];
																	
																	if($rate == 0.00)
																	{?>
																		<p>N/A</p>
															<?php	}
																	else
																	{?>
																		<p><?php echo $row['rate']; ?></p>
															<?php	}

																?>
															</p>
														</h2>
													</td>
												
													<td class="text-center">
														<div class="actions">
															<a class="btn btn-sm bg-success-light" href="p_edit.php?pid=<?php echo $row['p_id']; ?>">
																<i class="fe fe-eye"></i> View
															</a>
														</div>
													</td>
												</tr>
												</tr>
									<?php				} 
													}

													else if(ISSET($_POST['search1']))
													{
														$prm1 = $_POST['parm1'];

														if($prm1 == null)
														{
															$z = $conn->query("SELECT * FROM programmes ORDER BY p_id ASC") or die ($conn->error());
														}
														else
														{
															$z = $conn->query("SELECT * FROM programmes WHERE p_name = '$prm1' OR p_id = '$prm1' ORDER BY p_id ASC") or die ($conn->error());
														}
                              							  while($row = $z->fetch_array())
                              							  {
                      								?>
													<td class="text-center">
														<h2 class="table-avatar">
															<p><?php echo $row['p_id']; ?></p>
														</h2>
													</td>
													
													<td class="text-center">
														<h2 class="table-avatar">
															<p><?php echo $row['p_name']; ?></p>
														</h2>
													</td>

													<td class="text-center">
														<h2 class="table-avatar">
															<textarea class="form-control" rows="4" cols="70" readonly="true"><?php echo $row['p_description']; ?></textarea>
															
														</h2>
													</td>

													<td class="text-center">
														<h2 class="table-avatar">
															<p>
																<?php 
																	$date = $row['p_date'];
																	
																	if($date == 1)
																	{?>
																		<p class="badge badge-info">Monday</p>
															<?php	}

															if($date == 2)
																	{?>
																		<p class="badge badge-info">Tuesday</p>
															<?php	}

															if($date == 3)
																	{?>
																		<p class="badge badge-info">Wednesday</p>
															<?php	}

															if($date == 4)
																	{?>
																		<p class="badge badge-info">Thursday</p>
															<?php	}

															if($date == 5)
																	{?>
																		<p class="badge badge-info">Friday</p>
															<?php	}

															if($date == 6)
																	{?>
																		<p class="badge badge-warning">Saturday</p>
															<?php	}
															
															if($date == 7)
																	{?>
																		<p class="badge badge-danger">Sunday</p>
															<?php	}
																	
																?>
															</p>
														</h2>
													</td>

													<td class="text-center">
														<h2 class="table-avatar">
															<p>
																<?php 
																	$rate = $row['rate'];
																	
																	if($rate == 0.00)
																	{?>
																		<p>N/A</p>
															<?php	}
																	else
																	{?>
																		<p><?php echo $row['rate']; ?></p>
															<?php	}

																?>
															</p>
														</h2>
													</td>
												
													<td class="text-center">
														<div class="actions">
															<a class="btn btn-sm bg-success-light" href="p_edit.php?pid=<?php echo $row['p_id']; ?>">
																<i class="fe fe-eye"></i> View
															</a>
														</div>
													</td>
												</tr>
												</tr>

											<?php } 
													}
                          							else
                          							{ 
                          							  $z = $conn->query("SELECT * FROM programmes ORDER BY p_id ASC") or die ($conn->error());
                          							      while($row = $z->fetch_array()){
                      							?>

                      								<td class="text-center">
														<h2 class="table-avatar">
															<p><?php echo $row['p_id']; ?></p>
														</h2>
													</td>
													
													<td class="text-center">
														<h2 class="table-avatar">
															<p><?php echo $row['p_name']; ?></p>
														</h2>
													</td>

													<td class="text-center">
														<h2 class="table-avatar">
															<textarea class="form-control" rows="4" cols="70" readonly="true"><?php echo $row['p_description']; ?></textarea>
															
														</h2>
													</td>

													<td class="text-center">
														<h2 class="table-avatar">
															<p>
																<?php 
																	$date = $row['p_date'];
																	
																	if($date == 1)
																	{?>
																		<p class="badge badge-info">Monday</p>
															<?php	}

															if($date == 2)
																	{?>
																		<p class="badge badge-info">Tuesday</p>
															<?php	}

															if($date == 3)
																	{?>
																		<p class="badge badge-info">Wednesday</p>
															<?php	}

															if($date == 4)
																	{?>
																		<p class="badge badge-info">Thursday</p>
															<?php	}

															if($date == 5)
																	{?>
																		<p class="badge badge-info">Friday</p>
															<?php	}

															if($date == 6)
																	{?>
																		<p class="badge badge-warning">Saturday</p>
															<?php	}
															
															if($date == 7)
																	{?>
																		<p class="badge badge-danger">Sunday</p>
															<?php	}
																	
																?>
															</p>
														</h2>
													</td>

													<td class="text-center">
														<h2 class="table-avatar">
															<p>
																<?php 
																	$rate = $row['rate'];
																	
																	if($rate == 0.00)
																	{?>
																		<p>N/A</p>
															<?php	}
																	else
																	{?>
																		<p><?php echo $row['rate']; ?></p>
															<?php	}

																?>
															</p>
														</h2>
													</td>
												
													<td class="text-center">
														<div class="actions">
															<a class="btn btn-sm bg-success-light" href="p_edit.php?pid=<?php echo $row['p_id']; ?>">
																<i class="fe fe-eye"></i> View
															</a>
														</div>
													</td>
												</tr>

												<?php } 

                          						} ?>

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
			
			
			<!-- Add Modal -->
			<div class="modal fade" id="Add_Programmes" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Programmes</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="add_programmes.php" enctype="multipart/form-data">
								<div class="row form-row">

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Programme Name</label>
											<input type="text" name="p_name" class="form-control" required="">
										</div>
									</div>

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Date</label>

											<select name="p_day" class="form-control" required="">
												<option value="1">Monday</option>
												<option value="2">Tuesday</option>
												<option value="3">Wednesday</option>
												<option value="4">Thursday</option>
												<option value="5">Friday</option>
												<option value="6">Saturday</option>
												<option value="7">Sunday</option>
											</select>

										</div>
									</div>

									<div class="col-12">
										<div class="form-group">
											<label>Programme Rate (LKR)</label>
											<input type="number" name="p_rate" class="form-control" required="">
										</div>
									</div>

									<div class="col-12">
										<div class="form-group">
											<label>Description</label>
											<textarea id="my-text" name="p_description" class="form-control" required="" rows="4" placeholder="Enter Programme Description . . ."></textarea>
											<p id="count-result">0/250</p>
										</div>
									</div>
									
								</div>
								<button type="submit" name="save" class="btn btn-success btn-block">Save Changes</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			
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

		<script>
			let myText = document.getElementById("my-text");
			let result = document.getElementById("count-result");
			myText.addEventListener("input", () => {
    			let limit = 250;
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
</html>