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
                        <div class="info" id="feedback">
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
                        <div class="return">
                            <form method="post" id="insert_form" action="../../backend/add_pres_mgt.php">
                                <h4 class="bg-primary p-2">Routes</h4>
                                <div>
                                    <input type="text" name="name" id="name" class="form-control my-0">
                                    <input type="submit" name="submitRoute" id="submit_button" class="btn btn-primary my-3" value="Add New" />
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="item_table">
                                        <tr class="mob_table">
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody>
                                            <?php
                                            $sql = $conn->query("SELECT * FROM `medroute` ORDER BY `name` ASC");
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                            ?>
                                                <tr>
                                                    <td data-label="Name" id="select-div">
                                                        <?php echo $row['name']; ?>
                                                    </td>
                                                    <td data-label="Type" id="select-div">
                                                        <a href="../../backend/remove_route.php?id=<?php echo $row['id']; ?>">X</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                            </form>
                        </div>
                        <div class="return mt-4">
                            <form method="post" id="insert_form" action="../../backend/add_pres_mgt.php">
                                <h4 class="bg-secondary p-2">Frequency</h4>
                                <div align="center">
                                    <input type="text" name="name" id="name" class="form-control my-0">
                                    <input type="submit" name="submitFreq" id="submit_button" class="btn btn-primary my-3" value="Add New" />
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="item_table">
                                        <tr class="mob_table">
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody>
                                            <?php
                                            $sql = $conn->query("SELECT * FROM `dosage` ORDER BY `name` ASC");
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                            ?>
                                                <tr>
                                                    <td data-label="Name" id="select-div">
                                                        <?php echo $row['name']; ?>
                                                    </td>
                                                    <td data-label="Type" id="select-div">
                                                        <a href="../../backend/remove_dosage.php?id=<?php echo $row['id']; ?>">X</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>

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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
</body>

</html>
<script>
    $(document).ready(function() {
        $("#authors").change(function() {
            var aid = $("#authors").val();
            console.log(aid);
            $.ajax({
                url: 'data.php',
                method: 'post',
                data: 'aid=' + aid,
            }).done(function(books) {
                books = JSON.parse(books);
                $('#books').empty();
                books.forEach(function(book) {
                    //$('#books').append('<option>Hello</option>')
                    $('#books').val(book.type)
                })
            })
        })
        $("#system").change(function() {
            var sys = $("#system").val();
            $.ajax({
                url: 'data_sys.php',
                method: 'post',
                data: 'sys=' + sys,
            }).done(function(books) {
                books = JSON.parse(books);
                $('#type_med').empty();
                books.forEach(function(book) {
                    //$('#books').append('<option>Hello</option>')
                    $('#type_med').val(book.type)
                })
            })
        })
    })

    const feedback = document.getElementById("feedback");
    setTimeout(() => {
        feedback.style.display = "none";
    }, 3000)
</script>