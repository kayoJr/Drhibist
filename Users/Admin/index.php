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
							<div class="boxes">
								<div class="box">
									<h4>Daily System Only Income</h4>
									<?php
									$today = date("Y-m-d");
										$sql = "SELECT SUM(price) AS value_sum FROM `system_payment` WHERE `date` = '$today'";
										$rs = $conn->query($sql);
										$row = $rs->fetch_assoc();
										$sys_sum = $row['value_sum'];
										echo "<h3>$sys_sum ETB</h3>"
									?>
								</div>
								<div class="box">
									<h4>Daily Cash Only Income</h4>
									<?php
									$today = date("Y-m-d");
										$sql = "SELECT SUM(payment) AS rece FROM `patient` WHERE `date` = '$today'";
										$rs = $conn->query($sql);
										$row = $rs->fetch_assoc();
										$rec_sum = $row['rece'];

										$sql = "SELECT SUM(sub_price) AS phar FROM `pharma_daily_sell` WHERE `date` = '$today'";
										$rs = $conn->query($sql);
										$row = $rs->fetch_assoc();
										$phar_sum = $row['phar'];

										$sql = "SELECT SUM(price) AS value_sum FROM `system_payment` WHERE `date` = '$today'";
										$rs = $conn->query($sql);
										$row = $rs->fetch_assoc();
										$sys_sum = $row['value_sum'];

										$tot_sum = ($rec_sum + $phar_sum) - $sys_sum;

										echo "<h3>$tot_sum ETB</h3>"
									?>
								</div>
								<div class="box">
									<h4>Daily Total Income</h4>
									<?php
													$today = date("Y-m-d");
													$sql = "SELECT SUM(payment) AS rece FROM `patient` WHERE `date` = '$today'";
													$rs = $conn->query($sql);
													$row = $rs->fetch_assoc();
													$rec_sum = $row['rece'];
			
													$sql = "SELECT SUM(sub_price) AS phar FROM `pharma_daily_sell` WHERE `date` = '$today'";
													$rs = $conn->query($sql);
													$row = $rs->fetch_assoc();
													$phar_sum = $row['phar'];

													$tot_sum = $rec_sum + $phar_sum;
			
													echo "<h3>$tot_sum ETB</h3>"
									?>
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
									</div>
									<div class="box">
										<h4>Pharmacy</h4>
										<form action="index.php" method="GET">
											<div class="form-elements">
												<input type="date" name="date" id="date">
												<input type="submit" value="Search" name="search_phar" class="btn btn-primary">
											</div>
										</form>
										<?php
										$today = date("Y-m-d");
										if (isset($_GET['search_phar'])) {
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
									<a class="btn btn-primary" href="selled_list.php?id=<?php echo $today; ?>" >List</a>
									</div>
									<div class="box">
										<h4>Ultrasound</h4>
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