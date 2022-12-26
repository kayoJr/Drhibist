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
    <title>Ultrasound</title>
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

                            $rs1 = $conn->query("SELECT * FROM `abdominal` WHERE `patient_id`= '$id' AND `date` = '$date'");
                            $neck = $conn->query("SELECT * FROM `neck` WHERE `patient_id`='$id' AND `date` = '$date'");
                            $chest = $conn->query("SELECT * FROM `breast` WHERE `patient_id`='$id' AND `date` = '$date'");
                            $normal_brain = $conn->query("SELECT * FROM `normal_brain` WHERE `patient_id`='$id' AND `date` = '$date'");
                            $other = $conn->query("SELECT * FROM `other` WHERE `patient_id`='$id' AND `date` = '$date'");
                            $info = $conn->query("SELECT * FROM `patient` WHERE `id` = '$id'");
                            $info_det = $info->fetch_assoc();

                            ?>
                        </div>
                        <div class="navigation">
                            <button class="button" onclick="history.go(-1);"><i class="fa-solid fa-chevron-left fa-2x"></i></button>
                            <button class="btn" id="btnPrint">Print</button>
                        </div>
                        <div class="name">
                            <p><?php echo $info_det['name']; ?></p>
                            <p><?php echo $date; ?></p>
                        </div>
                        <div class="ultra_result">
                            <div class='lab'>
                            <?php
                                if ($rs1->num_rows > 0) {
                                    while ($row = $rs1->fetch_assoc()) {
                                        $res_id = $row['id'];
                                        $liver = $row['liver'];
                                        $gb = $row['gb'];
                                        $bowel = $row['bowel'];
                                        $kidney = $row['kidney'];
                                        $pelvic = $row['pelvic'];
                                        $impression = $row['impression'];
                                        $conclusion = $row['conclusion'];
                                        $drname = $row['drname'];
                                    }
                                    echo "
                                    <div class='edit_ultraresu'>
                                    <h2 class='center'>Abdominal Result</h2>
                                    <a href='./edit_ultra.php?id=$res_id&name=Abdominal&pat_id=$id'>Edit</a>
                                    </div>
                                ";
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Liver and Spleen</th>
                                    <td>$liver</td>  
                                </thead>
                                <thead>
                                    <th class='head'>GB and Billary Duct</th>
                                    <td>$gb</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Bowels and Peritoneum</th>
                                    <td>$bowel</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Kidney and Retroperitoneal</th>
                                    <td>$kidney</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Pelvic Organ</th>
                                    <td>$pelvic</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Impressions</th>
                                    <td>$impression</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Conclusion</th>
                                    <td>$conclusion</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Reported By:</th>
                                    <td>Dr. $drname</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                            </div>
                            <div class='lab'>
                            <?php
                                if ($neck->num_rows > 0) {
                                    while ($row = $neck->fetch_assoc()) {
                                        $res_id = $row['id'];
                                        $result = $row['result'];
                                        $impression = $row['impression'];
                                        $conclusion = $row['conclusion'];
                                        $drname = $row['drname'];
                                    }
                                    echo "
                                    <div class='edit_ultraresu'>
                                    <h2 class='center'>Neck Result</h2>
                                    <a href='./edit_ultra.php?id=$res_id&name=Neck&pat_id=$id'>Edit</a>
                                    </div>
                                ";
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Result</th>
                                    <td>$result</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Impression</th>
                                    <td>$impression</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Conclusion</th>
                                    <td>$conclusion</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Reported By:</th>
                                    <td>Dr. $drname</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                            </div>
                            <div class='lab'>
                            <?php
                                if ($chest->num_rows > 0) {
                                    
                                    while ($row = $chest->fetch_assoc()) {
                                        $res_id = $row['id'];
                                        $result = $row['result'];
                                        $impression = $row['impression'];
                                        $conclusion = $row['conclusion'];
                                        $drname = $row['drname'];
                                    }
                                    echo "
                                    <div class='edit_ultraresu'>
                                    <h2 class='center'>Chest Result</h2>
                                    <a href='./edit_ultra.php?id=$res_id&name=Chest&pat_id=$id'>Edit</a>
                                    </div>
                                ";
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Result</th>
                                    <td>$result</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Impression</th>
                                    <td>$impression</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Conclusion</th>
                                    <td>$conclusion</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Reported By:</th>
                                    <td>Dr. $drname</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                            </div>
                            <div class='lab'>
                            <?php
                                if ($normal_brain->num_rows > 0) {
                                    
                                    while ($row = $normal_brain->fetch_assoc()) {
                                        $res_id = $row['id'];
                                        $result = $row['result'];
                                        $impression = $row['impression'];
                                        $conclusion = $row['conclusion'];
                                        $drname = $row['drname'];
                                    }
                                    echo "
                                    <div class='edit_ultraresu'>
                                    <h2 class='center'>Normal Brain Result</h2>
                                    <a href='./edit_ultra.php?id=$res_id&name=normal_brain&pat_id=$id'>Edit</a>
                                    </div>
                                ";
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Result</th>
                                    <td>$result</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Impression</th>
                                    <td>$impression</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Conclusion</th>
                                    <td>$conclusion</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Reported By:</th>
                                    <td>Dr. $drname</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                            </div>
                            <div class='lab'>
                                <?php
                                if ($other->num_rows > 0) {
                                    while ($row = $other->fetch_assoc()) {
                                        $res_id = $row['id'];
                                        $result = $row['result'];
                                        $impression = $row['impression'];
                                        $conclusion = $row['conclusion'];
                                        $drname = $row['drname'];
                                    }
                                    echo "
                                    <div class='edit_ultraresu'>
                                    <h2 class='center'>Other Result</h2>
                                    <a href='./edit_ultra.php?id=$res_id&name=other&pat_id=$id'>Edit</a>
                                    </div>
                                ";
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Result</th>
                                    <td>$result</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Impression</th>
                                    <td>$impression</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Conclusion</th>
                                    <td>$conclusion</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Reported By:</th>
                                    <td>Dr. $drname</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                            </div>
                            
                            
                        </div>

                    </div>
                    <div class="lab-header">
                    <img src="../../img/lab_header.png" alt="">
                </div>
                <div class="lab-footer">
                    <img src="../../img/lab_footer.jpg" alt="">
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
    	document.getElementById("btnPrint").onclick = function() {
		window.print();
	}
</script>