<?php
require_once "../../backend/db.php";
require '../../backend/auth.php';
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
		<title>Reception</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<link
			href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
			integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		/>
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
								<a href="index.html"
									><img
										class="logo_icon img-responsive"
										src="../../img/logo.png"
										alt="#"
								/></a>
							</div>
						</div>
						<div class="sidebar_user_info">
							<div class="icon_setting"></div>
							<div class="user_profle_side">
								<div class="user_img">
									<img
										class="img-responsive"
										src="../../img/logo.png"
										alt="#"
									/>
								</div>
								<div class="user_info">
									<?php
									$phone = $_SESSION['user'];
									$sql = "SELECT * FROM `users` WHERE `phone` = '$phone'";
									$res = $conn->query($sql);
									while($row = mysqli_fetch_assoc($res)){
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
								<button
									type="button"
									id="sidebarCollapse"
									class="sidebar_toggle"
								>
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
						<div class="info">
						<p class="error">
							<?php
							@$err = $_REQUEST['err'];
							echo $err;
							?>
						</p>
						<p class="succ">
							<?php
							@$lout = $_REQUEST['msg'];
							@$rollno = $_REQUEST['rn'];
							echo $lout.$rollno;
							?>
						</p>
						</div>
							<form action="../../backend/reg_pat.php" method="POST" class="register">
								<div class="form-elements">
									<div>
										<label for="name">Name</label>
										<input type="text" name="name" id="name" required>
									</div>
									<div class="two-input mgb">
										<div class="age-input">
											<label for="age">Age</label>
											<input type="text" name="age" id="age" min="0" required>
										</div>
										<div>
											<label for="me">Age</label>
											<select name="age_type" id="age_type">
												<option value="year">Year(s)</option>
												<option value="month">Month(s)</option>
												<option value="day">Day(s)</option>
											</select>
										</div>
									</div>
									<div>
										<label for="sex">Sex</label>
										<select name="sex" id="sex">
											<option value="male">Male</option>
											<option value="female">Female</option>
										</select>
									</div>
									<div>
										<label for="phone">Phone</label>
										<input type="number" name="phone" id="phone" required>
									</div>
								</div>
								<div class="payment">
									<div>
										<label for="system">System</label>
										<input type="radio" name="payment" id="system" value="system" required>
									</div>
									<div>
										<label for="cash">Cash</label>
										<input type="radio" name="payment" id="cash" checked value="cash" required>
									</div>
									<div>
										<label for="credit">Credit</label>
										<input type="radio" name="payment" id="credit" value="credit" required>
									</div>
								</div>
								<input type="submit" name="add_pat" class="btn btn-primary" value="Register">
							</form>
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
