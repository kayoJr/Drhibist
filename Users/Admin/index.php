<?php
require '../../backend/auth.php';
require '../../backend/db.php';
// $sql = $conn->query("DELETE FROM `pharma_daily_sell` WHERE `quan` = 0");
// $sql2 = $conn->query("DELETE FROM `system_payment` WHERE `price` = 0");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- basic -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- mobile metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
	<!-- site metas -->
	<title>Admin</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;600;700;800&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="icon" href="../../img/favicon.ico" type="image/png" />
	<link rel="stylesheet" href="../styles/bootstrap.min.css" />
	<link rel="stylesheet" href="../styles/style.css" />
	<link rel="stylesheet" href="../styles/responsive.css" />
	<link rel="stylesheet" href="../styles/bootstrap-select.css" />
	<link rel="stylesheet" href="../styles/perfect-scrollbar.css" />
	<link rel="stylesheet" href="../styles/custom.css" />

</head>

<body class="dashboard dashboard_1">
	<div class="full_container">
		<div class="inner_container">
			<!-- Sidebar  -->
			<nav id="sidebar">
				<div class="sidebar_blog_1">
					<div class="sidebar-header">
						<div class="logo_section">
							<a href="index.html"><img class="logo_icon img-responsive" src="../../img/logo.png" alt="#" /></a>
						</div>
					</div>
					<div class="sidebar_user_info">
						<div class="icon_setting"></div>
						<div class="user_profle_side">
							<div class="user_img">
								<img class="img-responsive" src="../../img/logo.png" alt="#" />
							</div>
							<div class="user_info">
								<?php
								$phone = $_SESSION['user'];
								$sql = "SELECT * FROM `users` WHERE `phone` = '$phone'";
								$res = $conn->query($sql);
								while ($row = mysqli_fetch_assoc($res)) {
									$name = $row['name'];
								}
								?>
								<h6>
									<?php
									echo $name;
									?>
								</h6>
							</div>
						</div>
					</div>
				</div>
				<div class="sidebar_blog_2">
					<?php
					include './side_nav.php';
					?>
				</div>
			</nav>
			<!-- end sidebar -->

			<!-- right content -->
			<div id="content">
				<!-- topbar -->
				<div class="topbar">
					<nav class="navbar navbar-expand-lg navbar-light">
						<div class="full">
							<button type="button" id="sidebarCollapse" class="sidebar_toggle">
								<i class="fa-solid fa-bars"></i>
							</button>
							<div class="right_topbar"></div>
						</div>
					</nav>
				</div>
				<!-- end topbar -->

				<!-- dashboard inner -->
				<div class="midde_cont">
					<div class="container-fluid">
						<div class="system_income">
							<h2 class="report">Daily Income</h2>
							<form action="index.php" method="GET" id="search_income">
								<div class="form-elements">
									<input type="date" name="date" id="date">
									<input type="submit" value="Search" name="search_income" class="btn btn-primary">
								</div>
							</form>
							<div class="boxes">
								<div class="box">
									<?php
									$today = date("Y-m-d");
									if (isset($_GET['search_income'])) {
										$today = $_GET['date'];
										if ($today == "") {
											$today = date("Y-m-d");
										}
									}
										$sql = "SELECT SUM(sub_price) AS value_sum FROM `system_payment_pharm` WHERE `date` = '$today'";
										$rs = $conn->query($sql);
										$row = $rs->fetch_assoc();
										$sys_sum = $row['value_sum'];
								// 		if (!$sys_sum > 0) {
								// 			$sys_sum = 0;
								// 		}

									$sql = "SELECT SUM(sub_price) AS value_sum_cash FROM `cash_payment_pharm` WHERE `date` = '$today'";
									$rs = $conn->query($sql);
									$row = $rs->fetch_assoc();
									$cash_sum = $row['value_sum_cash'];
									// 	if (!$cash_sum > 0) {
									// 		$cash_sum = 0;
									// 	}

									//$tot_sum = $sys_sum + $cash_sum;
									$tot_sum = $cash_sum + $sys_sum;
									?>
									<h4>Pharmacy (<?php echo $today; ?>)</h4>
									<div class="sells">
										<div>
											<h3>System</h3>
											<h3><?php echo $sys_sum; 
												?></h3>
										</div>
										<div>
											<h3>Cash</h3>
											<?php
											// 			if ($cash_sum < 0) {
											// 				$cash_sum = 0;
											// 			}

											?>
											<h3><?php echo $cash_sum; ?></h3>
										</div>
										<div>
											<h3>Total</h3>
											<h3><?php echo $tot_sum; ?></h3>
										</div>
									</div>
								</div>
								<div class="box">
									<h4>Reception (<?php echo $today; ?>)</h4>
									<?php
									if (isset($_GET['search_income'])) {
										$today = $_GET['date'];
										if ($today == "") {
											$today = date("Y-m-d");
										}
									}
									$sql_rec = "SELECT SUM(price) AS rec FROM `system_payment` WHERE `date` = '$today' AND `reason`= 'reception'";
									$rs_rec = $conn->query($sql_rec);
									$row_rec = $rs_rec->fetch_assoc();
									$rec_sys_sum = $row_rec['rec'];

									$sql_rec = "SELECT SUM(price) AS rec_cash FROM `income` WHERE `date` = '$today' AND `reason`= 'reception'";
									$rs_rec_cash = $conn->query($sql_rec);
									$row_rec_cash = $rs_rec_cash->fetch_assoc();
									$rec_cash_sum = $row_rec_cash['rec_cash'];
									// if (!$sys_sum > 0) {
									// 	$sys_sum = 0;
									// }
									?>
									<div class="sells">
										<div>
											<h3>System</h3>
											<h3><?php echo $rec_sys_sum; ?></h3>
										</div>
										<div>
											<h3>Cash</h3>
											<h3><?php echo $rec_cash_sum; ?></h3>
										</div>
										<div>
											<h3>Total</h3>
											<h3><?php echo $rec_sys_sum + $rec_cash_sum; ?></h3>
										</div>
									</div>
								</div>
								<div class="box">
									<h4>Laboratory (<?php echo $today; ?>)</h4>
									<?php
									if (isset($_GET['search_income'])) {
										$today = $_GET['date'];
										if ($today == "") {
											$today = date("Y-m-d");
										}
									}
									$sql_lab = "SELECT SUM(price) AS lab FROM `system_payment` WHERE `date` = '$today' AND `reason`= 'laboratory'";
									$rs_lab = $conn->query($sql_lab);
									$row_lab = $rs_lab->fetch_assoc();
									$lab_sys_sum = $row_lab['lab'];

									$sql_lab = "SELECT SUM(price) AS lab_cash FROM `income` WHERE `date` = '$today' AND `reason`= 'laboratory'";
									$rs_lab_cash = $conn->query($sql_lab);
									$row_lab_cash = $rs_lab_cash->fetch_assoc();
									$lab_cash_sum = $row_lab_cash['lab_cash'];
									?>
									<div class="sells">
										<div>
											<h3>System</h3>
											<h3><?php echo $lab_sys_sum; ?></h3>
										</div>
										<div>
											<h3>Cash</h3>
											<h3><?php echo $lab_cash_sum; ?></h3>
										</div>
										<div>
											<h3>Total</h3>
											<h3><?php echo $lab_sys_sum + $lab_cash_sum; ?></h3>
										</div>
									</div>
								</div>
								<div class="box">
									<h4>Ultrasound (<?php echo $today; ?>)</h4>
									<?php
									if (isset($_GET['search_income'])) {
										$today = $_GET['date'];
										if ($today == "") {
											$today = date("Y-m-d");
										}
									}
									$sql_ultra = "SELECT SUM(price) AS ultra FROM `system_payment` WHERE `date` = '$today' AND `reason`= 'ultrasound'";
									$rs_ultra = $conn->query($sql_ultra);
									$row_lab = $rs_ultra->fetch_assoc();
									$ultra_sys_sum = $row_lab['ultra'];

									$sql_ultra = "SELECT SUM(price) AS lab_cash FROM `income` WHERE `date` = '$today' AND `reason`= 'ultrasound'";
									$rs_ultra_cash = $conn->query($sql_ultra);
									$row_ultra_cash = $rs_ultra_cash->fetch_assoc();
									$ultra_cash_sum = $row_ultra_cash['lab_cash'];
									?>
									<div class="sells">

										<div>
											<h3>Cash</h3>
											<h3><?php echo $ultra_cash_sum; ?></h3>
										</div>
										<div>
											<h3>Total</h3>
											<h3><?php echo $ultra_sys_sum + $ultra_cash_sum; ?></h3>
										</div>
									</div>
								</div>
								<div class="box">
									<h4>Credit Payment (<?php echo $today; ?>)</h4>
									<?php
									if (isset($_GET['search_income'])) {
										$today = $_GET['date'];
										if ($today == "") {
											$today = date("Y-m-d");
										}
									}

									$sql_stc = "SELECT SUM(price) AS lab_cash FROM `income` WHERE `date` = '$today' AND `reason`= 'stc'";
									$rs_stc = $conn->query($sql_stc);
									$row_stc = $rs_stc->fetch_assoc();
									$stc_cash = $row_stc['lab_cash'];

									$sql_cigna = "SELECT SUM(price) AS lab_cash FROM `income` WHERE `date` = '$today' AND `reason`= 'cigna'";
									$rs_cigna = $conn->query($sql_cigna);
									$row_cigna = $rs_cigna->fetch_assoc();
									$cigna_cash = $row_cigna['lab_cash'];

									$total = $stc_cash + $cigna_cash;
									?>
									<div class="sells">

										<div>
											<h3>Save The Children</h3>
											<h3><?php echo $stc_cash; ?></h3>
										</div>
										<div>
											<h3>Cigna</h3>
											<h3><?php echo $cigna_cash; ?></h3>
										</div>
										<div>
											<h3>Total</h3>
											<h3><?php echo $total; ?></h3>
										</div>
									</div>
								</div>
								<div class="box">
									<h4>Procedure Payment (<?php echo $today; ?>)</h4>
									<?php
									if (isset($_GET['search_income'])) {
										$today = $_GET['date'];
										if ($today == "") {
											$today = date("Y-m-d");
										}
									}

									$sql_stc = "SELECT SUM(price) AS lab_cash FROM `income` WHERE `date` = '$today' AND `reason`= 'procedure'";
									$rs_stc = $conn->query($sql_stc);
									$row_stc = $rs_stc->fetch_assoc();
									$stc_cash = $row_stc['lab_cash'];

									$sql_cigna = "SELECT SUM(price) AS lab_cash FROM `system_payment` WHERE `date` = '$today' AND `reason`= 'procedure'";
									$rs_cigna = $conn->query($sql_cigna);
									$row_cigna = $rs_cigna->fetch_assoc();
									$cigna_cash = $row_cigna['lab_cash'];

									$total_procedure = $stc_cash + $cigna_cash;
									?>
									<div class="sells">

										<div>
											<h3>Cash</h3>
											<h3><?php echo $stc_cash; ?></h3>
										</div>
										<div>
											<h3>System</h3>
											<h3><?php echo $cigna_cash; ?></h3>
										</div>
										<div>
											<h3>Total</h3>
											<h3><?php echo $total_procedure; ?></h3>
										</div>
									</div>
								</div>
								<div class="box">
									<h4>Daily Total Of (<?php echo $today; ?>)</h4>
									<?php
									if (isset($_GET['search_income'])) {
										$today = $_GET['date'];
										if ($today == "") {
											$today = date("Y-m-d");
										}
									}

									$total = $stc_cash + $cigna_cash;
									?>
									<div class="sells">
										<?php

										$total_gen = $tot_sum  + $rec_cash_sum +
											$lab_cash_sum + $total_procedure;
										?>
										<div class="center">
											<h3>Total</h3>
											<h3><?php echo $total_gen; ?></h3>
										</div>
									</div>
								</div>
							</div>

						</div>
						<div class="daily-report">
							<h2 class="report">Daily Report</h4>
								<div class="boxes">
									<div class="box">
										<h4>Reception</h4>
										<form action="index.php" method="GET">
											<div class="form-elements">
												<input type="date" name="date" id="date">
												<input type="submit" value="Search" name="search" class="btn btn-primary">
											</div>
										</form>
										<?php
										$today = date("Y-m-d");
										if (isset($_GET['search'])) {
											$today = $_GET['date'];

											$sql = "SELECT SUM(payment) AS value_sum FROM `patient` WHERE `date` = '$today'";
											$sql2 = "SELECT COUNT(payment) AS count_sum FROM `patient` WHERE `date` = '$today'";
											$res = $conn->query($sql);
											$res2 = $conn->query($sql2);
											if ($res) {
												while ($row = $res->fetch_assoc()) {
													$sum = $row['value_sum'];
												}
												echo "
												<h3>$sum ETB</h3>
												";
											}
											if ($res2) {
												while ($row = $res2->fetch_assoc()) {
													$count = $row['count_sum'];
												}
												echo "
												<h3>$count Patients Registered Today</h3>
												";
											}
										}
										?>
									</div>
									<div class="box">
										<h4>Laboratory</h4>
										<form action="index.php" method="GET">
											<div class="form-elements">
												<input type="date" name="date" id="date">
												<input type="submit" value="Search" name="search" class="btn btn-primary">
											</div>
										</form>
										<?php
										$today = date("Y-m-d");
										if (isset($_GET['search'])) {
											$today = $_GET['date'];

											$sql = "SELECT SUM(price) AS lab_sum FROM `income` WHERE `date` = '$today' AND `reason`= 'laboratory'";
											$sql2 = "SELECT COUNT(price) AS count_lab FROM `income` WHERE `date` = '$today' AND `reason` = 'laboratory'";

											$sql_ultra = "SELECT SUM(price) AS lab_sys FROM `system_payment` WHERE `date` = '$today' AND `reason`= 'laboratory'";
											$sql_ultra_count = "SELECT COUNT(price) AS lab_sys_count FROM `system_payment` WHERE `date` = '$today' AND `reason`= 'laboratory'";

											$res = $conn->query($sql);
											$res_sys = $conn->query($sql_ultra);

											$res2 = $conn->query($sql2);
											$res2_sys = $conn->query($sql_ultra_count);
											if ($res) {
												while ($row = $res->fetch_assoc()) {
													$sum_first = $row['lab_sum'];
													// echo "
													// <h3>$sum ETB</h3>
													// ";
													if ($res_sys) {
														while ($row = $res->fetch_assoc()) {
															$sum = $row['lab_sys'];
														}
														$sum_sec = $sum_first + $sum;
														echo "
														<h3>$sum_sec ETB</h3>
														";
													}
												}
											}
											if ($res2) {
												while ($row = $res2->fetch_assoc()) {
													$sum = $row['count_lab'];
													// echo "
													// <h3>$sum ETB</h3>
													// ";
													if ($res2_sys) {
														while ($row = $res2_sys->fetch_assoc()) {
															$count = $row['lab_sys_count'];
														}
														$count = $count + $sum;
													} else {
														echo $conn->error;
													}
												}
											} else {
												echo $conn->error;
											}
										}
										?>

									</div>
									<div class="box">
										<h4>Pharmacy</h4>
										<form action="index.php" method="GET">
											<div class="form-elements">
												<input type="date" name="date" id="date">
												<input type="submit" value="Search" name="search" class="btn btn-primary">
											</div>
										</form>
										<?php
										$today = date("Y-m-d");
										if (isset($_GET['search'])) {
											$today = $_GET['date'];

											$sql = "SELECT SUM(sub_price) AS value_sum FROM `pharma_daily_sell` WHERE `date` = '$today'";
											$sql2 = "SELECT COUNT(id) AS count_sum FROM `pharma_daily_sell` WHERE `date` = '$today'";
											$res = $conn->query($sql);
											$res2 = $conn->query($sql2);
											if ($res) {
												while ($row = $res->fetch_assoc()) {
													$sum = $row['value_sum'];
												}
												if ($sum == '') {
													$sum = 0;
												}
												echo "
												<h3>$sum ETB</h3>
												";
											}
											if ($res2) {
												while ($row = $res2->fetch_assoc()) {
													$count = $row['count_sum'];
												}
											}
										}

										?>
										<a class="btn btn-primary" href="selled_list.php?date=<?php echo $today ?>&search-date=Search">List</a>
									</div>
									<div class="box">
										<h4>Ultrasound</h4>
										<form action="index.php" method="GET">
											<div class="form-elements">
												<input type="date" name="date" id="date">
												<input type="submit" value="Search" name="search" class="btn btn-primary">
											</div>
										</form>
										<?php
										$today = date("Y-m-d");
										if (isset($_GET['search'])) {
											$today = $_GET['date'];

											$sql = "SELECT SUM(price) AS lab_sum FROM `income` WHERE `date` = '$today' AND `reason`= 'ultrasound'";
											$sql2 = "SELECT COUNT(price) AS count_lab FROM `income` WHERE `date` = '$today' AND `reason` = 'ultrasound'";

											$sql_ultra = "SELECT SUM(price) AS lab_sys FROM `system_payment` WHERE `date` = '$today' AND `reason`= 'ultrasound'";
											$sql_ultra_count = "SELECT COUNT(price) AS lab_sys_count FROM `system_payment` WHERE `date` = '$today' AND `reason`= 'ultrasound'";

											$res = $conn->query($sql);
											$res_sys = $conn->query($sql_ultra);

											$res2 = $conn->query($sql2);
											$res2_sys = $conn->query($sql_ultra_count);
											if ($res) {
												while ($row = $res->fetch_assoc()) {
													$sum_first = $row['lab_sum'];
													// echo "
													// <h3>$sum ETB</h3>
													// ";
													if ($res_sys) {
														while ($row = $res_sys->fetch_assoc()) {
															$sum_ultra = $row['lab_sys'];
															$sum_ultra_total = $sum_first + $sum_ultra;
														}
														echo "
														<h3>$sum_ultra_total ETB</h3>
														";
													}
												}
											}
											if ($res2) {
												while ($row = $res2->fetch_assoc()) {
													$sum = $row['count_lab'];
													// echo "
													// <h3>$sum ETB</h3>
													// ";
													if ($res2_sys) {
														while ($row = $res2_sys->fetch_assoc()) {
															$count = $row['lab_sys_count'];
														}
														$count = $count + $sum;
													} else {
														echo $conn->error;
													}
												}
											} else {
												echo $conn->error;
											}
										}
										?>
									</div>
									<div class="box">
										<h4>Admission</h4>
										<form action="index.php" method="GET">
											<div class="form-elements">
												<input type="date" name="date" id="date">
												<input type="submit" value="Search" name="search" class="btn btn-primary">
											</div>
										</form>
										<?php
										$today = date("Y-m-d");
										if (isset($_GET['search'])) {
											$today = $_GET['date'];

											$adm_cash = "SELECT SUM(price) AS adm_cash FROM `income` WHERE `date` = '$today' AND `reason`= 'withdrawal'";
											$adm_sys = "SELECT SUM(price) AS adm_sys FROM `system_payment` WHERE `date` = '$today' AND `reason`= 'withdrawal'";

											$res = $conn->query($adm_cash);
											$res_sys = $conn->query($adm_sys);

											if ($res) {
												while ($row = $res->fetch_assoc()) {
													$sum_first = $row['adm_cash'];
													// echo "
													// <h3>$sum ETB</h3>
													// ";
													if ($res_sys) {
														while ($row = $res_sys->fetch_assoc()) {
															$sum_ultra = $row['adm_sys'];
															$sum_ultra_total = $sum_first + $sum_ultra;
														}
														echo "
														<h3>$sum_ultra_total ETB</h3>
														";
													}
												}
											}
											if ($res2) {
												while ($row = $res2->fetch_assoc()) {
													$sum = $row['count_lab'];
													// echo "
													// <h3>$sum ETB</h3>
													// ";
													if ($res2_sys) {
														while ($row = $res2_sys->fetch_assoc()) {
															$count = $row['lab_sys_count'];
														}
														$count = $count + $sum;
													} else {
														echo $conn->error;
													}
												}
											} else {
												echo $conn->error;
											}
										}
										?>
										<a class="btn btn-primary" href="admission_list.php?date=<?php echo $today ?>&search-date=Search">List</a>

									</div>
								</div>
						</div>
						<div class="daily-report">
							<h2 class="report">Credit Report</h4>
								<div class="boxes">
									<div class="box">
										<h4>Save The Children</h4>
										<!-- <form action="index.php" method="GET">
											<div class="form-elements">
												<input type="date" name="date" id="date">
												<input type="submit" value="Search" name="search_credit" class="btn btn-primary">
											</div>
										</form> -->
										<?php
										$today = date("Y-m-d");

										$sql = "SELECT SUM(price) AS value_sum FROM `credit` WHERE `org` = 'stc' AND `status` = 0";
										$res = $conn->query($sql);
										if ($res) {
											while ($row = $res->fetch_assoc()) {
												$sum = $row['value_sum'];
											}
										}

										?>
										<div class="sells">
											<div>
												<h3>Pharmacy</h3>
												<?php
												$sql = "SELECT SUM(price) AS value_sum FROM `credit_pharm` WHERE `org` = 'stc' AND `status` = 0";
												$res = $conn->query($sql);
												if ($res) {
													while ($row = $res->fetch_assoc()) {
														$pharmacy = $row['value_sum'];
													}
												}

												?>
												<h3><?php echo $pharmacy; ?></h3>
											</div>
											<div>
												<h3>Lab & Rece</h3>
												<?php
												$sql = "SELECT SUM(price) AS value_sum FROM `credit` WHERE `org` = 'stc' AND `status` = 0 AND (`reason` = 'laboratory' OR `reason` = 'reception')";
												$res = $conn->query($sql);
												if ($res) {
													while ($row = $res->fetch_assoc()) {
														$lab = $row['value_sum'];
													}
												}

												?>
												<h3><?php echo $lab; ?></h3>
											</div>
											<div>
												<h3>Admission</h3>
												<?php
												$sql = "SELECT SUM(price) AS value_sum FROM `credit` WHERE `org` = 'stc' AND `status` = 0 AND (`reason` = 'withdrawal')";
												$res = $conn->query($sql);
												if ($res) {
													while ($row = $res->fetch_assoc()) {
														$addm = $row['value_sum'];
													}
												}

												?>
												<h3><?php echo $addm; ?></h3>
											</div>
											<div>
												<h3>Ultrasound</h3>
												<?php
												$sql = "SELECT SUM(price) AS value_sum FROM `credit` WHERE `org` = 'stc' AND `status` = 0 AND (`reason` = 'ultrasound')";
												$res = $conn->query($sql);
												if ($res) {
													while ($row = $res->fetch_assoc()) {
														$ultra = $row['value_sum'];
													}
												}

												?>
												<h3><?php echo $ultra; ?></h3>
											</div>
											<div>
												<h3>Total</h3>
												<h3><?php
													$total = $pharmacy + $ultra + $addm + $lab;
													echo $total; ?></h3>
											</div>
											<form action="../../backend/credit_pay.php" method='GET'>
												<input type="hidden" name="tot_pay" value="<?php echo $total; ?>">
												<input type="hidden" name="org" value="stc">
												<a href="./pharmacy_det.php?name=stc" class="btn">Pharmacy Detail</a>
												<input type="submit" class="btn" value="Pay" name="pay_stc">
											</form>
										</div>
									</div>
									<div class="box">
										<h4>Cigna</h4>
										<?php
										$today = date("Y-m-d");

										$sql = "SELECT SUM(price) AS value_sum FROM `credit` WHERE `org` = 'cigna' AND `status` = 0";
										$res = $conn->query($sql);
										if ($res) {
											while ($row = $res->fetch_assoc()) {
												$sum = $row['value_sum'];
											}
										}

										?>
										<div class="sells">
											<div>
												<h3>Pharmacy</h3>
												<?php
												$sql = "SELECT SUM(price) AS value_sum FROM `credit_pharm` WHERE `org` = 'cigna' AND `status` = 0 ";
												$res = $conn->query($sql);
												if ($res) {
													while ($row = $res->fetch_assoc()) {
														$pharmacy = $row['value_sum'];
													}
												}

												?>
												<h3><?php echo $pharmacy; ?></h3>
											</div>
											<div>
												<h3>Lab & Rece</h3>
												<?php
												$sql = "SELECT SUM(price) AS value_sum FROM `credit` WHERE `org` = 'cigna' AND `status` = 0 AND (`reason` = 'laboratory' OR `reason` = 'reception')";
												$res = $conn->query($sql);
												if ($res) {
													while ($row = $res->fetch_assoc()) {
														$lab = $row['value_sum'];
													}
												}

												?>
												<h3><?php echo $lab; ?></h3>
											</div>
											<div>
												<h3>Admission</h3>
												<?php
												$sql = "SELECT SUM(price) AS value_sum FROM `credit` WHERE `org` = 'cigna' AND `status` = 0 AND (`reason` = 'withdrawal')";
												$res = $conn->query($sql);
												if ($res) {
													while ($row = $res->fetch_assoc()) {
														$addm = $row['value_sum'];
													}
												}

												?>
												<h3><?php echo $addm; ?></h3>
											</div>
											<div>
												<h3>Ultrasound</h3>
												<?php
												$sql = "SELECT SUM(price) AS value_sum FROM `credit` WHERE `org` = 'cigna' AND `status` = 0 AND (`reason` = 'ultrasound')";
												$res = $conn->query($sql);
												if ($res) {
													while ($row = $res->fetch_assoc()) {
														$ultra = $row['value_sum'];
													}
												}

												?>
												<h3><?php echo $ultra; ?></h3>
											</div>
											<div>
												<h3>Total</h3>
												<h3><?php
													$total = $pharmacy + $ultra + $addm + $lab;
													echo $total; ?></h3>
											</div>
											<form action="../../backend/credit_pay.php" method='GET'>
												<input type="hidden" name="tot_pay" value="<?php echo $total; ?>">
												<a href="./pharmacy_det.php?name=cigna" class="btn">Pharmacy Detail</a>
												<input type="submit" class="btn" value="Pay" name="pay_cigna">
											</form>
										</div>
									</div>






								</div>
						</div>
						<div class="month-report daily-report">
							<div class="report">
								<h2>Month Report</h2>
							</div>
							<form action="index.php" method="GET" id="search_income">
								<div class="form-elements">
									<input type="date" name="date-month" id="date">
									<input type="submit" value="Search" name="search-month" class="btn btn-primary">
								</div>
							</form>
							<?php
							if (isset($_GET['search-month'])) {
								$sum_rec = 0;
								$sum_pharm = 0;
								$lab_total = 0;
								$sum_ultra = 0;

								//$today = $_GET['date'];
								$todays = explode('-', $_GET['date-month']);
								$month = $todays[1];
								$year = $todays[0];

								$sql_rec = "SELECT SUM(payment) AS value_sum FROM `patient` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month'";
								$res_rec = $conn->query($sql_rec);
								$row = $res_rec->fetch_assoc();
								$sum_rec = $row['value_sum'];

								$sql_pharm = "SELECT SUM(sub_price) AS value_sum FROM `cash_payment_pharm` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month'";
								$res_pharm = $conn->query($sql_pharm);
								$row = $res_pharm->fetch_assoc();
								$sum_pharm = $row['value_sum'];

								$sql_lab = "SELECT SUM(price) AS value_sum FROM `income` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month' AND `reason` = 'laboratory'";
								$sql_lab_2 = "SELECT SUM(price) AS value_sum_sys FROM `system_payment` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month' AND `reason` = 'laboratory'";
								$res_lab = $conn->query($sql_lab);
								$res_lab2 = $conn->query($sql_lab_2);
								$row = $res_lab->fetch_assoc();
								$row2 = $res_lab2->fetch_assoc();
								$sum_lab_cash = $row['value_sum'];
								$sum_lab_sys = $row2['value_sum_sys'];
								$lab_total = $sum_lab_cash + $sum_lab_sys;

								$sql_ultra = "SELECT SUM(price) AS value_sum FROM `income` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month' AND `reason` = 'ultrasound'";
								$res_ultra = $conn->query($sql_ultra);
								$row = $res_ultra->fetch_assoc();
								$sum_cash_ultra = $row['value_sum'];

								$total_month = $sum_rec + $sum_cash_ultra + $sum_pharm + $lab_total;
							} else {
								$sum_rec = 0;
								$sum_pharm = 0;
								$lab_total = 0;
								$sum_ultra = 0;

								$today = date('Y-m-d');
								$todays = explode('-', $today);
								$month = $todays[1];
								$year = $todays[0];

								$sql_rec = "SELECT SUM(payment) AS value_sum FROM `patient` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month'";
								$res_rec = $conn->query($sql_rec);
								$row = $res_rec->fetch_assoc();
								$sum_rec = $row['value_sum'];

								$sql_pharm = "SELECT SUM(sub_price) AS value_sum FROM `cash_payment_pharm` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month'";
								$res_pharm = $conn->query($sql_pharm);
								$row = $res_pharm->fetch_assoc();
								$sum_pharm = $row['value_sum'];

								$sql_lab = "SELECT SUM(price) AS value_sum FROM `income` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month' AND `reason` = 'laboratory'";
								$sql_lab_2 = "SELECT SUM(price) AS value_sum_sys FROM `system_payment` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month' AND `reason` = 'laboratory'";
								$res_lab = $conn->query($sql_lab);
								$res_lab2 = $conn->query($sql_lab_2);
								$row = $res_lab->fetch_assoc();
								$row2 = $res_lab2->fetch_assoc();
								$sum_lab_cash = $row['value_sum'];
								$sum_lab_sys = $row2['value_sum_sys'];
								$lab_total = $sum_lab_cash + $sum_lab_sys;

								$sql_ultra = "SELECT SUM(price) AS value_sum FROM `income` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month' AND `reason` = 'ultrasound'";
								$res_ultra = $conn->query($sql_ultra);
								$row = $res_ultra->fetch_assoc();
								$sum_cash_ultra = $row['value_sum'];

								$total_month = $sum_rec + $sum_cash_ultra + $sum_pharm + $lab_total;
							}
							?>
							
							<div class="boxes">
								<div class="box">
									<h4>Reception</h4>
									<h3><?php echo $sum_rec;?> ETB</h3>
								</div>
								<div class="box">
									<h4>Pharmacy</h4>
									<h3><?php echo $sum_pharm;?> ETB</h3>
								</div>
								<div class="box">
									<h4>Laboratory</h4>
									<h3><?php echo $lab_total;?> ETB</h3>
								</div>
								<div class="box">
									<h4>Ultrasound</h4>
									<h3><?php echo $sum_cash_ultra;?> ETB</h3>
								</div>
								<div class="box">
									<h4>Total</h4>
									<h3><?php echo $total_month;?> ETB</h3>
								</div>
							</div>
					
						</div>
					</div>
					<!-- footer -->
				</div>
				<!-- end dashboard inner -->
			</div>
		</div>
	</div>
	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<!-- wow animation -->
	<script src="../js/animate.js"></script>
	<!-- select country -->
	<script src="../js/bootstrap-select.js"></script>
	<!-- nice scrollbar -->
	<script src="../js/perfect-scrollbar.min.js"></script>
	<script>
		var ps = new PerfectScrollbar("#sidebar");
	</script>
	<!-- custom js -->
	<script src="../js/custom.js"></script>
</body>

</html>