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
    <title>Laboratory</title>
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
                            echo "<p>$msg</p>"
                            ?>
                        </div>
                        <form action="index.php" class="search">
                            <h3>Search For Patient</h3>
                            <div class="search-form">
                                <input type="number" name="search" id="search" min="0" required placeholder="Phone or Card Number" />
                                <input type="submit" name="searching" value="Search" class="btn btn-primary" />
                            </div>
                        </form>
                        <?php
                        if (isset($_GET['searching'])) {
                            $phone = $_GET['search'];
                            $search_sql = "SELECT * FROM `patient` WHERE `phone`='$phone' OR `id` = '$phone'";
                            $rs = $conn->query($search_sql);
                            echo "
									<table class='table'>
									<thead>
										<th>SNo</th>
										<th>Name</th>
										<th>Age</th>
										<th>Sex</th>
										<th>Card No</th>
										<th>Phone</th>
									</thead>
									";
                            if ($rs) {
                                while ($result = $rs->fetch_assoc()) {
                                    $card = $result['id'];
                                    $pt_name = $result['name'];
                                    $pt_phone = $result['phone'];
                                    $age = $result['age'];
                                    $sex = $result['sex'];
                                    echo "	
												<tbody>
													<tr>
														<td data-label='SNo'>$card</td>
														<td data-label='Name'>$pt_name</td>
														<td data-label='Age'>$age</td>
														<td data-label='Sex'>$sex</td>
														<td data-label='Card No'>$card</td>
														<td data-label='Phone'>$pt_phone</td>						
													</tr>
												</tbody>
												";
                                }
                            }
                        ?>
                            </table>
                            <div class="lab-req">
                                <h4>Lab Requests</h4>
                                <div class="lab-name">
                                    <?php
                                    $pat_id = @$card;
                                    $sql = "SELECT * FROM `lab_cart` WHERE `patient_id` = '$pat_id' AND `payment` = 1";
                                    $res = $conn->query($sql);
                                    if ($res) {
                                        while ($row = $res->fetch_assoc()) {
                                            $name = $row['name'];
                                    ?>
                                            <?php echo "<p>$name</p>"; ?>
                                    <?php
                                        }
                                    } else {
                                        echo 'false';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="lab-res">
                                <form action="../../backend/lab_res.php" method="POST">
                                    <div class="form">
                                        <div class="column">
                                            <div>
                                                <label for="wbc">WBC</label>
                                                <input type="number" name="wbc" id="wbc" step=".01">
                                                <input type="hidden" name="wbc-name" value="WBC">
                                            </div>
                                            <div>
                                                <label for="lymph#">Lymph#</label>
                                                <input type="number" name="lymph#" id="lymph#" step=".01">
                                                <input type="hidden" name="lymph#-name" value="lymph#">
                                            </div>
                                            <div>
                                                <label for="mid#">Mid#</label>
                                                <input type="number" name="mid#" id="mid#" step=".01">
                                                <input type="hidden" name="mid#-name">
                                            </div>
                                            <div>
                                                <label for="gran#">Gran#</label>
                                                <input type="number" name="gran#" id="gran#" step=".01">
                                                <input type="hidden" name="gran#-name" value="Gran#">
                                            </div>
                                            <div>
                                                <label for="lymph%">Lymph%</label>
                                                <input type="number" name="lymph%" id="lymph%" step=".01">
                                                <input type="hidden" name="lymph%-name" value="Lymph%">
                                            </div>
                                            <div>
                                                <label for="mid%">Mid%</label>
                                                <input type="number" name="mid%" id="mid%" step=".01">
                                                <input type="hidden" name="mid%-name" value="Mid%">
                                            </div>
                                            <div>
                                            <label for="gran%">Gran%</label>
                                                <input type="number" name="gran%" id="gran%" step=".01">
                                                <input type="hidden" name="gran%-name" value="Gran%">
                                            </div>
                                            <div>
                                            <label for="hgb">HGB</label>
                                                <input type="number" name="hgb" id="hgb" step=".01">
                                                <input type="hidden" name="hgb-name" value="HGB">
                                            </div>
                                            <div>
                                            <label for="rbc">RBC</label>
                                                <input type="number" name="rbc" id="rbc" step=".01">
                                                <input type="hidden" name="rbc-name" value="RBC">
                                            </div>
                                            <div>
                                            <label for="xxx">XXX</label>
                                                <input type="number" name="xxx" id="xxx" step=".01">
                                                <input type="hidden" name="XXX-name" value="XXX">
                                            </div>
                                        </div>
                                        <div class="column">
                                            <div>
                                            <label for="mcv">MCV</label>
                                                <input type="number" name="mcv" id="mcv" step=".01">
                                                <input type="hidden" name="mcv-name" value="MCV">
                                            </div>
                                            <div>
                                            <label for="mch">MCH</label>
                                                <input type="number" name="mch" id="mch" step=".01">
                                                <input type="hidden" name="mch-name" value="MCH">
                                            </div>
                                            <div>
                                            <label for="mchc">MCHC</label>
                                                <input type="number" name="mchc" id="mchc" step=".01">
                                                <input type="hidden" name="mchc-name" value="MCHC">
                                            </div>
                                            <div>
                                            <label for="rdw-cv">RDW-CV</label>
                                                <input type="number" name="rdw-cv" id="rdw-cv" step=".01">
                                                <input type="hidden" name="rdw-cv-name" value="RDW-CV">
                                            </div>
                                            <div>
                                            <label for="rdw-sd">RDW-SD</label>
                                                <input type="number" name="rdw-sd" id="rdw-sd" step=".01">
                                                <input type="hidden" name="rdw-sd-name" value="RDW-SD">
                                            </div>
                                            <div>
                                            <label for="plt">PLT</label>
                                                <input type="number" name="plt" id="plt" step=".01">
                                                <input type="hidden" name="plt-name" value="PLT">
                                            </div>
                                            <div>
                                            <label for="mpv">MPV</label>
                                                <input type="number" name="mpv" id="mpv" step=".01">
                                                <input type="hidden" name="mpv-name" value="MPV">
                                            </div>
                                            <div>
                                            <label for="pdw">PDW</label>
                                                <input type="number" name="pdw" id="pdw" step=".01">
                                                <input type="hidden" name="pdw-name" value="PDW">
                                            </div>
                                            <div>
                                            <label for="pct">PCT</label>
                                                <input type="number" name="pct" id="pct" step=".01">
                                                <input type="hidden" name="pct-name" value="PCT">
                                            </div>
                                        </div>
                                        <input type="submit" name="submit" value="SEND" class="btn bnt-primary">
                                        <input type="hidden" name="pat_id" value="<?php echo $pat_id; ?>">
                                    </div>
                                </form>
                            </div>
                        <?php
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