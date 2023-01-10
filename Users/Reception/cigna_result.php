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

                        <div class="cigna_result">
                            <div class="header">
                                <img src="../../img/cigna.png" alt="cigna">
                            </div>

                            <?php
                            $cigna_id = $_GET['cigna_id'];
                            $pat_id = $_GET['pat_id'];
                            $dob = $_GET['dob'];
                            $todays = explode('-', $dob);
                            $year = $todays[0];
                            $month = $todays[1];
                            $day = $todays[2];
                            switch ($month) {
                                case 1:
                                    $month = "January";
                                    break;
                                case 2:
                                    $month = "February";
                                    break;
                                case 3:
                                    $month = "March";
                                    break;
                                case 4:
                                    $month = "April";
                                    break;
                                case 5:
                                    $month = "May";
                                    break;
                                case 6:
                                    $month = "June";
                                    break;
                                case 7:
                                    $month = "July";
                                    break;
                                case 8:
                                    $month = "August";
                                    break;
                                case 9:
                                    $month = "September";
                                    break;
                                case 10:
                                    $month = "October";
                                    break;
                                case 11:
                                    $month = "November";
                                    break;
                                case 12:
                                    $month = "December";
                                    break;
                                default:
                                    $month = "Unknown";
                                    break;
                            }
                            //$new_dob = $year.'-'.$month.'-'.$day;
                            $new_dob = $month.' '.$day. ', '.$year;
                            $payment = $_GET['payment_det'];

                            $sql_pat_det = $conn->query("SELECT * FROM `patient` WHERE `id` = '$pat_id'");
                            $sql_doc_det = $conn->query("SELECT `dx` FROM `pat_detail` WHERE `pat_id` = '$pat_id'");

                            $sql_lab_det = $conn->query("SELECT SUM(price) AS lab_sum FROM `credit` WHERE `pat_id` = '$pat_id' AND `org` = 'cigna' AND `reason` = 'laboratory' AND `status` = 0");
                            $sql_ultra_det = $conn->query("SELECT SUM(price) AS ultra_sum FROM `credit` WHERE `pat_id` = '$pat_id' AND `org` = 'cigna' AND `reason` = 'ultrasound' AND `status` = 0");

                            $sql_pharm_det = $conn->query("SELECT SUM(price) AS pharm_sum FROM `credit_pharm` WHERE `patient_id` = '$pat_id' AND `org` = 'cigna'  AND `status` = 0");

                            $row = $sql_pat_det->fetch_assoc();
                            $pat_det = $row['name'];

                            $row2 = $sql_doc_det->fetch_assoc();
                            $doc_det = $row2['dx'];

                            $row3 = $sql_lab_det->fetch_assoc();
                            $lab_det = $row3['lab_sum'];

                            $row4 = $sql_ultra_det->fetch_assoc();
                            $ultra_det = $row4['ultra_sum'];

                            $row5 = $sql_pharm_det->fetch_assoc();
                            $pharm_det = $row5['pharm_sum'];

                            
                            if ($payment == '20') {
                                $paymet_detail = "Copay 20% Covered By Patient";

                                $total = $lab_det + $ultra_det + $pharm_det;
                                $total = $total - (($total * 20) / 100);
                                $total = ceil($total / 54);
                                $calc = ceil(($total * 54 * 20) / 100);

                                $lab_det = $lab_det - (($lab_det * 20) / 100);
                                $ultra_det = $ultra_det - (($ultra_det * 20) / 100);
                                $lab_det = ceil($lab_det / 54);
                                $ultra_det = ceil($ultra_det / 54);

                                $pharm_det = $pharm_det - (($pharm_det * 20) / 100);
                                $pharm_det = ceil($pharm_det / 54);
                            } else {
                                $paymet_detail = "Copay 100% Covered By Cigna";
                                //$total = ceil($total / 54);
                                $calc = 0;
                                
                                $lab_det = ceil($lab_det / 54);
                                $ultra_det = ceil($ultra_det / 54);
                                $pharm_det = ceil($pharm_det / 54);
                                $total = $lab_det + $ultra_det + $pharm_det;
                            }
                            ?>
                            <div class="body">
                                <table class="table">
                                    <thead>
                                        <th>Provider Name</th>
                                        <td>Doctor Hibist Pediatrics Specialty Clinic</td>
                                    </thead>
                                    <thead>
                                        <th>Provider Billing Address</th>
                                        <td>Ethiopia, Jigjiga Kebele 05</td>
                                    </thead>
                                    <thead>
                                        <th>PIMS ID</th>
                                        <td>243075</td>
                                    </thead>
                                    <thead>
                                        <th>Payment Method</th>
                                        <td>Transfer</td>
                                    </thead>
                                    <thead>
                                        <th>Currency</th>
                                        <td>USD</td>
                                    </thead>
                                    <thead>
                                        <th>Patient Cigna ID Number</th>
                                        <td><?php echo $cigna_id; ?></td>
                                    </thead>
                                    <thead>
                                        <th>Patient Full Name</th>
                                        <td><?php echo $pat_det; ?></td>
                                    </thead>
                                    <thead>
                                        <th>Patient Date Of Birth</th>
                                        <td><?php echo $new_dob; ?></td>
                                    </thead>
                                    <thead>
                                        <th>Total Invoice Amount</th>
                                        <td><?php echo $total.' USD'; ?></td>
                                    </thead>
                                    <thead>
                                        <th>Patient Diagnosis</th>
                                        <td><?php echo $doc_det; ?></td>
                                    </thead>
                                    <thead>
                                        <th>Service Given To Patient</th>
                                        <td>Lab and Medication</td>
                                    </thead>
                                    <thead>
                                        <th>List of Charges Per Service</th>
                                        <td>
                                            <div>Lab: <?php echo $lab_det + $ultra_det . " USD"; ?></div>
                                            <div>Medication: <?php echo $pharm_det . " USD"; ?></div>
                                        </td>
                                    </thead>
                                    <thead>
                                        <th>Payment Details</th>
                                        <td><?php echo $paymet_detail; ?></td>
                                    </thead>
                                    <thead>
                                        <th>Provider Signature</th>
                                        <td>Patient Signature</td>
                                    </thead>
                                    <thead class="sign">
                                        <th><p class="inv"></p> </th>
                                        <td></td>
                                    </thead>
                                    <thead>
                                        <th>Date: <?php echo date('Y-m-d'); ?></th>
                                        <td>Date: <?php echo date('Y-m-d'); ?></td>
                                    </thead>
                                </table>
                                <!-- <div class="cigna_detail">
                                    <div class="heading">
                                        <p>Provider Name</p>
                                        <p>Provider Billing Address</p>
                                        <p>PIMS ID</p>
                                        <p>Payment Method</p>
                                        <p>Currency</p>
                                        <p>Patient Cigna ID Number</p>
                                        <p>Patient Full Name</p>
                                        <p>Patient Date Of Birth</p>
                                        <p>Total Invoice Amount</p>
                                        <p>Patient Diagnosis</p>
                                        <p>Service Given To Patient</p>
                                        <p>List of Charges Per Service</p>
                                        <p class='inv'>Hello</p>
                                        <p>Payment Details</p>
                                        <p>Patient Signature</p>
                                        <p class='inv'>Hello</p>
                                        <p class='inv'>Hello</p>
                                        <p>Date: <?php echo date('Y-m-d'); ?></p>
                                    </div>
                                    <div class="tail">
                                        <p>Doctor Hibist Pediatrics Specialty Clinic</p>
                                        <p>Ethiopia, Jigjiga Kebele 05</p>
                                        <p>243075</p>
                                        <p>Transfer</p>
                                        <p>USD</p>
                                        <p><?php echo $cigna_id; ?></p>
                                        <p><?php echo $pat_det; ?></p>
                                        <p><?php echo $new_dob; ?></p>
                                        <p><?php echo $total . " USD"; ?></p>
                                        <p><?php echo $doc_det; ?></p>
                                        <p>Lab and Medication</p>
                                        <p>Lab: <?php echo $lab_det + $ultra_det . " USD"; ?></p>
                                        <p>Medication: <?php echo $pharm_det . " USD"; ?></p>
                                        <p><?php echo $paymet_detail; ?></p>
                                        <p>Provider Signature</p>
                                        <p class='inv'>Hello</p>
                                        <p class='inv'>Hello</p>
                                        <p>Date: <?php echo date('Y-m-d'); ?></p>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="total_to_pay">
                            <h3 class="center">Total to Pay <?php echo $calc . " ETB"; ?></h3>
                            <button class="btn" id="btnPrint">Print</button>
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
<script>
    document.getElementById("btnPrint").onclick = function() {
        window.print();
    }
</script>