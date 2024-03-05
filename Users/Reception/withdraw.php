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
	<title>Reception</title>
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
					<div class="navigation">
                            <button class="button" onclick="history.go(-1);"><i class="fa-solid fa-chevron-left fa-2x"></i></button>
                            <button class="btn" id="btnPrint">Print</button>
                        </div>
						<?php
						if (isset($_POST['submit'])) {
				
							$ultra = 0;
							$oxygen = 0;
							$pharmacy = 0;
							$laboratory = 0;
							$name = $_POST['name'];
							$id = $_POST['id'];
							$bed = $_POST['bed'];
							$ultra = $_POST['ultra'];
							$oxygen = $_POST['oxygen'];
							$pharmacy = $_POST['pharmacy'];
							$laboratory = $_POST['laboratory'];
							$procedure = $_POST['procedure'];
							$service = (float)$_POST['service'];
							if($laboratory == ''){
								$laboratory = 0;
							}
							if($ultra == ''){
								$ultra = 0;
							}
							if($pharmacy == ''){
								$pharmacy = 0;
							}
							if($oxygen == ''){
								$oxygen = 0;
							}
							if($procedure == ''){
								$procedure = 0;
							}
							
							@$total = $bed + $ultra + $oxygen + $pharmacy + $laboratory + $procedure;
							$s_charge = $total * $service;
							@$total = $bed + $ultra + $oxygen + $pharmacy + $laboratory  + $procedure+ $s_charge;
							
							
						?>
							<div class="detail">
								<form action="../../backend/withdraw_pay.php" method="POST">
								<div class="lab-header">
                    <img src="../../img/lab_header.png" alt="">
                </div>				
							<div class="add_result">
								<h3 class="center">Discharge</h3>
								<div class="results">

									<div class="adm_title">
										<h2>Patient Name</h2>
										<h2>Bed</h2>
										<h2>Ultrasound</h2>
										<h2>Laboratory</h2>
										<h2>Oxygen</h2>
										<h2>Pharmacy</h2>
										<h2>Procedure</h2>
										<h2>Service Charge</h2>
								</div>
								<div class="adm_result">
									<h2><?php echo $name; ?></h2>
									<h2><?php echo $bed; ?></h2>
									<h2><?php echo $ultra; ?></h2>
									<h2><?php echo $laboratory; ?></h2>
									<h2><?php echo $oxygen; ?></h2>
									<h2><?php echo $pharmacy; ?></h2>
									<h2><?php echo $procedure; ?></h2>
									<h2><?php echo $s_charge; ?></h2>
								</div>
								</div>
								<div class="total">
									<h2 class="total">Total:- <?php echo $total; ?></h2>
								</div>
							</div>
							<div class="payment">
										<div>
											<label for="system">System</label>
											<input type="radio" name="payment" id="system" value="system">
										</div>
										<div>
											<label for="cash">Cash</label>
											<input type="radio" name="payment" id="cash" value="cash">
											<input type="hidden" name="tot_price" value="<?php echo $total; ?>">
											<input type="hidden" name="id" value="<?php echo $id; ?>">
										</div>
									</div>
									<!--<input type="hidden" name="total" value="<?php echo $total; ?>">
								<div>
                                    <label for="name">Patient Name</label>
                                    <input type="text" name="name" id="name" value="<?php echo $name; ?>" readonly>
                                </div>
                                <div>
                                    <label for="bed">Bed</label>
                                    <input type="number" name="bed" id="bed" value="<?php echo $bed; ?>" readonly>
                                </div>
                                <div>
                                    <label for="ultra">Ultrasound</label>
                                    <input type="number" name="ultra" id="ultra" value="<?php echo $ultra; ?>" readonly>
                                </div>
                                <div>
                                    <label for="oxygen">Oxygen</label>
                                    <input type="number" min="300" max="1200" name="oxygen" id="oxygen" value="<?php echo $oxygen; ?>" readonly>
                                </div>
                                <div>
                                    <label for="pharmacy">Pharmacy</label>
                                    <input type="number" name="pharmacy" id="pharmacy" value="<?php echo $pharmacy; ?>" readonly>
                                </div>
                                <div>
                                    <label for="laboratory">Laboratory</label>
                                    <input type="number" name="laboratory" id="laboratory" value="<?php echo $laboratory; ?>" readonly>
									<input type="hidden" name="id" value="<?php echo $pat_id; ?>">
                                </div>
                                <div>
                                    <label for="service">Service Charge</label>
                                    <input type="text" name="service" id="service" value="<?php echo $s_charge; ?>" readonly>
                                </div>
									<div class="payment">
										<div>
											<label for="system">System</label>
											<input type="radio" name="payment" id="system" value="system" required>
										</div>
										<div>
											<label for="credit">Credit</label>
											<input type="radio" name="payment" id="credit" value="credit" required>
										</div>
										<div>
											<label for="cash">Cash</label>
											<input type="radio" name="payment" id="cash" checked value="cash" required>
											<input type="hidden" name="tot_price" value="<?php echo $num; ?>">
											<input type="hidden" name="id" value="<?php echo $id; ?>">
										</div>
									</div> -->
									<div>
												<label for="credit">Credit</label>
												<select name="credit" id="credit">
													<option value="" disabled selected>None</option>
													<option value="cigna">Cigna</option>
													<option value="stc">Save The Children</option>
												</select>
											</div>
									<input type="submit" class="btn" value="Pay" name="pay">
								</form>
							</div>
						<?php
						}
						function bed(){
							return $bed = "hello";
						}
						?>
						<!-- footer -->
					</div>
					<!-- end dashboard inner -->
				</div>
				<div class="lab-footer">
                    <img src="../../img/lab_footer.jpg" alt="">
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

<script>
	document.getElementById("btnPrint").onclick = function() {
		window.print();
	}
</script>