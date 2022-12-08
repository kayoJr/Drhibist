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
						<form action="search.php" class="search">
							<h3>Search For Patient</h3>
							<div class="search-form">
								<input type="number" name="search" id="search" min="0" required placeholder="Phone or Card Number">
								<input type="submit" name="searching" value="Search" class="btn btn-primary">
							</div>
						</form>
						<?php
						if (isset($_GET['searching'])) {
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
										<th>Date</th>
										<th>Action</th>
									</thead>
									";
							if ($rs) {
								while ($result = $rs->fetch_assoc()) {
									$card = $result['id'];
									$pt_name = $result['name'];
									$pt_phone = $result['phone'];
									$age = $result['age'];
									$sex = $result['sex'];
									$date = $result['date'];
									echo "	
												<tbody>
													<tr>
														<td data-label='SNo'>$card</td>
														<td data-label='Name'>$pt_name</td>
														<td data-label='Age'>$age</td>
														<td data-label='Sex'>$sex</td>
														<td data-label='Card No'>$card</td>
														<td data-label='Phone'>$pt_phone</td>
														<td data-label='Date'>$date</td>
														<td>
														<button type='button' class='btn mgt mgb' data-toggle='modal' data-target='#exampleModalCenter'>
														Update
														</button>
														</td>
														</tr>
														</tbody>
														";
									// <a href='../../backend/date.php?id=$card'>update</a>
								}
							}
							echo "</table>";
							echo "<br>";

							echo "
							<div class='modal fade' id='exampleModalCenter' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered' role='document'>
    <div class='modal-content'>
      <div class='modal-body'>
	  <form class='mgt mgb' action='../../backend/date.php' method='POST'>
	  <h2 class='center'>Update User Payment</h2>
	  <div class='payment'>
		  <div>
			  <label for='system'>System</label>
			  <input type='radio' name='payment' id='system' value='system' required>
		  </div>
		  <div>
			  <label for='cash'>Cash</label>
			  <input type='radio' name='payment' id='cash' checked value='cash' required>
		  </div>
	  </div>
	  <input type='hidden' name='id' value='$card'>
	  <input type='submit' class='btn mgt' value='Pay' name='submit'>
  </form>
      </div>
      
    </div>
  </div>
</div>
							";

							$adm = "SELECT * FROM `admission` WHERE `pat_id` = '$phone' OR `pat_phone` = '$phone'";
							$r = $conn->query($adm);
							if ($r->num_rows > 0) {
								while ($rows = $r->fetch_assoc()) {
									$date = $rows['date'];
								}
								echo "
								<div class='center-btn'>
								<h2>In Admission Since $date</h2>
								<a class='btn' href='withdraw.php?id=$phone'>Withdraw</a>
								</div>
								";
							}
							$lab_sql = "SELECT SUM(price) AS totalPay FROM `lab_cart2` WHERE `patient_id`=$card AND `payment`=0 ";
							$sql_res = $conn->query($lab_sql);
							if ($sql_res) {
								$row = $sql_res->fetch_assoc();
								$lab_sum = $row['totalPay'];
							} else {
								echo $conn->error;
							}
						?>
							<div class='payments'>
								<div class='grid-x3'>
									<div class='grid'>
										<form class="mgt mgb" action="../../backend/lab_payment.php" method="POST">
											<h2>Laboratory Payment</h2>
											<h3><?php echo $lab_sum; ?> ETB</h3>
											<input type='hidden' name='price' value='<?php echo $lab_sum; ?>'>
											<input type="hidden" name="id" value="<?php echo $card; ?>">
											<div class="payment mgt">
												<div>
													<label for="system">System</label>
													<input type="radio" name="payment" id="system" value="system" required>
												</div>
												<div>
													<label for="cash">Cash</label>
													<input type="radio" name="payment" id="cash" checked value="cash" required>
												</div>
											</div>
											<input type="submit" class="btn mgt" value="Pay" name="lab_payment">
											<!-- <a href='../../backend/lab_payment.php?id=$card' class='btn btn-primary'>Pay</a> -->
										</form>
									</div>
								</div>
							</div>
						<?php
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