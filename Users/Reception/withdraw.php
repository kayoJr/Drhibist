<?php
require '../../backend/auth.php';
require '../../backend/db.php';
$id = $_GET['id'];
$sql = "SELECT * FROM `admission` WHERE `pat_id`='$id' OR `pat_phone` = '$id'";
$res = $conn->query($sql);
while($row = $res->fetch_assoc()){
    $date = $row['date'];
    $pat_id = $row['pat_id'];
}

$pat = "SELECT * FROM `patient` WHERE `id`='$pat_id'";
$r = $conn->query($pat);
while($result = $r->fetch_assoc()){
    $pat_name = $result['name'];
}


$med = "SELECT SUM(tot_amount) AS tot_med FROM `admission_med` WHERE `patient_id` = '$pat_id'";
$rs = $conn->query($med);
$rows = $rs->fetch_assoc();
$tot = $rows['tot_med'];
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
                        <form action="">
                            <div class="form-elements" id="withdrawal">
                                <?php
                                $date1 = new DateTime($date);
                                $date2 = new DateTime(date("Y-m-d"));
                                $interval = $date1->diff($date2);
                                $bed = $interval->days * 500;

                                $total = $bed + $tot;
                                ?>
                                <div>
                                    <label for="name">Patient Name</label>
                                    <input type="text" name="name" id="name" value="<?php echo $pat_name; ?>" disabled>
                                </div>
                                <div>
                                    <label for="bed">Bed</label>
                                    <input type="text" name="bed" id="bed" value="<?php echo $bed; ?>" disabled>
                                </div>
                                <div>
                                    <label for="XXX">Ultrasound</label>
                                    <input type="text" name="bed" id="bed" value="<?php echo "Not Yet"; ?>" disabled>
                                </div>
                                <div>
                                    <label for="XXX">Oxygen</label>
                                    <input type="text" name="bed" id="bed" value="<?php echo "Not Yet"; ?>" disabled>
                                </div>
                                <div>
                                    <label for="pharmacy">Pharmacy</label>
                                    <input type="text" name="pharmacy" id="pharmacy" value="<?php echo $tot; ?>" disabled>
                                </div>
                                <div>
                                    <label for="service">Service Charge</label>
                                    <input type="text" name="service" id="service" value="<?php echo "not yet"; ?>" disabled>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="total">
                                <label for="total">Total</label>
                                <input type="text" name="total" id="total" value="<?php echo $total; ?>" disabled>
                            </div>

                            <div class="payment">
							<div>
								<label for="system">System</label>
								<input type="radio" name="payment" id="system" value="system" required>
							</div>
							<div>
								<label for="cash">Cash</label>
								<input type="radio" name="payment" id="cash" checked value="cash" required>
								<input type="hidden" name="tot_price" value="<?php echo $num; ?>">
							</div>
						</div>
				
						<button type="button" class="btn" id="btnPrint" data-dismiss="modal">PRINT</button>
						<input type="submit" class="btn" value="Done" name="submit">
                </form>
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
    	document.getElementById("btnPrint").onclick = function() {
		window.print();
	}
</script>