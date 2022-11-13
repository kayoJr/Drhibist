<?php
require_once '../../backend/db.php';
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
	<title>Doctor</title>
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
								$phone = $_SESSION['user'];
								$sql = "SELECT * FROM `users` WHERE `phone` = '$phone'";
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
						<form action="index.php" class="search">
							<h3>Search For Patient</h3>
							<div class="search-form">
								<input type="number" name="search" id="search" min="0" required placeholder="Phone or Card Number" />
								<input type="submit" name="searching" value="Search" class="btn btn-primary" />
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
									</thead>
									";
							if ($rs) {
								while ($result = $rs->fetch_assoc()) {
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
													</tr>
												</tbody>
												";
								}
							}
						}
						?>
						<?php
						if (isset($_GET['searching'])) {
							$pat_id = $card;
							$search_sql = "SELECT * FROM `nurse_exam` WHERE `patient_id` = '$pat_id' ORDER BY `date` DESC";
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
							if ($rs) {
								while ($result = $rs->fetch_assoc()) {
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
						<div class="action">
							<button class="btn btn-primary" id="btn-lab">Laboratory</button>
							<button class="btn btn-primary" id="btn-detail">Detail</button>
							<!-- <button class="btn btn-primary" id="btn-radio">
									Ultrasound
								</button> -->
							<!-- <button class="btn btn-primary" id="btn-pres">Prescribe</button> -->
						</div>
						<div class="detail hide" id="patient-detail">
							<h3>Patient Detail</h3>
							<p>
								Lorem ipsum dolor sit amet consectetur adipisicing elit.
								Quibusdam cupiditate aliquam ullam vitae neque nihil accusamus
								quos, similique itaque quae iure, aut consectetur rem dolore?
							</p>
							<div class="lab-result">
								<p>Lab result goes here</p>
							</div>
							<form action="" class="add-detail">
								<h3>Write Detail</h3>
								<div class="search-form">
									<div>
										<textarea name="detail" id="detail" cols="60" rows="10">
											</textarea>
									</div>
									<input type="submit" value="Add Detail" class="btn btn-primary" />
								</div>
							</form>
						</div>
						<div class="lab-order hide" id="lab">
							<form method="post" id="insert_form" action="../../backend/lab_cart.php">
								<select name="name" class="form-control selectpicker" data-live-search="true" id="authors">
									<option selected="" disabled="">Laboratory Type</option>
									<?php
									require 'data.php';
									$authors = loadAuthors();
									foreach ($authors as $author) {
										echo "<option id='" . $author['id'] . "' value='" . $author['name'] . "'>" . $author['name'] . "</option>";
									}
									?>
								</select>
								<input type="text" class="hide" name="doc" id="doc" value="<?php echo $id; ?>">
								<input type="text" class="hide" name="pat" id="pat" value="<?php echo $pat_id; ?>">
								<input type="text" name="books" id="books" readonly class="form-control">
								<div align="center">
									<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Add To Cart" data-toggle="modalss" data-target="#exampleModalCenter" />
								</div>
							</form>
							<div class="cart">
								<h3 class="center">Cart</h3>
								<div class="elements">
									<div class="middle-cart">
										<?php
										$date = date("Y-m-d");
										$sql = "SELECT * FROM `lab_cart` WHERE `date` = '$date' ORDER BY `id` DESC";
										$rs = mysqli_query($con, $sql);
										if (mysqli_num_rows($rs)) {
											while ($row = mysqli_fetch_assoc($rs)) {
												$id = $row['id'];
										?>

												<div class="element">
													<div>
														<?php
														echo "<a href='../../backend/remove_cart.php?rn=$id'><b>X</b></a>";

														echo  "<h4>" . $row['name']."</h4>";
														?>
													</div>
												</div>

										<?php
											}
										}

										?>

									</div>
									<div class="bottom-cart">
										<!-- <a href="#" data-modal-target="#modal">Confirm Order</a> -->
										<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Send To Lab</button>
									</div>
								</div>
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
	<script src="../js/doctor.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
</body>

</html>
<script>
	$(document).ready(function() {
		$("#authors").change(function() {
			var aid = $("#authors").val();
			$.ajax({
				url: 'data.php',
				method: 'post',
				data: 'aid=' + aid
			}).done(function(books) {
				books = JSON.parse(books);
				$('#books').empty();
				books.forEach(function(book) {
					//$('#books').append('<option>Hello</option>')
					$('#books').val(book.price)
				})
			})
		})
	})
	const feedback = document.getElementById("feedback");
	setTimeout(() => {
		feedback.style.display = "none";
	}, 3000)
</script>