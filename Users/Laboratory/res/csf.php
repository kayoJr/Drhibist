<?php
require_once '../../../backend/db.php';
require '../../../backend/auth.php';
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
    <title>Laboratory</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../../../img/favicon.ico" type="image/png" />
    <link rel="stylesheet" href="../../styles/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../../styles/style.css" />
    <link rel="stylesheet" href="../../styles/responsive.css" />
    <link rel="stylesheet" href="../../styles/bootstrap-select.css" />
    <link rel="stylesheet" href="../../styles/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../styles/custom.css" />

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
                            <a href="../index.html"><img class="logo_icon img-responsive" src="../../../img/logo.png" alt="#" /></a>
                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="user_img">
                                <img class="img-responsive" src="../../../img/logo.png" alt="#" />
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
                    include 'side_nav.php';
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
                        <div class="navigation">
                            <button class="button" onclick="history.go(-1);"><i class="fa-solid fa-chevron-left fa-2x"></i></button>
                        </div>
                        <div class="titel">
                        <h2 class="center">CSF RESULT</h2>
                        </div>
                        <?php
                        $id = $_GET['id'];
                        ?>
                           
                             <div class="lab-res">
                                <form action="../../../backend/lab_res.php" method="POST">
                                    <div class="form">
                                        
                                        <div class="column">
                                            <div>
                                                <label for="app">Appearance</label>
                                                <input type="text" name="app" id="app" step=".01">
                                            </div>
                                            <div>
                                                <label for="grav">Specific Gravity</label>
                                                <input type="text" name="grav" id="grav" step=".01">
                                            </div>
                                            <div>
                                                <label for="ldh">LDH</label>
                                                <input type="text" name="ldh" id="ldh" step=".01">
                                            </div>
                                            <div>
                                                <label for="glucose">Glucose</label>
                                                <input type="text" name="glucose" id="glucose" step=".01">
                                            </div>
                                            <div>
                                                <label for="protein">Protien</label>
                                                <input type="text" name="protein" id="protein" step=".01">
                                            </div>
                                            <div>
                                                <label for="cells">Cells</label>
                                                <input type="text" name="cells" id="cells" step=".01">
                                            </div>
                                            <div>
                                                <label for="ep_cells">Epithelial Cells</label>
                                                <input type="text" name="ep_cells" id="ep_cells" step=".01">
                                            </div>
                                            <div>
                                                <label for="wbc">WBC & Differ</label>
                                                <input type="text" name="wbc" id="wbc" step=".01">
                                            </div>
                                           
                                        </div>
                                        <div class="column">
                                            <div>
                                                <label for="koh">KOH</label>
                                                <input type="text" name="koh" id="koh" step=".01">
                                            </div>
                                            <div>
                                                <label for="wet">WET mount</label>
                                                <input type="text" name="wet" id="wet" step=".01">
                                            </div>
                                            <div>
                                                <label for="gram">Gram Stain</label>
                                                <input type="text" name="gram" id="gram" step=".01">
                                            </div>
                                            <div>
                                                <label for="afb">AFB Stain</label>
                                                <input type="text" name="afb" id="afb" step=".01">
                                            </div>
                                            <div>
                                                <label for="indian">Indian INK</label>
                                                <input type="text" name="indian" id="indian" step=".01">
                                            </div>
                                            <div>
                                                <label for="vdrl">VDRL</label>
                                                <input type="text" name="vdrl" id="vdrl" step=".01">
                                            </div>
                                            <div>
                                                <label for="rbc">RBC</label>
                                                <input type="text" name="rbc" id="rbc" step=".01">
                                            </div>
                                            <div>
                                                <label for="me">hello</label>
                                            <input type="submit" name="submitcsf" value="SEND" class="btn mgt btn-primary">
                                            </div>
                                           
                                        </div>
                                        
                                        <input type="hidden" name="pat_id" value="<?php echo $id; ?>">
                                    </div>
                                </form>
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
