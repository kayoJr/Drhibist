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
							echo $lout;
							?>
						</p>
						</div>
						<div class="navigation">
                            <button class="button" onclick="history.go(-1);"><i class="fa-solid fa-chevron-left fa-2x"></i></button>
                        </div>
							<?php
								$phone = $_SESSION['user'];
								$sql = "SELECT * FROM `admission` ORDER BY `id` DESC";
								$res = $conn->query($sql);
								echo "
								<table class='table'>
								<thead>
									<th>Name</th>
									<th>Sex</th>
									<th>Patient Id</th>
									<th>Adm Date</th>
									<th>Duration</th>
                                    <th>Action</th>
								</thead>
								";
					
								if($res){
									while($row = $res->fetch_assoc()){
										$phone = $row['pat_id'];
										$adm_date = $row['date'];

                                        $now = date("Y-m-d");
                                        $date1 = new DateTime($adm_date);
                                        $date2 = new DateTime(date("Y-m-d"));
                                        $interval = $date1->diff($date2);

                                        $duration = $interval->days;
									$pat_info = $conn->query("SELECT * FROM `patient` WHERE `id` = '$phone'");
                                        while($row2 = $pat_info->fetch_assoc()){
                                                $name = $row2['name'];
                                                $sex = $row2['sex'];
                                            echo "
                                            <tbody>
                                            <tr>
                                            <td data-label='Name'>$name</td>
                                            <td data-label='Sex'>$sex</td>
                                            <td data-label='Patient Id'>$phone</td>
                                            <td data-label='Adm Date'>$adm_date</td>
                                            <td data-label='Duration'>$duration days</td>
                                            <td data-label='Action' class='delete'>
                                            <a href='./search.php?search=$phone&searching=Search'>Withdraw</a>
                                            </td>
                                            
                                            </tr>
                                            </tbody>
                                            ";
                                        }
									}
								}
							?>
							
							</table>
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
