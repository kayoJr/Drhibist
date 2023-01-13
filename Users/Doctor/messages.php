<?php
require_once "../../backend/db.php";
require '../../backend/auth.php';
@$status = @$_GET['status'];
if ($status) {
	$sql = $conn->query("UPDATE `nurse_message` SET `status` = 1");
}
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
	<title>Doctor</title>
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
						<h2 class="center">Messages To Nurses</h2>
					</div>
					<form class="mgb" action="messages.php" method="GET">
						<div class="form-elements">
							<input type="date" name="date" id="date">
							<input type="submit" value="Search" name="search" class="btn mgt btn-primary">
						</div>
					</form>
					<?php
					if (isset($_GET['search'])) {
						$date = $_GET['date'];
						if ($date == '') {
							$date = date("Y-m-d");
						}

					?>
						<div class="doc_message">
							<?php
								$sql = $conn->query("SELECT * FROM `nurse_message` WHERE `date` = '$date' ORDER BY `id` DESC");
								if ($sql) {
								while ($row = $sql->fetch_assoc()) {
									$id = $row['patient_id'];
									$detail = $row['detail'];
									$date = $row['date'];
									$adm_status = "Waiting Patient";
									$adm = $conn->query("SELECT * FROM `admission` WHERE `pat_id`='$id'");
									while ($row2 = $adm->fetch_assoc()) {
										$adm_pat = $row2['pat_id'];

										if ($id == $adm_pat) {
											$adm_status = "Admitted Patient";
										} else {
											$adm_status = "Waiting Patient";
										}
									}
									$info = $conn->query("SELECT * FROM `patient` WHERE `id` = '$id'");
									while ($infoo = $info->fetch_assoc()) {
										$name = $infoo['name'];
										echo " 
                        
                        <div class='message_element'>
                            <div class='info'>
                                <h4>$name</h4>
                                <h4>Card No: $id</h4>
                                <h4>$date</h4>
                                <h4>$adm_status</h4>
                            </div>
                            <div class='message_detail'>
                                <p>$detail
								</p>
                            </div>
                        </div>
                      ";
									}
								}
							}
							?>
						</div>

					<?php
					}else{
						?>
	<div class="doc_message">
							<?php
							$date = date("Y-m-d");
								$sql = $conn->query("SELECT * FROM `nurse_message` WHERE `date` = '$date' ORDER BY `id` DESC");
								if ($sql) {
								while ($row = $sql->fetch_assoc()) {
									$id = $row['patient_id'];
									$detail = $row['detail'];
									$date = $row['date'];
									$adm_status = "Waiting Patient";
									$adm = $conn->query("SELECT * FROM `admission` WHERE `pat_id`='$id'");
									while ($row2 = $adm->fetch_assoc()) {
										$adm_pat = $row2['pat_id'];

										if ($id == $adm_pat) {
											$adm_status = "Admitted Patient";
										} else {
											$adm_status = "Waiting Patient";
										}
									}
									$info = $conn->query("SELECT * FROM `patient` WHERE `id` = '$id'");
									while ($infoo = $info->fetch_assoc()) {
										$name = $infoo['name'];
										echo " 
                        
                        <div class='message_element'>
                            <div class='info'>
                                <h4>$name</h4>
                                <h4>Card No: $id</h4>
                                <h4>$date</h4>
                                <h4>$adm_status</h4>
                            </div>
                            <div class='message_detail'>
                                <p>$detail
								</p>
                            </div>
                        </div>
                      ";
									}
								}
							}
							?>
						</div>

<?php
					}
					?>
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