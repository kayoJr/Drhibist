<?php
require_once '../../backend/db.php';
require '../../backend/auth.php';
$type = $_GET['name'];
$res_id = $_GET['id'];
$pat_id = $_GET['pat_id'];
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
	<title>Ultrasound</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;600;700;800&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="icon" href="../../img/favicon.ico" type="image/png" />
	<link rel="stylesheet" href="../styles/bootstrap.min.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="../styles/style.css" />
	<link rel="stylesheet" href="../styles/responsive.css" />
	<link rel="stylesheet" href="../styles/bootstrap-select.css" />
	<link rel="stylesheet" href="../styles/perfect-scrollbar.css" />
	<link rel="stylesheet" href="../styles/custom.css" />

	<style>
		.btn-group {
			display: none !important;
		}
	</style>
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
								$phone_doc = $_SESSION['user'];
								$sql = "SELECT * FROM `users` WHERE `phone` = '$phone_doc'";
								$res = $conn->query($sql);
								while ($row = mysqli_fetch_assoc($res)) {
									$name = $row['name'];
									$id = $row['id'];
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
						<div id="feedback">
							<?php
							@$msg = $_REQUEST['msg'];
							echo "<p>$msg</p>"
							?>
						</div>
						<div class="navigation">
							<button class="button" onclick="history.go(-1);"><i class="fa-solid fa-chevron-left fa-2x"></i></button>
						</div>
						<div class="ultra_result">
							<?php
							if ($type == "Abdominal") {
								$sql = $conn->query("SELECT * FROM `abdominal` WHERE `id` = '$res_id'");
								while ($row = $sql->fetch_assoc()) {
									$liver = $row['liver'];
									$gb = $row['gb'];
									$bowel = $row['bowel'];
									$kid = $row['kidney'];
									$pel = $row['pelvic'];
									$impression = $row['impression'];
									$conclusion = $row['conclusion'];
									$drname = $row['drname'];
								}
							?>
								<form action="../../backend/upd_ultra_res.php" method="POST">
									<div class="abdominal">
										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Liver And Spleen</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="liver_res" id="liver_res" cols="30" rows="10">
<?php echo $liver; ?>
											</textarea>
										</div>

									</div>
									<div class="abdominal">

										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">GB AND BILLARY DUCT</h3>
												<a href="" id="remove_gb">x</a>
											</div>
											<textarea name="gb" id="gb" cols="30" rows="10">
<?php echo $gb; ?>
										</textarea>
										</div>

									</div>
									<div class="abdominal">
										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">BOWELS AND PERITONEUM</h3>
												<a href="" id="remove_bowel">x</a>
											</div>
											<textarea name="bowel" id="bowel" cols="30" rows="10">
<?php echo $bowel; ?>
											</textarea>
										</div>

									</div>
									<div class="abdominal">

										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">KIDNEY AND RETROPERITONEAL ORGAN</h3>
												<a href="" id="remove_kid">x</a>
											</div>
											<textarea name="kid" id="kid" cols="30" rows="10">
<?php echo $kid; ?>
											</textarea>
										</div>

									</div>
									<div class="abdominal">

										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">PELVIC ORGAN</h3>
												<a href="" id="remove_pel">x</a>
											</div>
											<textarea name="pel" id="pel" cols="30" rows="10">
<?php echo $pel; ?>
										</textarea>
										</div>

									</div>
									<div class="abdominal">

										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Impression:</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="impression" id="impression" cols="30" rows="10">
<?php echo $impression; ?>
											</textarea>
										</div>
									</div>
									<div class="abdominal">

										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Conclusion:</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="conclusion" id="conclusion" cols="30" rows="10">
<?php echo $conclusion; ?>
											</textarea>
										</div>
									</div>
									<div class="abdominal">
										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Doctor Name</h3>
												<a href="" id="remove">x</a>
											</div>
											<input type="text" name="drname" id="drname" value="<?php echo $name; ?>" required>
										</div>
									</div>
									<input type="hidden" name="pat" value="<?php echo $res_id; ?>">
									<input type="hidden" name="pat_id" value="<?php echo $pat_id; ?>">
									<input type="submit" name="abdominal" value="Update" class="btn">
								</form>


							<?php

							}
							if ($type == "Chest") {
								$sql = $conn->query("SELECT * FROM `breast` WHERE `id` = '$res_id'");
								while ($row = $sql->fetch_assoc()) {
									$result = $row['result'];
									$impression = $row['impression'];
									$conclusion = $row['conclusion'];
									$drname = $row['drname'];
								}
							?>
								<form action="../../backend/upd_ultra_res.php" method="POST">
									<div class="abdominal">
										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Chest Ultrasound Report</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="breast_res" id="breast_res" cols="30" rows="10">
<?php echo $result; ?>
											</textarea>
										</div>

									</div>

									<div class="abdominal">

										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Impression:</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="impression" id="impression" cols="30" rows="10">
<?php echo $impression; ?>
											</textarea>
										</div>
									</div>
									<div class="abdominal">

										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Conclusion:</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="conclusion" id="conclusion" cols="30" rows="10">
<?php echo $conclusion; ?>
											</textarea>
										</div>
									</div>
									<div class="abdominal">
										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Doctor Name</h3>
												<a href="" id="remove">x</a>
											</div>
											<input type="text" name="drname" id="drname" value="<?php echo $name; ?>" required>
										</div>
									</div>
									<input type="hidden" name="pat" value="<?php echo $res_id; ?>">
									<input type="hidden" name="pat_id" value="<?php echo $pat_id; ?>">
									<input type="submit" name="breast" value="Update" class="btn">
								</form>

							<?php
							}
							if ($type == "Neck") {
								$sql = $conn->query("SELECT * FROM `neck` WHERE `id` = '$res_id'");
								while ($row = $sql->fetch_assoc()) {
									$result = $row['result'];
									$impression = $row['impression'];
									$conclusion = $row['conclusion'];
									$drname = $row['drname'];
								}
							?>


								<form action="../../backend/upd_ultra_res.php" method="POST">
									<div class="abdominal">
										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Neck Ultrasound Report</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="neck_res" id="neck_res" cols="30" rows="10">
<?php echo $result; ?>
											</textarea>
										</div>

									</div>

									<div class="abdominal">

										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Impression:</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="impression" id="impression" cols="30" rows="10">
<?php echo $impression; ?>												
											</textarea>
										</div>
									</div>
									<div class="abdominal">

										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Conclusion:</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="conclusion" id="conclusion" cols="30" rows="10">
<?php echo $conclusion; ?>												
											</textarea>
										</div>
									</div>
									<div class="abdominal">
										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Doctor Name</h3>
												<a href="" id="remove">x</a>
											</div>
											<input type="text" name="drname" id="drname" value="<?php echo $name; ?>" required>
										</div>
									</div>
									<input type="hidden" name="pat" value="<?php echo $res_id; ?>">
									<input type="hidden" name="pat_id" value="<?php echo $pat_id; ?>">
									<input type="submit" name="neck" value="Update" class="btn">
								</form>
							<?php

							}
							if ($type == "normal_brain") {
								$sql = $conn->query("SELECT * FROM `normal_brain` WHERE `id` = '$res_id'");
								while ($row = $sql->fetch_assoc()) {
									$result = $row['result'];
									$impression = $row['impression'];
									$conclusion = $row['conclusion'];
									$drname = $row['drname'];
								}
							?>
								<form action="../../backend/upd_ultra_res.php" method="POST">
									<div class="abdominal">
										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Normal Brain Ultrasound Report</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="scrotal_res" id="scrotal_res" cols="30" rows="10">
<?php echo $result; ?>
											</textarea>
										</div>

									</div>

									<div class="abdominal">

										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Impression:</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="impression" id="impression" cols="30" rows="10">
<?php echo $impression; ?>												
											</textarea>
										</div>
									</div>
									<div class="abdominal">

										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Conclusion:</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="conclusion" id="conclusion" cols="30" rows="10">
<?php echo $conclusion; ?>												
											</textarea>
										</div>
									</div>
									<div class="abdominal">
										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Doctor Name</h3>
												<a href="" id="remove">x</a>
											</div>
											<input type="text" name="drname" id="drname" value="<?php echo $name; ?>" required>
										</div>
									</div>
									<input type="hidden" name="pat" value="<?php echo $res_id; ?>">
									<input type="hidden" name="pat_id" value="<?php echo $pat_id; ?>">
									<input type="submit" name="scrotal" value="Update" class="btn">
								</form>
							<?php
							}
							if ($type == "other") {
								$sql = $conn->query("SELECT * FROM `other` WHERE `id` = '$res_id'");
								while ($row = $sql->fetch_assoc()) {
									$result = $row['result'];
									$impression = $row['impression'];
									$conclusion = $row['conclusion'];
									$drname = $row['drname'];
								}
							?>
								<form action="../../backend/upd_ultra_res.php" method="POST">
									<div class="abdominal">
										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Other</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="other_res" id="other_res" cols="30" rows="10">
<?php echo $result; ?>											
											</textarea>
										</div>

									</div>

									<div class="abdominal">

										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Impression:</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="impression" id="impression" cols="30" rows="10">
<?php echo $impression; ?>												
											</textarea>
										</div>
									</div>
									<div class="abdominal">

										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Conclusion:</h3>
												<a href="" id="remove">x</a>
											</div>
											<textarea name="conclusion" id="conclusion" cols="30" rows="10">
<?php echo $conclusion; ?>												
											</textarea>
										</div>
									</div>
									<div class="abdominal">
										<div class="ultra_type" id="liver">
											<div class="type">
												<h3 class="mgb">Doctor Name</h3>
												<a href="" id="remove">x</a>
											</div>
											<input type="text" name="drname" id="drname" value="<?php echo $name; ?>" required>
										</div>
									</div>
									<input type="hidden" name="pat" value="<?php echo $res_id; ?>">
									<input type="hidden" name="pat_id" value="<?php echo $pat_id; ?>">
									<input type="submit" name="other" value="Update" class="btn">
								</form>
							<?php
							}

							?>


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
	<script src="../js/ultra.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
</body>

</html>
<script>
	const feedback = document.getElementById("feedback");
	setTimeout(() => {
		feedback.style.display = "none";
	}, 3000)
</script>