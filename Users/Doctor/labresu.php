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

                            ?>
                        </div>
                        <div class="navigation">
                            <a href="http://localhost/drhibist/Users/Doctor/index.php?search=<?php echo $id; ?>&searching=Search"><i class="fa-solid fa-chevron-left fa-2x"></i></a>
                        </div>
                        <div class="lab_result">
                            <div class='lab'>
                                <?php
                                if ($rs1->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Hematology Result</h2>";
                                    while ($row = $rs1->fetch_assoc()) {
                                        $image = $row['filename'];
                                    }
                                    echo "<img src='../../img/Screenshots/$image'>";
                                }
                                ?>
                            </div>
                            <div class='lab'>
                                <?php
                                if ($rs2->num_rows > 0) {
                                    echo "
                                <h2 class='center'>AFB Sputum Result</h2>
                                ";
                                    while ($row = $rs2->fetch_assoc()) {
                                        $spot = $row['SPOT'];
                                        $morning = $row['MORNING'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>SPOT</th>
                                    <td>$spot</td>  
                                </thead>
                                <thead>
                                    <th class='head'>MORNING</th>
                                    <td>$morning</td>  
                                    </thead>
                                    
                                    </table>";
                                }
                                ?>
                                <?php
                                if ($rs3->num_rows > 0) {
                                    echo "
                                <h2 class='center'>CRP Result</h2>
                                ";
                                    while ($row = $rs3->fetch_assoc()) {
                                        $crp = $row['crp'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>CRP</th>
                                    <td>$crp</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                                <?php
                                if ($rs4->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Blood Film Result</h2>
                                ";
                                    while ($row = $rs4->fetch_assoc()) {
                                        $bf = $row['bf'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Blood Film</th>
                                    <td>$bf</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                                <?php
                                if ($rs5->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Blood Group Result</h2>
                                ";
                                    while ($row = $rs5->fetch_assoc()) {
                                        $bg = $row['bg'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Blood Group</th>
                                    <td>$bg</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                            </div>
                            <div class='lab'>
                                <?php
                                if ($rs6->num_rows > 0) {
                                    echo "
                                <h2 class='center'>FBS Result</h2>
                                ";
                                    while ($row = $rs6->fetch_assoc()) {
                                        $fbs = $row['fbs'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>FBS</th>
                                    <td>$fbs</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                                <?php
                                if ($rs7->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Coagulation Result</h2>
                                ";
                                    while ($row = $rs7->fetch_assoc()) {
                                        $PT = $row['PT'];
                                        $PTT = $row['PTT'];
                                        $INR = $row['INR'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>PT</th>
                                    <td>$PT</td>  
                                </thead>
                                <thead>
                                    <th class='head'>PTT</th>
                                    <td>$PTT</td>  
                                </thead>
                                <thead>
                                    <th class='head'>INR</th>
                                    <td>$INR</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                                <?php
                                if ($rs8->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Gram Stain Result</h2>
                                ";
                                    while ($row = $rs8->fetch_assoc()) {
                                        $gram_stain = $row['gram_stain'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Gram Stain</th>
                                    <td>$gram_stain</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                                <?php
                                if ($rs9->num_rows > 0) {
                                    echo "
                                <h2 class='center'>H Pylori Result</h2>
                                ";
                                    while ($row = $rs9->fetch_assoc()) {
                                        $hpylori_ag = $row['hpylori_ag'];
                                        $hpylori_ab = $row['hpylori_ab'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>H Pylori Stool Ag</th>
                                    <td>$hpylori_ag</td>  
                                </thead>
                                <thead>
                                    <th class='head'>H Pylori Ab</th>
                                    <td>$hpylori_ab</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                            </div>
                            <div class='lab'>
                                <?php
                                if ($rs10->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Liver Enzymatic Test Result</h2>
                                ";
                                    while ($row = $rs10->fetch_assoc()) {
                                        $sgot = $row['sgot'];
                                        $sgpt = $row['sgpt'];
                                        $alk_phos = $row['alk_phos'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>SGOT</th>
                                    <td>$sgot</td>  
                                </thead>
                                <thead>
                                    <th class='head'>SGPT</th>
                                    <td>$sgpt</td>  
                                </thead>
                                <thead>
                                    <th class='head'>ALK_Phosphatase</th>
                                    <td>$alk_phos</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                                <?php
                                if ($rs12->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Liver Function Test Result</h2>
                                ";
                                    while ($row = $rs12->fetch_assoc()) {
                                        $bt = $row['bt'];
                                        $bd = $row['bd'];
                                        $albumin = $row['albumin'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Bilirubin_T</th>
                                    <td>$bt</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Bilirubin_D</th>
                                    <td>$bd</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Albumin</th>
                                    <td>$albumin</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                                <?php
                                if ($rs11->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Serum Electrolyte Result</h2>
                                ";
                                    while ($row = $rs11->fetch_assoc()) {
                                        $Sodium = $row['Sodium'];
                                        $Potassium = $row['Potassium'];
                                        $Calsium = $row['Calsium'];
                                        $Other = $row['Others'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Sodium</th>
                                    <td>$Sodium</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Potassium</th>
                                    <td>$Potassium</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Calcium</th>
                                    <td>$Calsium</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Other</th>
                                    <td>$Other</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                            </div>
                            <div class='lab'>
                                <?php
                                if ($rs13->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Liver Viral Test Result</h2>
                                ";
                                    while ($row = $rs13->fetch_assoc()) {
                                        $hbs = $row['hbs'];
                                        $hcv = $row['hcv'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>HBS</th>
                                    <td>$hbs</td>  
                                </thead>
                                <thead>
                                    <th class='head'>HCV</th>
                                    <td>$hcv</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                                <?php
                                if ($rs16->num_rows > 0) {
                                    echo "
                                <h2 class='center'>ESR Result</h2>
                                ";
                                    while ($row = $rs16->fetch_assoc()) {
                                        $esr = $row['ESR'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>ESR</th>
                                    <td>$esr</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                                <?php
                                if ($rs14->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Stool Result</h2>
                                ";
                                    while ($row = $rs14->fetch_assoc()) {
                                        $Appearance = $row['Appearance'];
                                        $Consistency = $row['Consistency'];
                                        $o_p = $row['o/p'];
                                        $pus = $row['pus'];
                                        $mucus = $row['mucus'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Appearance</th>
                                    <td>$Appearance</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Consistency</th>
                                    <td>$Consistency</td>  
                                </thead>
                                <thead>
                                    <th class='head'>O/P</th>
                                    <td>$o_p</td>  
                                </thead>
                                <thead>
                                    <th class='head'>PUS</th>
                                    <td>$pus</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Mucus</th>
                                    <td>$mucus</td>  
                                </thead>
                                    
                                    </table>";
                                }
                                ?>
                                <?php
                                if ($rs17->num_rows > 0) {
                                    echo "
                                <h2 class='center'>PICT Result</h2>
                                ";
                                    while ($row = $rs17->fetch_assoc()) {
                                        $pict = $row['pict'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>PICT</th>
                                    <td>$pict</td>  
                                </thead>
                                
                                    
                                    </table>";
                                }
                                ?>
                                <?php
                                if ($rs19->num_rows > 0) {
                                    echo "
                                <h2 class='center'>RPR Result</h2>
                                ";
                                    while ($row = $rs19->fetch_assoc()) {
                                        $rpr = $row['rpr'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>RPR</th>
                                    <td>$rpr</td>  
                                </thead>
                                
                                    
                                    </table>";
                                }
                                ?>
                               
                            </div>
                            <div class='lab'>
                                <?php
                                if ($rs15->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Urinalysis Result</h2>
                                ";
                                    while ($row = $rs15->fetch_assoc()) {
                                        $color = $row['color'];
                                        $appearance = $row['apprearance'];
                                        $ph = $row['ph'];
                                        $s_g = $row['s_g'];
                                        $protein = $row['protein'];
                                        $glucose = $row['glucose'];
                                        $ketone = $row['ketone'];
                                        $bilirubin = $row['bilirubin'];
                                        $urobilinogen = $row['urobilinogen'];
                                        $blood = $row['blood'];
                                        $l_e = $row['l_e'];
                                        $nitrite = $row['nitrite'];

                                        $epithe = $row['epithe'];
                                        $wbc = $row['wbc'];
                                        $rbc = $row['rbc'];
                                        $casts = $row['casts'];
                                        $bacteria = $row['bacteria'];
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Color</th>
                                    <td>$color</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Appearance</th>
                                    <td>$appearance</td>  
                                </thead>
                                <thead>
                                    <th class='head'>PH</th>
                                    <td>$ph</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Specific Gravity</th>
                                    <td>$s_g</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Protein</th>
                                    <td>$protein</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Glucose</th>
                                    <td>$glucose</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Ketone</th>
                                    <td>$ketone</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Bilirubin</th>
                                    <td>$bilirubin</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Urobilinogen</th>
                                    <td>$urobilinogen</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Blood</th>
                                    <td>$blood</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Leukocyte Esterase</th>
                                    <td>$l_e</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Nitrite</th>
                                    <td>$nitrite</td>  
                                </thead>
                                    </table>
                                    <h2 class='center'>Microscopy</h2>
                                    <table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Epithelial Cells</th>
                                    <td>$epithe</td>  
                                </thead>
                                <thead>
                                    <th class='head'>WBC/HPF</th>
                                    <td>$wbc</td>  
                                </thead>
                                <thead>
                                    <th class='head'>RBC/HPF</th>
                                    <td>$rbc</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Casts</th>
                                    <td>$casts</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Bacteria</th>
                                    <td>$bacteria</td>  
                                </thead>
                                </table>
                                    ";
                                }
                                ?>
                               
                               
                            </div>
                            <div class='lab'>
                                <?php
                                if ($rs18->num_rows > 0) {
                                    echo "
                                <h2 class='center'>RFT Result</h2>
                                ";
                                    while ($row = $rs18->fetch_assoc()) {
                                        $bun = $row['bun'];
                                        $creatinine = $row['creatinine'];
                                        
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>BUN</th>
                                    <td>$bun</td>  
                                </thead>
                                <thead>
                                    <th class='head'>Creatinine</th>
                                    <td>$creatinine</td>  
                                </thead>
                                
                                </table>
                                    ";
                                }
                                ?>
                                <?php
                                if ($rs20->num_rows > 0) {
                                    echo "
                                <h2 class='center'>TFT Result</h2>
                                ";
                                    while ($row = $rs20->fetch_assoc()) {
                                        $t3 = $row['t3'];
                                        $t4 = $row['t4'];
                                        $tsh = $row['tsh'];
                                        
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>T3</th>
                                    <td>$t3</td>  
                                </thead>
                                <thead>
                                    <th class='head'>T4</th>
                                    <td>$t4</td>  
                                </thead>
                                <thead>
                                    <th class='head'>TSH</th>
                                    <td>$tsh</td>  
                                </thead>
                                
                                </table>
                                    ";
                                }
                                ?>
                               
                                <?php
                                if ($rs21->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Uric Acid Result</h2>
                                ";
                                    while ($row = $rs21->fetch_assoc()) {
                                        $uric = $row['uric'];
                                        
                                        
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Uric Acid</th>
                                    <td>$uric</td>  
                                </thead>
                                </table>
                                    ";
                                }
                                ?>
                                
                            </div>
                            <div class='lab'>
                            <?php
                                if ($rs22->num_rows > 0) {
                                    echo "
                                <h2 class='center'>VDRL Result</h2>
                                ";
                                    while ($row = $rs22->fetch_assoc()) {
                                        $vdrl = $row['vdrl'];
                                        
                                        
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>VDRL</th>
                                    <td>$vdrl</td>  
                                </thead>
                                </table>
                                    ";
                                }
                                ?>
                                <?php
                                if ($rs23->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Weil Felix Result</h2>
                                ";
                                    while ($row = $rs23->fetch_assoc()) {
                                        $weil = $row['weil'];
                                        
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Weil Felix</th>
                                    <td>$weil</td>  
                                </thead>
                                
                                </table>
                                    ";
                                }
                                ?>
                                <?php
                                if ($rs24->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Widal_H Result</h2>
                                ";
                                    while ($row = $rs24->fetch_assoc()) {
                                        $widalh = $row['widalh'];
                                        
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Widal H</th>
                                    <td>$widalh</td>  
                                </thead>
                                
                                </table>
                                    ";
                                }
                                ?>
                               
                                <?php
                                if ($rs25->num_rows > 0) {
                                    echo "
                                <h2 class='center'>Widal_O Result</h2>
                                ";
                                    while ($row = $rs25->fetch_assoc()) {
                                        $widalo = $row['widalo'];
                                        
                                        
                                    }
                                    echo "<table class='table'>
                                    <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    </thead>
                                <thead>
                                    <th class='head'>Widal O</th>
                                    <td>$widalo</td>  
                                </thead>
                                </table>
                                    ";
                                }
                                ?>
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