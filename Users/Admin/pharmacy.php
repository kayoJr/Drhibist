<?php
require '../../backend/auth.php';
require '../../backend/db.php';



// define how many results you want per page

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
						<div class="info" id="info">
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
						<form action="" method="GET" class="search" id="search_med">
							<h3>Search For Medicine</h3>
							<div class="search-form">
								<select name="med" class="form-control selectpicker" data-live-search="true" id="authors">
									<option selected="" disabled="">Select Medicine</option>
									<?php
									$sql = "SELECT * FROM `meds`";
									$rs = $conn->query($sql);
									foreach ($rs as $author) {
										echo "<option id='" . $author['id'] . "' value='" . $author['name'] . "'>" . $author['name'] . "</option>";
										echo "<h4>" . $author['type'] . "</h4>";
									}
									?>
								</select>
								<input type="submit" name="searching" value="SEARCH" class="btn">
							</div>
						</form>
						<a href="add.php" class="btn center">ADD</a>
						<?php
						if (isset($_GET['searching'])) {
							@$med_name = $_GET['med'];
							$search_sql = "SELECT * FROM `meds` WHERE `name` = '$med_name'";
							$rs = $conn->query($search_sql);
							echo "
									<table class='table'>
									<thead>
										<th>Name</th>
										<th>Type</th>
										<th>Amount</th>
										<th>Selling Price</th>
										<th>Purchase Price</th>
										<th>Reg Date</th>
										<th>Exp Date</th>
										<th>Action</th>
									</thead>
									";
							if ($rs) {
								while ($result = $rs->fetch_assoc()) {
									$id = $result['id'];
									$card = $result['name'];
									$pt_name = $result['type'];
									$amount = $result['amount'];
									$org_price = $result['cost'];
									$sell_price = $result['price'];
									$reg_date = $result['date'];
									$exp_date = $result['exdate'];
									echo "	
												<tbody>
													<tr>
														<td data-label='Name'>$card</td>
														<td data-label='Type'>$pt_name</td>
														<td data-label='amount'>$amount</td>
														<td data-label='Cost'>$org_price</td>
														<td data-label='Price'>$sell_price</td>
														<td data-label='Reg Date'>$reg_date</td>
														<td data-label='Exp Date'>$exp_date</td>
														<td>
														<a href='./upd_med.php?id=$id'>update</a>
														</td>
													</tr>
												</tbody>
												";
								}
							} else {
								echo $conn->error;
							}
							echo "</table>";
						} else if (!isset($_GET['searching'])) {
							//$search_sql = "SELECT * FROM `medicine` ORDER BY `reg_date` DESC LIMIT 10";
							//$rs = $conn->query($search_sql);
							echo "
									<table class='table'>
									<thead>
										<th>Name</th>
										<th>Type</th>
										<th>Amount</th>
										<th>Selling Price</th>
										<th>Purchase Price</th>
										<th>Reg Date</th>
										<th>Exp Date</th>
										<th>Action</th>
									</thead>
									";
							//if ($rs) {
								//while ($result = $rs->fetch_assoc()) {
									

									$results_per_page = 10;

									// find out the number of results stored in database
									$sql = 'SELECT * FROM `meds` ';
									$result = mysqli_query($conn, $sql);
									$number_of_results = mysqli_num_rows($result);

									// determine number of total pages available
									$number_of_pages = ceil($number_of_results / $results_per_page);

									// determine which page number visitor is currently on
									if (!isset($_GET['page'])) {
										$page = 1;
									} else {
										$page = $_GET['page'];
									}

									// determine the sql LIMIT starting number for the results on the displaying page
									$this_page_first_result = ($page - 1) * $results_per_page;

									// retrieve selected results from database and display them on page
									$sql = 'SELECT * FROM `meds` ORDER BY `id` ASC LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
									$result = mysqli_query($con, $sql);
									while ($row = mysqli_fetch_array($result)) {
										$id = $row['id'];
										$card = $row['name'];
										$pt_name = $row['type'];
										$amount = $row['amount'];
										$org_price = $row['cost'];
										$sell_price = $row['price'];
										$reg_date = $row['date'];
										$exp_date = $row['exdate'];
										echo "	
												<tbody>
													<tr>
														<td data-label='Name'>$card</td>
														<td data-label='Type'>$pt_name</td>
														<td data-label='amount'>$amount</td>
														<td data-label='Cost'>$org_price</td>
														<td data-label='Price'>$sell_price</td>
														<td data-label='Reg Date'>$reg_date</td>
														<td data-label='Exp Date'>$exp_date</td>
														<td>
														<a href='./upd_med.php?id=$id'>update</a>
														</td>
													</tr>
												</tbody>
												";
									}

									// display the links to the pages
									

									
								//}
							// } else {
							// 	echo $conn->error;
							// }
							echo "</table>";
							echo '<div class="pagination">';
							//echo $_GET['page'];
							for ($page = 1; $page <= $number_of_pages; $page++) {
								?>
								
								<a class="<?php if(@$_GET['page'] == $page){echo 'current_page';}  ?>" href="pharmacy.php?page=<?php echo $page;  ?>"><?php echo $page;  ?></a>
								<?php
							}

							echo '</div>';
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
</body>

</html>
<script>
	const feedback = document.getElementById("info");
	setTimeout(() => {
		feedback.style.display = "none";
	}, 3000)
</script>