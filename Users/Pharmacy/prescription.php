<?php
require '../../backend/db.php';
require '../../backend/auth.php';
// $pat_id = $_GET['id'];
// function clear_cart(){
// 	require '../../backend/db.php';
// 	$sql = "TRUNCATE TABLE `cart`";
// 	$res = $conn->query($sql);
// 	if($res){
// 		header("Location:index.php");
// 	}else{
// 		echo mysqli_error($conn);
// 	}
// }
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
    <title>Prescription</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../../img/favicon.ico" type="image/png" />
    <link rel="stylesheet" href="../styles/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
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
                                $phone_user = $_SESSION['user'];
                                $sql = "SELECT * FROM `users` WHERE `phone` = '$phone_user'";
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
                        <div id="feedback">
                            <?php
                            @$msg = $_REQUEST['msg'];
                            echo "<p>$msg</p>"
                            ?>
                        </div>
                        <!--<a href="./pharmaTest.php" class="btn btn-danger">TEST SERVER</a>-->

                        <form action="prescription.php" class="search">
                            <h3>Search Patient</h3>
                            <div class="search-form">
                                <input type="number" name="search" id="search" min="0" required placeholder="Phone or Card Number" />
                                <input type="submit" name="searching" value="Search" class="btn btn-primary" />
                            </div>
                        </form>
                        <?php
                        if (isset($_GET['searching'])) {
                            $searchId = $_GET['search'];
                        ?>
                            <select class="px-4 py-2 fs-5" name="selectDate" id="selectDate" onchange="fetchResult()">

                            </select>
                            <div class="modal-body table-responsive">
                                <table class="table table-bordered">
                                    <tr class="mob_table">
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Dosage</th>
                                        <th>Route</th>
                                        <th>Frequency</th>
                                        <th>Duration</th>
                                        <th>Amount</th>
                                        <th>Note</th>
                                        <th>Date</th>
                                    </tr>
                                    <tbody>

                                        <?php

                                        $sql = "SELECT * FROM `prescription` WHERE `pat_id` = '$searchId' AND `date` BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND CURDATE() ORDER BY `date` DESC ";
                                        $rs = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($rs)) {
                                            $presId = $row['id'];
                                        ?>
                                            <input type="hidden" name="pat_id" id="pat_id" value="<?php echo $searchId; ?>">
                                            <tr>
                                                <td><?php
                                                    echo $row['med_name'];
                                                    ?></td>
                                                <td><?php
                                                    echo $row['med_type'];
                                                    ?></td>
                                                <td><?php
                                                    echo $row['dosage'];
                                                    ?></td>
                                                <td><?php
                                                    echo $row['route'];
                                                    ?></td>
                                                <td><?php
                                                    echo $row['dose_per_day'];
                                                    ?></td>
                                                <td><?php
                                                    echo $row['duration'];
                                                    ?></td>
                                                <td><?php
                                                    echo $row['amount'];
                                                    ?></td>
                                                <td><?php
                                                    echo $row['note'];
                                                    ?></td>
                                                <td><?php
                                                    echo $row['date'];
                                                    ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" disabled id="btnPrint" data-dismiss="modal">PRINT</button>
                            </div>
                        <?php
                        }

                        ?>
                    </div>

                </div>
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
    document.addEventListener('DOMContentLoaded', () => {
        fetchYears();
    })
    const url = "<?php echo $url; ?>"
    $(document).ready(function() {
        $("#authors").change(function() {
            var aid = $("#authors").val();
            $.ajax({
                url: 'pharmData.php',
                method: 'post',
                data: 'aid=' + aid
            }).done(function(books) {
                console.log(aid);
                console.log(books);
                books = JSON.parse(books);
                $('#books').empty();
                books.forEach(function(book) {
                    //$('#books').append('<option>Hello</option>')
                    $('#books').val(book.type),
                        $('#med_id').val(book.id)
                })
            })
        })
    })

    document.getElementById("btnPrint").onclick = function() {
        window.print();
    }
    const feedback = document.getElementById("feedback");
    setTimeout(() => {
        feedback.style.display = "none";
    }, 3000)

    const payment = document.getElementById('payment');
    const credit = document.getElementById('credit');

    payment.addEventListener('change', (e) => {
        if (e.target.value == 'Credit') {
            credit.classList.remove('d-none')
        } else {
            credit.classList.add('d-none')
        }
    })

    function fetchYears() {
        const id = document.getElementById("pat_id").value;
        fetch(`${url}/getPresYear.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                let yearDropDown = document.getElementById('selectDate')
                data.forEach(year => {
                    const option = document.createElement('option');
                    option.value = year;
                    option.textContent = year;
                    yearDropDown.appendChild(option);
                })
                let selectedYear = document.getElementById('selectDate').value;
                if (!selectedYear) {
                    selectedYear = new Date().getFullYear();
                    yearDropDown.value = selectedYear
                }
                const container = document.getElementById('print_lab_result');
                container.innerHtml = '';
                fetchResults(selectedYear, id)
                printLabs(selectedYear, id)

            })
            .catch(error => console.log(error))
    }
</script>