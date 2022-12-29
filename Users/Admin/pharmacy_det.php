<?php
require '../../backend/auth.php';
require '../../backend/db.php';
$sql = $conn->query("DELETE FROM `pharma_daily_sell` WHERE `quan` = 0");
$sql2 = $conn->query("DELETE FROM `system_payment` WHERE `price` = 0");

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
                        <div class="navigation">
                            <button class="button" onclick="history.go(-1);"><i class="fa-solid fa-chevron-left fa-2x"></i></button>
                            <button class="btn mgb" id="btnPrint">Print</button>
                        </div>
                    
                        <?php
                        $name = $_GET['name'];
                        if ($name == 'stc') {
                            $title = "Save The Children";
                        } else if ($name == 'cigna') {
                            $title = "Cigna";
                        }
                        ?>
                        <h2 class="center"><?php echo $title; ?></h2>
                        <form action="pharmacy_det.php" class="mgb" method="GET">
                            <div class="form-elements">
                                <input type="number" name="id" id="id" min="0">
                                <input type="hidden" name="name" id="name" value="<?php echo $name; ?>">
                                <input type="submit" value="Search" name="search" class="btn mgt btn-primary">
                            </div>
                        </form>
                        <div class="credit_detail">
                        <?php
                        if (isset($_GET['search'])) {
                            $pat_id = $_GET['id'];
                            $sql = $conn->query("SELECT * FROM `credit_pharm` WHERE `patient_id` = '$pat_id' AND `status` = 0");
                            echo "
                            <table class='table'>
                            <thead>
                                <th>Patient Name</th>
                                <th>Medicine Name</th>
                                <th>Amount</th>
                                <th>Price</th>
                            </thead>
                            ";
                            if ($sql) {
                                while ($row = $sql->fetch_assoc()) {
                                    $pat_id = $row['patient_id'];
                                    $select = $conn->query("SELECT * FROM `patient` WHERE `id` = $pat_id");
                                    $rows = $select->fetch_assoc();
                                    $pat_name = $rows['name'];
                                    $med_name = $row['name'];
                                    $amount = $row['quan'];
                                    $price = $row['sub_price'];
                                    echo "	
                                        <tbody>
                                            <tr>
                                                <td data-label='Name'>$pat_name</td>
                                                <td data-label='Type'>$med_name</td>
                                                <td data-label='amount'>$amount</td>
                                                <td data-label='Cost'>$price</td>
                                            </tr>
                                        </tbody>
                                        ";
                                    $total_ind = $conn->query("SELECT SUM(price) as price_ind FROM `credit_pharm` WHERE `patient_id` = '$pat_id' AND `status` = 0");
                                    $row_tot = $total_ind->fetch_assoc();
                                    $total = $row_tot['price_ind'];
                                }
                        ?>
                                <h2 class="center">Total: <?php echo $total; ?></h2>
                        <?php
                            }
                        } else {
                            $sql = $conn->query("SELECT * FROM `credit_pharm` WHERE `org` = '$name' AND `status` = 0");
                            echo "
                                        <table class='table'>
                                        <thead>
                                            <th>Patient Name</th>
                                            <th>Medicine Name</th>
                                            <th>Amount</th>
                                            <th>Price</th>
                                        </thead>
                                        ";
                            if ($sql) {
                                while ($row = $sql->fetch_assoc()) {
                                    $pat_id = $row['patient_id'];
                                    $select = $conn->query("SELECT * FROM `patient` WHERE `id` = $pat_id");
                                    $rows = $select->fetch_assoc();
                                    $pat_name = $rows['name'];
                                    $med_name = $row['name'];
                                    $amount = $row['quan'];
                                    $price = $row['sub_price'];
                                    echo "	
                                                    <tbody>
                                                        <tr>
                                                            <td data-label='Name'>$pat_name</td>
                                                            <td data-label='Type'>$med_name</td>
                                                            <td data-label='amount'>$amount</td>
                                                            <td data-label='Cost'>$price</td>
                                                        </tr>
                                                    </tbody>
                                                    ";
                                }
                            }
                        }
                        ?>
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