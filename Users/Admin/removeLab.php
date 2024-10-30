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
    <title>Admin</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link
        href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;600;700;800&display=swap"
        rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
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
                            <a href="index.html"><img
                                    class="logo_icon img-responsive"
                                    src="../../img/logo.png"
                                    alt="#" /></a>
                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="user_img">
                                <img
                                    class="img-responsive"
                                    src="../../img/logo.png"
                                    alt="#" />
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
                                class="sidebar_toggle">
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
                        <form action="./removeLab.php" method="POST">
                            <h3>SEARCH</h3>
                            <div class="form-elements">
                                <div>
                                    <!-- <label for="name">ID</label> -->
                                    <input type="number" name="name" id="name" required>
                                </div>
                                <div>
                                    <input type="submit" name="submit" value="SEARCH" class="btn btn-primary mt-0">
                                </div>
                            </div>

                        </form>
                        <?php
                        $phone = $_SESSION['user'];
                        $pat_id = @$_POST['name'];
                        $date = date('Y-m-d');
                        $sql = "SELECT * FROM `cbc` WHERE `patient_id` = '$pat_id' AND `date` = '$date' ORDER BY `id` DESC";
                        $res = $conn->query($sql);
                        echo "
								<table class='table'>
								<thead>
									<th>Order Number</th>
									<th>WBC</th>
                                    <th>LYM#</th>
                                    <th>MID#</th>
                                    <th>GRA#</th>
                                    <th>LYM%</th>
                                    <th>MID%</th>
                                    <th>GRA%</th>
                                    <th>RBC</th>
                                    <th>HGB</th>
                                    <th>MCHC</th>
                                    <th>MCV</th>
                                    <th>MCH</th>
                                    <th>RDW-CV</th>
                                    <th>HCT</th>
                                    <th>PLT</th>
                                    <th>MPV</th>
                                    <th>PDW</th>
                                    <th>PCT</th>
                                    <th>RDW-SD</th>
                                    <th>ACTION</th>
								</thead>
								";

                        if ($res) {
                            while ($row = $res->fetch_assoc()) {
                                $id = $row['id'];
                                $wbc = $row['WBC'];
                                $lym_h = $row['LYM#'];
                                $mid_h = $row['MID#'];
                                $gra_h = $row['GRA#'];
                                $lym_p = $row['LYM%'];
                                $mid_p = $row['MID%'];
                                $gra_p = $row['GRA%'];
                                $rbc = $row['RBC'];
                                $hgb = $row['HGB'];
                                $mchc = $row['MCHC'];
                                $mcv = $row['MCV'];
                                $mch = $row['MCH'];
                                $rdw_cv = $row['RDW-CV'];
                                $hct = $row['HCT'];
                                $plt = $row['PLT'];
                                $mpv = $row['MPV'];
                                $pdw = $row['PDW'];
                                $pct = $row['PCT'];
                                $rdw_sd = $row['RDW-SD'];
                                $name = $row['date'];
                                echo "
                                	<tbody>
                                <tr>
                                <td data-label='Name'>$id</td>
                                	<td data-label='Name'>$wbc</td>
                                	<td data-label='Name'>$lym_h</td>
                                	<td data-label='Name'>$mid_h</td>
                                	<td data-label='Name'>$gra_h</td>
                                	<td data-label='Name'>$lym_p</td>
                                	<td data-label='Name'>$mid_p</td>
                                	<td data-label='Name'>$gra_p</td>
                                	<td data-label='Name'>$rbc</td>
                                	<td data-label='Name'>$hgb</td>
                                	<td data-label='Name'>$mchc</td>
                                	<td data-label='Name'>$mcv</td>
                                	<td data-label='Name'>$mch</td>
                                	<td data-label='Name'>$rdw_cv</td>
                                	<td data-label='Name'>$hct</td>
                                	<td data-label='Name'>$plt</td>
                                	<td data-label='Name'>$mpv</td>
                                	<td data-label='Name'>$pdw</td>
                                	<td data-label='Name'>$pct</td>
                                	<td data-label='Name'>$rdw_sd</td>
                                	<td data-label='Action' class='delete'>
                                        <a href='../../backend/deleteLab.php?id=$id'>Delete</a>
                                    </td>

                                </tr>
                                </tbody>
                                ";
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