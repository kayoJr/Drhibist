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
                            echo "<p>$msg</p>";
                            $id = $_GET['id'];
                            $date = date("Y-m-d");

                            $rs1 = $conn->query("SELECT * FROM `cmc_ps` WHERE patient_id= '$id'");
                            $rs2 = $conn->query("SELECT * FROM `afb_sputum` WHERE `patient_id`='$id'");
                            $rs3 = $conn->query("SELECT * FROM `crp` WHERE `patient_id`='$id'");
                            $rs4 = $conn->query("SELECT * FROM `bf` WHERE `patient_id`='$id'");
                            $rs5 = $conn->query("SELECT * FROM `bg` WHERE `patient_id`='$id'");
                            $rs6 = $conn->query("SELECT * FROM `fbs` WHERE `patient_id`='$id'");
                            $rs7 = $conn->query("SELECT * FROM `coagulation` WHERE `patient_id`='$id'");
                            $rs8 = $conn->query("SELECT * FROM `gram_stain` WHERE `patient_id`='$id'");
                            $rs9 = $conn->query("SELECT * FROM `hpylori` WHERE `patient_id`='$id'");
                            $rs10 = $conn->query("SELECT * FROM `let` WHERE `patient_id`='$id'");
                            $rs12 = $conn->query("SELECT * FROM `lft` WHERE `patient_id`='$id'");
                            $rs11 = $conn->query("SELECT * FROM `s/e` WHERE `patient_id`='$id'");
                            $rs13 = $conn->query("SELECT * FROM `liver_viral` WHERE `patient_id`='$id'");
                            $rs14 = $conn->query("SELECT * FROM `stool` WHERE `petn_id`='$id'");
                            $rs15 = $conn->query("SELECT * FROM `urine` WHERE `patient_id`='$id'");
                            $rs16 = $conn->query("SELECT * FROM `esr` WHERE `patient_id`='$id'");
                            $rs17 = $conn->query("SELECT * FROM `pict` WHERE `patient_id`='$id'");
                            $rs18 = $conn->query("SELECT * FROM `rft` WHERE `patient_id`='$id'");
                            $rs19 = $conn->query("SELECT * FROM `rpr` WHERE `patient_id`='$id'");
                            $rs20 = $conn->query("SELECT * FROM `tft` WHERE `patient_id`='$id'");
                            $rs21 = $conn->query("SELECT * FROM `uric_acid` WHERE `patient_id`='$id'");
                            $rs22 = $conn->query("SELECT * FROM `vdrl` WHERE `patient_id`='$id'");
                            $rs23 = $conn->query("SELECT * FROM `weil` WHERE `patient_id`='$id'");
                            $rs24 = $conn->query("SELECT * FROM `widalh` WHERE `patient_id`='$id'");
                            $rs25 = $conn->query("SELECT * FROM `widalo` WHERE `patient_id`='$id'");
                            
                            $info = $conn->query("SELECT * FROM `patient` WHERE `id` = '$id'");
                            $info_det = $info->fetch_assoc();
                            ?>
                        </div>
                        <div class="navigation">
                            <button class="button" onclick="history.go(-1);"><i class="fa-solid fa-chevron-left fa-2x"></i></button>
                     
                        </div>
                        <div class="detail" id="patient-detail">
								<h3>Update Detail</h3>
								<div class="lab-res">
                                    <?php
                                    $sql = $conn->query("SELECT * FROM `pat_detail` WHERE `id`='$id'");
                                    while ($row = $sql->fetch_assoc()){
                                        $cc = $row['cc'];
                                        $dt = $row['dt'];
                                        $sy = $row['sy'];
                                        $imp = $row['imp'];
                                        $md = $row['md'];
                                        $cn = $row['cn'];
                                        $pc = $row['pc'];
                                        $vh = $row['vh'];
                                        $aka = $row['aka'];
                                        $lab = $row['lab'];
                                        $dx = $row['dx'];
                                        $rx = $row['rx'];
                                    }
                                    ?>
									<form action="../../backend/upd_detail.php" method="POST" class="add-detail">
										<div class="form">

											<div class="column">

												<label for="C/c">C/C</label>
												<input type="text" name="cc" value="<?php echo $cc; ?>">
												<label for="dt">Duration</label>
												<input type="text" name="dt" value="<?php echo $dt; ?>">
												<label for="sy">Major Associated symptoms</label>
												<input type="text" name="sy" value="<?php echo $sy; ?>">
												<label for="imp">Other important symptoms</label>
												<input type="text" name="imp" value="<?php echo $imp; ?>">
												<label for="md">Any taken Medication</label>
												<input type="text" name="md" value="<?php echo $md; ?>">
												<label for="cn">Current Nutrition</label>
												<input type="text" name="cn" value="<?php echo $cn; ?>">


											</div>
											<div class="column">
												<label for="pc">Previous Similar Cases</label>
												<input type="text" name="pc" value="<?php echo $pc; ?>">
												<label for="vh">Vaccination HX</label>
												<input type="text" name="vh" value="<?php echo $vh; ?>">
												<label for="aka">Any known Allergy</label>
												<input type="text" name="aka" value="<?php echo $aka; ?>">
												<label for="lab">Pertinent Physical Exam</label>
												<input type="text" name="lab" value="<?php echo $lab; ?>">
												<label for="dx">Possible DX</label>
												<input type="text" name="dx" value="<?php echo $dx; ?>">
												<label for="rx">RX Given</label>
												<input type="text" name="rx" value="<?php echo $rx; ?>">
												<input type="hidden" name="pat_id" value="<?php echo $id; ?>">
											</div>
											<input type="submit" value="Update Detail" name="submit" class="btn btn-primary" />
										</div>
									</form>
								</div>
							</div>

                    </div>
                </div>
                <div class="lab-header">
                    <img src="../../img/lab_header.png" alt="">
                </div>
                <div class="lab-footer">
                    <img src="../../img/lab_footer.jpg" alt="">
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
    	document.getElementById("btnPrint").onclick = function() {
		window.print();
	}
</script>