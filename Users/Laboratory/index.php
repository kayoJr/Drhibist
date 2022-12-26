<?php
require_once '../../backend/db.php';
require '../../backend/auth.php';
$today = date('Y-m-d');
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
                                $pat_id = $card;
                                $sql = "SELECT * FROM `lab_cart2` WHERE `patient_id` = '$pat_id' AND `payment` = 1";
                                $res = $conn->query($sql);
                                if ($res) {
                                    while ($row = $res->fetch_assoc()) {
                                        $name = $row['name'];
                                        // echo $card;
                                        if ($name == 'CBC') {
                                            echo "<a class='btn btn-primary' href='res/cbc.php?id=$pat_id'>$name</a>";
                                        } elseif ($name == 'Blood_Group') {

                                            echo " <a class='btn btn-primary' href='res/blood_group.php?id=$pat_id'> $name</a>";
                                        } elseif ($name == 'ESR') {

                                            echo "<a class='btn btn-primary' href='res/esr.php?id=$pat_id'>$name</a>";
                                        } elseif ($name == 'STOOL') {

                                            echo " <a class='btn btn-primary' href='res/stool.php?id=$pat_id'> $name</a>";
                                        } elseif ($name == 'Urinalysis') {
                                            echo "<a class='btn btn-primary' href='res/urinalysis.php?id=$pat_id'>$name</a>";
                                        } elseif ($name == 'FBS_RBS') {

                                            echo "<a class='btn btn-primary' href='res/fbs_rbs.php?id=$pat_id'> $name</a>";
                                        } elseif ($name == 'Uric_Acid') {

                                            echo "<a class='btn btn-primary' href='res/uric_acid.php?id=$pat_id'> $name</a>";
                                        } elseif ($name == 'LET') {

                                            echo "<a class='btn btn-primary' href='res/let.php?id=$pat_id'>$name</a>";
                                        } elseif ($name == 'LFT') {

                                            echo "<a class='btn btn-primary' href='res/lft.php?id=$pat_id'>$name</a>";
                                        } elseif ($name == 'RFT') {
                                            echo " <a class='btn btn-primary' href='res/rft.php?id=$pat_id'>$name</a>";
                                        } elseif ($name == 'Serum') {
                                            echo " <a class='btn btn-primary' href='res/serum.php?id=$pat_id'>$name</a>";
                                        } elseif ($name == 'CRP') {

                                            echo " <a class='btn btn-primary' href='res/crp.php?id=$pat_id'>$name</a>";
                                        } elseif ($name == 'TFT') {
                                            echo " <a class='btn btn-primary' href='res/tft.php?id=$pat_id'>$name</a>";
                                        } elseif ($name == 'Coagulation_Profile') {
                                            echo " <a class='btn btn-primary' href='res/coagulation.php?id=$pat_id'>$name</a>";
                                        } elseif ($name == 'Gram_Stain') {
                                            echo " <a class='btn btn-primary' href='res/gram_stain.php?id=$pat_id'>$name</a>";
                                        } elseif ($name == 'AFB_Sputum') {
                                            echo " <a class='btn btn-primary' href='res/afb_sputum.php?id=$pat_id'>$name</a>";
                                        } elseif ($name == 'PICT') {


                                            echo "<a class='btn btn-primary' href='res/pict.php?id=$card&nm=$name'> $name</a>";
                                        } elseif ($name == 'VDRL') {
                                            echo "<a class='btn btn-primary' href='res/vdrl.php?id=$card&nm=$name'> $name</a>";
                                        } elseif ($name == 'RPR') {
                                            echo "<a class='btn btn-primary' href='res/rpr.php?id=$card&nm=$name'> $name</a>";
                                        } elseif ($name == 'Widal_H') {
                                            echo "<a class='btn btn-primary' href='res/widal_h.php?id=$card&nm=$name'> $name</a>";
                                        } elseif ($name == 'Widal_O') {

                                            echo "<a class='btn btn-primary' href='res/widal_o.php?id=$card&nm=$name'> $name</a>";
                                        } elseif ($name == 'Weil_Felix') {
                                            echo "<a class='btn btn-primary' href='res/weil_felix.php?id=$card&nm=$name'> $name</a>";
                                        } elseif ($name == 'liver_viral') {

                                            echo "<a class='btn btn-primary' href='res/liver_viral.php?id=$card&nm=$name'> $name</a>";
                                        } elseif ($name == 'h_pylori') {

                                            echo "<a class='btn btn-primary' href='res/h_pylori.php?id=$card&nm=$name'> $name</a>";
                                        } elseif ($name == 'blood_f') {

                                            echo "<a class='btn btn-primary' href='res/blood_film.php?id=$card&nm=$name'> $name</a>";
                                        }elseif ($name == 'csf_Felix') {

                                            echo "<a class='btn btn-primary' href='res/csf.php?id=$card&nm=$name'> $name</a>";
                                        }
                                    }


                                }
                            }
                            
                            ?>
                                </div>
                            </div>
                            <?php
                            $search_sql = "SELECT * FROM `lab_message` WHERE `patient_id`='$pat_id' ORDER BY `date` DESC";
                            $rs = $conn->query($search_sql);
                        
                            if($rs){
                                while($row = $rs->fetch_assoc()){
                                    $msg_id = $row['id'];
                                    $detail = $row['detail'];
                                    $date = $row['date'];
                                    echo "
                                    <div class='detail addm_detail'>
                                    <h2>Message From Doctor</h2>
                                    <div class='edit_ultraresu'>
                                    <p>-> $detail </p>
                                    <p>$date </p>
                                    <a href='../../backend/delete_lab_msg.php?id=$msg_id&pat=$pat_id'>X</a>
                                    </div>
                                    </div>
                                    ";
                                    
                                    
                        
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
    <script src="../js/lab.js"></script>

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