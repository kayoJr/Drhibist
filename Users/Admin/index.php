<?php
require '../../backend/auth.php';
require '../../backend/db.php';
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
							<?php

							?>
							<!-- <div class="boxes">
								<div class="box">

									<?php
									// $today = date("Y-m-d");
									// if (isset($_GET['search_income'])) {
									// 	$today = $_GET['date'];
									// 	if ($today == "") {
									// 		$today = date("Y-m-d");
									// 	}
									// }
									// echo "<h4>Daily System Only Income ($today)</h4>";
									// $sql = "SELECT SUM(price) AS value_sum FROM `system_payment` WHERE `date` = '$today' AND `reason` = 'pharmacy'";
									// $rs = $conn->query($sql);
									// $row = $rs->fetch_assoc();
									// $sys_sum = $row['value_sum'];
									// if(!$sys_sum>0){
									// 	$sys_sum = 0;
									// }
									// echo "<h3>$sys_sum ETB</h3>"
									?>
								</div>
								<div class="box">
									<?php
									$today = date("Y-m-d");
									if (isset($_GET['search_income'])) {
										$today = $_GET['date'];
										if ($today == "") {
											$today = date("Y-m-d");
										}
									}
									echo "<h4>Daily Cash Only Income ($today)</h4>";
									// $sql = "SELECT SUM(payment) AS rece FROM `patient` WHERE `date` = '$today' AND `reason` = 'pharmacy'";
									// $rs = $conn->query($sql);
									// $row = $rs->fetch_assoc();
									// $rec_sum = $row['rece'];

									$sql = "SELECT SUM(sub_price) AS phar FROM `pharma_daily_sell` WHERE `date` = '$today'";
									$rs = $conn->query($sql);
									$row = $rs->fetch_assoc();
									$phar_sum = $row['phar'];

									$sql = "SELECT SUM(price) AS value_sum FROM `system_payment` WHERE `date` = '$today' AND `reason` = 'pharmacy'";
									$rs = $conn->query($sql);
									$row = $rs->fetch_assoc();
									$sys_sum = $row['value_sum'];

									$tots_sum = $phar_sum - $sys_sum;

									echo "<h3>$tots_sum ETB</h3>"
									?>
								</div>
								<div class="box">
									<?php
									$today = date("Y-m-d");
									if (isset($_GET['search_income'])) {
										$today = $_GET['date'];
										if ($today == "") {
											$today = date("Y-m-d");
										}
									}
									echo "<h4>Daily Total Income ($today)</h4>";
									// $sql = "SELECT SUM(payment) AS rece FROM `patient` WHERE `date` = '$today'";
									// $rs = $conn->query($sql);
									// $row = $rs->fetch_assoc();
									// $rec_sum = $row['rece'];

									$sql = "SELECT SUM(sub_price) AS phar FROM `pharma_daily_sell` WHERE `date` = '$today'";
									$rs = $conn->query($sql);
									$row = $rs->fetch_assoc();
									$phar_sum = $row['phar'];

									$tot_sum = $phar_sum;

									echo "<h3>$tot_sum ETB</h3>"
									?>
								</div>
							</div> -->

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
									$sql = "SELECT SUM(price) AS value_sum FROM `system_payment` WHERE `date` = '$today' AND `reason` = 'pharmacy'";
									$rs = $conn->query($sql);
									$row = $rs->fetch_assoc();
									$sys_sum = $row['value_sum'];
									if(!$sys_sum>0){
										$sys_sum = 0;
									}
									?>
									<h4>Pharmacy (<?php echo $today; ?>)</h4>
									<div class="sells">
										<div>
											<h3>System</h3>
											<h3><?php echo $sys_sum; ?></h3>
										</div>
										<div>
											<h3>Cash</h3>
											<h3><?php echo $tots_sum; ?></h3>
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
								if(!$sys_sum>0){
									$sys_sum = 0;
								}
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
								$sql_ultra = "SELECT SUM(price) AS ultra FROM `system_payment` WHERE `date` = '$today' AND `reason`= 'laboratory'";
								$rs_ultra = $conn->query($sql_ultra);
								$row_lab = $rs_ultra->fetch_assoc();
								$ultra_sys_sum = $row_lab['ultra'];

								$sql_ultra = "SELECT SUM(price) AS lab_cash FROM `income` WHERE `date` = '$today' AND `reason`= 'laboratory'";
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
														echo "
														<h3>$count Laboratory Exams Done Today</h3>
														";
													}else{
														echo $conn->error;
													}
												}
											}else{
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
												echo "
												<h3>$sum ETB</h3>
												";
											}
											if ($res2) {
												while ($row = $res2->fetch_assoc()) {
													$count = $row['count_sum'];
												}
												echo "
												<h3>$count drugs selled today</h3>
												";
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
															$sum_ultra_total = $sum_first+$sum_ultra;
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
														echo "
														<h3>$count Ultrasound Exams Done Today</h3>
														";
													}else{
														echo $conn->error;
													}
												}
											}else{
												echo $conn->error;
											}
										}
										?>
									</div>
								</div>
						</div>
						<div class="daily-report">
							<h2 class="report">Credit Report</h4>
								<div class="boxes">
									<div class="box">
										<h4>Pharmacy</h4>
										<!-- <form action="index.php" method="GET">
											<div class="form-elements">
												<input type="date" name="date" id="date">
												<input type="submit" value="Search" name="search_credit" class="btn btn-primary">
											</div>
										</form> -->
										<?php
										$today = date("Y-m-d");

											$sql = "SELECT SUM(price) AS value_sum FROM `credit` WHERE reason = 'pharmacy' AND `status` = 0";
											$res = $conn->query($sql);
											if ($res) {
												while ($row = $res->fetch_assoc()) {
													$sum = $row['value_sum'];
												}
												echo "
												<h3>$sum ETB</h3>
												";
											}
										
										?>
									</div>
									<div class="box">
										<h4>Laboratory And Reception</h4>
										<!-- <form action="index.php" method="GET">
											<div class="form-elements">
												<input type="date" name="date" id="date">
												<input type="submit" value="Search" name="search_credit" class="btn btn-primary">
											</div>
										</form> -->
										<?php
										$today = date("Y-m-d");
										

											$sql = "SELECT SUM(price) AS lab_sum FROM `credit` WHERE `reason`= 'laboratory' AND `status` = 0";
											
											$sql_ultra = "SELECT SUM(price) AS lab_sys FROM `credit` WHERE `reason`= 'reception' AND `status` = 0";

											$ress = $conn->query($sql);
											$res_sys = $conn->query($sql_ultra);
											
											if ($ress) {
												while ($rows = $ress->fetch_assoc()) {
													$sum_first = $rows['lab_sum'];
													// echo "
													// <h3>$sum_first ETB</h3>
													// ";
													if ($res_sys) {
														while ($rows = $res_sys->fetch_assoc()) {
															$sums = $rows['lab_sys'];
														}
														$sum_sec = $sum_first + $sums;
														echo "
														<h3>$sum_sec ETB</h3>
														";
													}
												}
											}
										
										?>

									</div>
									<div class="box">
										<h4>Total To Pay</h4>
										<!-- <form action="index.php" method="GET">
											<div class="form-elements">
												<input type="date" name="date" id="date">
												<input type="submit" value="Search" name="search_credit" class="btn btn-primary">
											</div>
										</form> -->
										<?php
										$today = date("Y-m-d");
												$sum_sec = $sum_sec + $sum;
												echo "
												<h3>$sum_sec ETB</h3>
												";
										
										?>

									</div>
									<div class="box">
										<form action="index.php">
											<input type="hidden" name="tot_pay" value="<?php echo $sum_sec; ?>">
											<input type="submit" class="btn" value="Pay" name="pay">
										</form>
										<?php
											if(isset($_GET['pay'])){
												$tot = $_GET['tot_pay'];
												$sql = "INSERT INTO `income` (`price`, `reason`) VALUES ('$tot', 'credit')";
												$rs = $conn->query($sql);
												if($rs){
													$rss = $conn->query("UPDATE `credit` SET `status` = 1");
													if(!$rss){
														echo $conn->error;
													}else{
														$sql = "";
														// header('Location: index.php?msg=Credit Paid');
													}
												}
											}else{
												echo $conn->error;
											}
										?>
									</div>
								</div>
						</div>
						<div class="month-report">
							<div class="report">
								<h2>Month Report</h2>
							</div>
							<div class="boxes">
								<div class="box">
									<h4>Reception</h4>
									<form action="index.php" method="GET">
										<div class="form-elements">
											<input type="date" name="date-month" id="date">
											<input type="submit" value="Search" name="search-month" class="btn btn-primary">
										</div>
									</form>
									<?php
									$todays = date("Y-m-d");
									if (isset($_GET['search-month'])) {
										//$today = $_GET['date'];
										$todays = explode('-', $_GET['date-month']);
										$month = $todays[1];
										$year = $todays[0];

										$sql = "SELECT SUM(payment) AS value_sum FROM `patient` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month'";
										$sql2 = "SELECT COUNT(payment) AS count_sum FROM `patient` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month'";
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
												<h3>$count Patients Registered This Month</h3>
												";
										}
									}
									?>
								</div>
								<div class="box">
									<h4>Pharmacy</h4>
									<form action="index.php" method="GET">
										<div class="form-elements">
											<input type="date" name="date-month" id="date">
											<input type="submit" value="Search" name="search-month-pharma" class="btn btn-primary">
										</div>
									</form>
									<?php
									$todays = date("Y-m-d");
									if (isset($_GET['search-month-pharma'])) {
										//$today = $_GET['date'];
										$todays = explode('-', $_GET['date-month']);
										$month = $todays[1];
										$year = $todays[0];

										$sql = "SELECT SUM(price) AS pharma_sum FROM `pharma_daily_sell` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month'";
										$sql2 = "SELECT SUM(price) AS count_sum FROM `system_payment` WHERE YEAR(Date) = '$year' AND Month(Date) = '$month' AND `reason`='pharmacy'";
										$res = $conn->query($sql);
										$res2 = $conn->query($sql2);
										if ($res) {
											while ($row = $res->fetch_assoc()) {
												$sum = $row['pharma_sum'];
												if ($res2) {
													while ($row = $res2->fetch_assoc()) {
														$count = $row['count_sum'];
													}
													$sum_tot = $sum + $count;
													echo "
												<h3>$sum_tot ETB</h3>
												";
												}
											}
										}
									}
									?>
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