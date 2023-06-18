<?php
require '../../backend/auth.php';
require '../../backend/db.php';
// $sql = $conn->query("DELETE FROM `pharma_daily_sell` WHERE `quan` = 0");
// $sql2 = $conn->query("DELETE FROM `system_payment` WHERE `price` = 0");

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
    <title>Month Report</title>
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
<style>
    .month_report {
        text-align: center;
        font-size: 2rem;
    }

    .month_report span {
        font-weight: bold;
    }
</style>

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

                        <div class="month-report daily-report">
                            <div class="report">
                                <h2>Month Report</h2>
                            </div>
                            <form action="monthReport.php" method="GET" id="search_income">
                                <div class="form-elements">
                                    <input type="date" name="date-month" id="date">
                                    <input type="submit" value="Search" name="month-report" class="btn btn-primary">
                                </div>
                            </form>
                            <?php

                            if (isset($_GET['date-month'])) {
                                $todays = explode('-', $_GET['date-month']);
                            } else {
                                $todays = explode('-', date('Y-m-d'));
                            }
                            $month = $todays[1];
                            $year = $todays[0];

                            switch ($month) {
                                case 1:
                                    $mon = 'January';
                                    break;
                                case 2:
                                    $mon = 'February';
                                    break;
                                case 3:
                                    $mon = 'March';
                                    break;
                                case 4:
                                    $mon = 'April';
                                    break;
                                case 5:
                                    $mon = 'May';
                                    break;
                                case 6:
                                    $mon = 'June';
                                    break;
                                case 7:
                                    $mon = 'July';
                                    break;
                                case 8:
                                    $mon = 'August';
                                    break;
                                case 9:
                                    $mon = 'September';
                                    break;
                                case 10:
                                    $mon = 'October';
                                    break;
                                case 11:
                                    $mon = 'November';
                                    break;
                                case 12:
                                    $mon = 'December';
                                    break;
                                default:
                                    return false;
                            }
                            // Get the total payment for each day of the month
                            $totalPayments_rec = [];
                            $totalPayments_lab = [];
                            for ($day = 1; $day <= 31; $day++) {
                                //Reception
                                $totalPayment_rec = 0;
                                $sql = "SELECT payment FROM patient WHERE DAY(date) = $day AND MONTH(date) = $month AND YEAR(date) = $year";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $totalPayment_rec += $row["payment"];
                                    }
                                }

                                //Laboratory
                                $totalPayment_lab = 0;
                                $sql = "SELECT price 
    FROM income 
    WHERE DAY(date) = $day AND MONTH(date) = $month AND YEAR(date) = $year AND `reason` = 'laboratory'
    UNION ALL
    SELECT price 
    FROM system_payment 
    WHERE DAY(date) = $day AND MONTH(date) = $month AND YEAR(date) = $year AND `reason` = 'laboratory'
    ";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $totalPayment_lab += $row["price"];
                                    }
                                }

                                //ultrasound
                                $totalPayment_ultra = 0;
                                $sql = "SELECT price 
    FROM income 
    WHERE DAY(date) = $day AND MONTH(date) = $month AND YEAR(date) = $year AND `reason` = 'ultrasound'
    UNION ALL
    SELECT price 
    FROM system_payment 
    WHERE DAY(date) = $day AND MONTH(date) = $month AND YEAR(date) = $year AND `reason` = 'ultrasound'
    ";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $totalPayment_ultra += $row["price"];
                                    }
                                }

                                //pharmacy
                                $totalPayment_pharm = 0;
                                $sql = "SELECT sub_price 
    FROM cash_payment_pharm 
    WHERE DAY(date) = $day AND MONTH(date) = $month AND YEAR(date) = $year
    UNION ALL
    SELECT sub_price 
    FROM system_payment_pharm 
    WHERE DAY(date) = $day AND MONTH(date) = $month AND YEAR(date) = $year
    ";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $totalPayment_pharm += $row["sub_price"];
                                    }
                                }

                                $totalPayments_rec[$day] = $totalPayment_rec;
                                $totalPayments_lab[$day] = $totalPayment_lab;
                                $totalPayments_ultra[$day] = $totalPayment_ultra;
                                $totalPayments_pharm[$day] = $totalPayment_pharm;
                            }

                            // Create the table
                            echo '<table class="table">';
                            echo "<tr>
<th>Day</th>
<th>Reception</th>
<th>Lab</th>
<th>Ultrasound</th>
<th>Pharmacy</th>
<th>Total</th>
</tr>";
                            $m_total = 0;
                            foreach ($totalPayments_rec as $day => $totalPayment_rec) {
                                $total = $totalPayments_lab[$day]
                                    + $totalPayment_rec
                                    + $totalPayments_ultra[$day]
                                    + $totalPayments_pharm[$day];
                                echo "<tr>
            <td>$day</td>
            <td>$totalPayment_rec</td>
            <td>$totalPayments_lab[$day]</td>
            <td>$totalPayments_ultra[$day]</td>
            <td>$totalPayments_pharm[$day]</td>
            <td>" . $total . "</td>
        </tr>";

                                $m_total = $total + $m_total;
                            }
                            echo "

<h1 class='month_report'>{$mon}'s total is: <span>{$m_total}</span> ETB 
    </h1>";
                            echo "</table>";

                            ?>






                            <!-- <div class="boxes">
								<div class="box">
									<h4>Reception</h4>
									<h3><?php echo $sum_rec; ?> ETB</h3>
								</div>
								<div class="box">
									<h4>Pharmacy</h4>
									<h3><?php echo $sum_pharm; ?> ETB</h3>
								</div>
								<div class="box">
									<h4>Laboratory</h4>
									<h3><?php echo $lab_total; ?> ETB</h3>
								</div>
								<div class="box">
									<h4>Ultrasound</h4>
									<h3><?php echo $sum_cash_ultra; ?> ETB</h3>
								</div>
								<div class="box">
									<h4>Total</h4>
									<h3><?php echo $total_month; ?> ETB</h3>
								</div>
							</div> -->

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
</body>

</html>