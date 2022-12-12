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
		<title>Nurse</title>
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
                            <form action="" class="search">
                                <h3>Search For Patient</h3>
                                <div class="search-form">
                                        <input type="number" name="search" id="search" min="0" required placeholder="Phone or Card Number">
                                        <input type="submit" name="searching" value="Search" class="btn btn-primary">
                                </div>
                            </form>
							<?php
								if(isset($_GET['searching'])){
									$phone = $_GET['search'];
									$search_sql = "SELECT * FROM `patient` WHERE `phone`='$phone' OR `id` = '$phone'";
									$rs = $conn->query($search_sql);
									echo "
									<table class='table'>
									<thead>
										<th>SNo</th>
										<th>Name</th>
										<th>Age</th>
										<th>Sex</th>
										<th>Card No</th>
										<th>Phone</th>
										<th>Action</th>
									</thead>
									";
										if($rs){
											while($result = $rs->fetch_assoc()){
												$card = $result['id'];
												$pt_name = $result['name'];
												$pt_phone = $result['phone'];
												$age = $result['age'];
												$sex = $result['sex'];
												echo "	
												<tbody>
													<tr>
														<td data-label='SNo'>$card</td>
														<td data-label='Name'>$pt_name</td>
														<td data-label='Age'>$age</td>
														<td data-label='Sex'>$sex</td>
														<td data-label='Card No'>$card</td>
														<td data-label='Phone'>$pt_phone</td>						
														<td class='detail' data-label='Detail'><a href='./detail.php?id=$card'>Add</a></td>
													</tr>
												</tbody>
												";
									}
								}
								}
								?>
							<?php
								if(isset($_GET['searching'])){
									$phone = $card;
									$search_sql = "SELECT * FROM `nurse_exam` WHERE `patient_id` = '$phone' ORDER BY `date` DESC";
									$rs = $conn->query($search_sql);
									echo "
									<table class='table'>
									<thead>
										<th>BP</th>
										<th>PR</th>
										<th>Saturation</th>
										<th>Respiratory</th>
										<th>Temperature</th>
										<th>Height</th>
										<th>Weight</th>
										<th>Head</th>
										<th>MUAC</th>
										<th>Date</th>
									</thead>
									";
										if($rs){
											while($result = $rs->fetch_assoc()){
												$bp = $result['BP'];
												$pr = $result['PR'];
												$saturation = $result['saturation'];
												$respiratory = $result['respiratory'];
												$temp = $result['temprature'];
												$height = $result['height'];
												$weight = $result['weight'];
												$head = $result['head_circum'];
												$muac = $result['MUAC'];
												$date = $result['date'];
												echo "	
												<tbody>
													<tr>
													<td data-label='BP'>$bp</td>
													<td data-label='PR'>$pr</td>
													<td data-label='Saturation'>$saturation</td>
													<td data-label='Respiratory'>$respiratory</td>
													<td data-label='Temperature'>$temp</td>
													<td data-label='Height'>$height</td>
													<td data-label='Weight'>$weight</td>
													<td data-label='Head'>$head</td>
													<td data-label='MUAC'>$muac</td>
													<td data-label='Date'>$date</td>
													</tr>
												</tbody>
												";
									}
								}
								}
								?>
								</table>
                            <?php
// if(isset($_GET['searching'])){
// 	$phone = $_GET['search'];
// 	$search_sql = "SELECT * FROM `admission_det` WHERE `patient_id`='$phone' ORDER BY `date` DESC";
// 	$rs = $conn->query($search_sql);

// 	if($rs){
// 		while($row = $rs->fetch_assoc()){
// 			$detail = $row['detail'];
// 			$date = $row['date'];
// 			echo "
// 			<div class='detail addm_detail'>
// 			<h2>Message For Admission Patient</h2>
// 			<div>
// 			<p>-> $detail </p>
// 			<p>$date </p>
// 			</div>
// 			</div>
// 			";
			
			

// 		}
// 	}
// }
if(isset($_GET['searching'])){
	$phone = $_GET['search'];
	$search_sql = "SELECT * FROM `nurse_message` WHERE `patient_id`='$phone' ORDER BY `date` DESC";
	$rs = $conn->query($search_sql);

	if($rs){
		while($row = $rs->fetch_assoc()){
			$detail = $row['detail'];
			$date = $row['date'];
			echo "
			<div class='detail addm_detail'>
			<h2>Message From Doctor</h2>
			<div>
			<p>-> $detail </p>
			<p>$date </p>
			</div>
			</div>
			";
			
			

		}
	}
}

?>
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
<script>
	window.setInterval( function() {
  window.location.reload();
}, 3000);
</script>