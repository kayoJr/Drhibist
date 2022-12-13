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
									$now = date("Y-m-d");
									$date1 = new DateTime($date);
									$date2 = new DateTime(date("Y-m-d"));
									$interval = $date1->diff($date2);

									if(($interval->days)>=10){
										$block = "";
									}else{
										$block = "blocked";
									}
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
														<button type='button' class='btn mgt mgb $block' data-toggle='modal' data-target='#exampleModalCenter'>
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
								<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#withdrawmodal'>
  Withdraw</button>
								</div>
								";
							}
						?>
							<div class="modal fade" id="withdrawmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">

										<div class="modal-body">
											<form action="./withdraw.php" method="POST">
												<div class="form-elements" id="withdrawal">
													<?php
													$sql = "SELECT * FROM `admission` WHERE `pat_id`='$phone' OR `pat_phone` = '$phone'";
													$res = $conn->query($sql);
													while ($row = $res->fetch_assoc()) {
														$date = $row['date'];
														$pat_id = $row['pat_id'];
													}

													$pat = "SELECT * FROM `patient` WHERE `id`='$pat_id'";
													$r = $conn->query($pat);
													while ($result = $r->fetch_assoc()) {
														$pat_name = $result['name'];
													}


													$med = "SELECT SUM(tot_amount) AS tot_med FROM `admission_med` WHERE `patient_id` = '$pat_id'";
													$rs = $conn->query($med);
													$rows = $rs->fetch_assoc();
													$tot = $rows['tot_med'];

													$lab = "SELECT SUM(price) AS lab_tot FROM `admission_pay` WHERE `pat_id` = '$pat_id' AND `reason`= 'laboratory'";
													$rss = $conn->query($lab);
													$rows = $rss->fetch_assoc();
													$tot_lab = $rows['lab_tot'];

													$ultra = "SELECT SUM(price) AS lab_tot FROM `admission_pay` WHERE `pat_id` = '$pat_id' AND `reason`= 'ultrasound'";
													$rsss = $conn->query($ultra);
													$rowss = $rsss->fetch_assoc();
													$tot_ultra = $rowss['lab_tot'];


													$date1 = new DateTime($date);
													$date2 = new DateTime(date("Y-m-d"));
													$interval = $date1->diff($date2);
													$bed = $interval->days * 500;

													$total = $bed + $tot + $tot_lab + $tot_ultra;
													?>
													<div>
														<label for="name">Patient Name</label>
														<input type="text" name="name" id="name" value="<?php echo $pat_name; ?>" readonly>
													</div>
													<div>
														<label for="bed">Bed</label>
														<input type="number" name="bed" id="bed" value="<?php echo $bed; ?>" readonly>
													</div>
													<div>
														<label for="ultra">Ultrasound</label>
														<input type="number" name="ultra" id="ultra" value="<?php echo $tot_ultra; ?>" readonly>
													</div>
													<div>
														<label for="oxygen">Oxygen</label>
														<input type="number" min="0" max="1200" name="oxygen" id="oxygen" required>
													</div>
													<div>
														<label for="pharmacy">Pharmacy</label>
														<input type="number" name="pharmacy" id="pharmacy" value="<?php echo $tot; ?>" readonly>
													</div>
													<div>
														<label for="laboratory">Laboratory</label>
														<input type="number" name="laboratory" id="laboratory" value="<?php echo $tot_lab; ?>" readonly>
														<input type="hidden" name="id" value="<?php echo $pat_id; ?>">
													</div>
													<div>
														<!-- <label for="service">Service Charge</label>
                                    <input type="text" name="service" id="service" value="<?php echo "not yet"; ?>" disabled> -->
														<label for="service">Service Charge</label>
														<select name="service" id="service">
															<option value="0.2">0.2</option>
															<option value="0.3">0.3</option>
															<option value="0.4">0.4</option>
															<option value="0.5">0.5</option>
														</select>
													</div>
												</div>
												<br>
												<br>
												<!-- <div class="total">
                                <label for="total">Total</label>
                                <input type="text" name="total" id="total" value="<?php echo $total; ?>" disabled>
                            </div> -->

												<!-- <div class="payment">
							<div>
								<label for="system">System</label>
								<input type="radio" name="payment" id="system" value="system" required>
							</div>
							<div>
								<label for="cash">Cash</label>
								<input type="radio" name="payment" id="cash" checked value="cash" required>
								<input type="hidden" name="tot_price" value="<?php echo $num; ?>">
							</div>
						</div> -->

												<!-- <button type="button" class="btn" id="btnPrint" data-dismiss="modal">PRINT</button> -->
												<input type="submit" class="btn" value="Check Total" name="submit">
											</form>
										</div>

									</div>
								</div>
							</div>
							<?php
							$lab_sql = "SELECT SUM(price) AS totalPay FROM `lab_cart2` WHERE `patient_id`=$card AND `payment`=0 ";
							$sql_res = $conn->query($lab_sql);
							if ($sql_res) {
								$row = $sql_res->fetch_assoc();
								$lab_sum = $row['totalPay'];
							} else {
								echo $conn->error;
							}
							$ultra_sql = "SELECT SUM(price) AS ultra_payment FROM `ultra_cart` WHERE `patient_id`=$card AND `payment`=0 ";
							$ultra_res = $conn->query($ultra_sql);
							if ($ultra_res) {
								$rows = $ultra_res->fetch_assoc();
								$ultra_sum = $rows['ultra_payment'];
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
													<input type="radio" name="payment" id="system" value="system" required>
													<label for="system">System</label>
												</div>
												<div>
													<input type="radio" name="payment" id="cash" checked value="cash" required>
													<label for="cash">Cash</label>
												</div>
												<div>
													<input type="radio" name="payment" id="credit" value="credit" required>
													<label for="credit">Credit</label>
												</div>
												<div>
													<input type="radio" name="payment" id="admission" value="admission" required>
													<label for="admission">Admission</label>
												</div>
											</div>
											<input type="submit" class="btn mgt" value="Pay" name="lab_payment">
											<!-- <a href='../../backend/lab_payment.php?id=$card' class='btn btn-primary'>Pay</a> -->
										</form>
									</div>
									<div class='grid'>
										<form class="mgt mgb" action="../../backend/ultra_payment.php" method="POST">
											<h2>Ultrasound Payment</h2>
											<h3><?php echo $ultra_sum; ?> ETB</h3>
											<input type='hidden' name='price' value='<?php echo $ultra_sum; ?>'>
											<input type="hidden" name="id" value="<?php echo $card; ?>">
											<div class="payment mgt">
												<div>
													<label for="admission">Admission</label>
													<input type="radio" name="payment" id="admission" value="admission" required>
												</div>
												<div>
													<label for="cash">Cash</label>
													<input type="radio" name="payment" id="cash" checked value="cash" required>
												</div>
											</div>
											<input type="submit" class="btn mgt" value="Pay" name="ultra_payment">
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