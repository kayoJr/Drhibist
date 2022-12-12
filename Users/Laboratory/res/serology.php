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
                        <h2>SEROLOGY RESULT</h2>
                        <?php
                        $id = $_GET['id'];
                        ?>
                        </div>
                           
                             <div class="lab-res">
                                <form action="../../../backend/lab_res.php" method="POST">
                                    <div class="form">
                                        
                                        <div class="column">
                                            <div>
                                                <label for="PICT">PICT</label>
                                                <input type="text" name="PICT" id="PICT" step=".01">
                                                <input type="hidden" name="PICT-name" value="PICT">
                                            </div>
                                            <div>
                                                <label for="VDRL">VDRL</label>
                                                <input type="text" name="VDRL" id="VDRL" step=".01">
                                                <input type="hidden" name="VDRL-name" value="VDRL">
                                            </div>
                                            <div>
                                                <label for="RPR">RPR</label>
                                                <input type="text" name="RPR" id="RPR" step=".01">
                                                <input type="hidden" name="RPR-name">
                                            </div>
                                            <div>
                                                <label for="Widal_Hi">Widal Hi</label>
                                                <input type="text" name="Widal_Hi" id="Widal_Hi" step=".01">
                                                <input type="hidden" name="Widal_Hi-name" value="Widal_Hi">
                                            </div>
                                            <div>
                                                <label for="Oi">Oi</label>
                                                <input type="text" name="Oi" id="Oi" step=".01">
                                                <input type="hidden" name="Oi-name" value="Oi">
                                            </div>
                                            
                                        </div>
                                        <div class="column">
                                            
                                            <div>
                                                <label for="Weil_felix">Weil felix</label>
                                                <input type="text" name="Weil_felix" id="Weil_felix" step=".01">
                                                <input type="hidden" name="Weil_felix-name" value="Weil_felix">
                                            </div>
                                            <div>
                                            <label for="HRS_Ag">HRS Ag</label>
                                                <input type="text" name="HRS_Ag" id="HRS_Ag" step=".01">
                                                <input type="hidden" name="HRS_Ag-name" value="HRS_Ag">
                                            </div>
                                            <div>
                                            <label for="HCV_Ab">HCV Ab</label>
                                                <input type="text" name="HCV_Ab" id="HCV_Ab" step=".01">
                                                <input type="hidden" name="HCV_Ab-name" value="HCV_Ab">
                                            </div>
                                            <div>
                                            <label for="Hpylori_Ab">H.pylori Ab</label>
                                                <input type="text" name="Hpylori_Ab" id="Hpylori_Ab" step=".01">
                                                <input type="hidden" name="Hpylori_Ab-name" value="Hpylori_Ab">
                                            </div>
                                            <div>
                                            <label for="H_pylori_stool_Ag">H.pylori stool Ag</label>
                                                <input type="text" name="H_pylori_stool_Ag" id="H_pylori_stool_Ag" step=".01">
                                                <input type="hidden" name="H_pylori_stool_Ag-name" value="H_pylori_stool_Ag">
                                            </div>
                                        </div>
                                        <input type="hidden" name="pat_id" value="<?php echo $id; ?>">
                                        
                                        <input type="submit" name="submitsg" value="SEND" class="btn bnt-primary">
                                        
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
<script>
    $(document).ready(function() {
        $("#authors").change(function() {
            var aid = $("#authors").val();
            $.ajax({
                url: 'data.php',
                method: 'post',
                data: 'aid=' + aid
            }).done(function(books) {
                books = JSON.parse(books);
                $('#books').empty();
                books.forEach(function(book) {
                    //$('#books').append('<option>Hello</option>')
                    $('#books').val(book.price)
                })
            })
        })
    })
    const feedback = document.getElementById("feedback");
    setTimeout(() => {
        feedback.style.display = "none";
    }, 3000)
</script>