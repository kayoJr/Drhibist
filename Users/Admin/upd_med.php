<?php
require '../../backend/auth.php';
require '../../backend/db.php';
$med_id = $_GET['id'];
$sql = "SELECT * FROM `meds` WHERE `id` = '$med_id'";
if($rs = $conn->query($sql)){
    while($row = $rs->fetch_assoc()){
        $med_name = $row['name'];
        $type = $row['type'];
        $amount = $row['amount'];
        $org_price = $row['cost'];
        $sell_price = $row['price'];
        $reg_date = $row['date'];
        $exp_date = $row['exdate'];
    }
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
		<title>Admin</title>
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
							echo $lout;
							?>
						</p>
						</div>
							<form action="../../backend/upd_med.php" method="POST">
                                <h3>Add Medicine</h3>
                                <div class="form-elements">
                                    <div>
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" value="<?php echo $med_name; ?>" required>
                                    </div>
                                    <div>
                                        <label for="type">Type</label>
                                        <input type="text" name="type" id="type" value="<?php echo $type; ?>" required min="0">
                                    </div>
                                    <div>
                                        <label for="amount">Amount</label>
                                        <input type="number" name="amount" id="amount" value="<?php echo $amount; ?>" required>
                                    </div>
                                    <div>
                                        <label for="org_price">Sell Price</label>
                                        <input type="number" name="org_price" id="org_price" value="<?php echo $org_price; ?>" required>
                                    </div>
                                    <div>
                                        <label for="sell_price">Purchase Price</label>
                                        <input type="number" name="sell_price" id="sell_price" value="<?php echo $sell_price; ?>" >
                                    </div>
                                    <div>
                                        <label for="reg_date">Registered Date</label>
                                        <input type="date" name="reg_date" id="reg_date" value="<?php echo $reg_date; ?>"  required>
                                    </div>
                                    <div>
                                        <label for="exp_date">Expire Date</label>
                                        <input type="date" name="exp_date" id="exp_date" value="<?php echo $exp_date; ?>" required>
                                    </div>
                                    <div>
                                        <label for="me">hello</label>
                                        <input type="submit" name="upd_med" value="Update Medicine" class="btn btn-primary mgt">
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $med_id;  ?>">
                                </div>
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
