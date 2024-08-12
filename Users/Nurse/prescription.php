<?php
require '../../backend/db.php';
require '../../backend/auth.php';
$pat_id = $_GET['id'];
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
                        <div class="pharmacy">
                            <form method="post" id="insert_form" class="presForm" action="../../backend/prescart.php">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="item_table">
                                        <tr class="mob_table">
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Dosage</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td data-label="Name" id="select-div" class="medName">
                                                    <select name="medName" class="form-control selectpicker" data-live-search="true" id="authors" required>
                                                        <option selected="" disabled="" value="">Select Medicine</option>
                                                        <?php
                                                        require 'pharmData.php';
                                                        $authors = loadAuthors();
                                                        foreach ($authors as $author) {
                                                            echo "<option id='" . $author['id'] . "' value='" . $author['med_id'] . "'>" . $author['name'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td data-label="Type" id="select-div">
                                                    <input type="text" name="type" id="books" readonly class="form-control">
                                                    <input type="hidden" name="med_id" id="med_id" readonly class="form-control">
                                                    <input type="hidden" name="pat_id" id="pat_id" value="<?php echo $pat_id; ?>" class="form-control">
                                                    <input type="hidden" name="user_id" value="<?php echo $phone_user; ?>">
                                                </td>
                                                <td data-label="Type" id="select-div">
                                                    <input required type="text" name="dosage" id="dosage" class="form-control bg-transparent text-white">
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <table class="table " id="item_table">
                                        <tr class="mob_table">
                                            <th>Route</th>
                                            <th>Frequency</th>
                                            <th>Duration</th>
                                            <th>amount</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td data-label="Route">
                                                    <select required name="route" id="route" name="name" class="form-control selectpicker" data-live-search="true">
                                                        <option selected="" disabled="">Select Route</option>
                                                        <?php
                                                        $sql = $conn->query("SELECT * FROM `medroute`");
                                                        while ($row = mysqli_fetch_assoc($sql)) {
                                                            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td data-label="dosePerDay">
                                                    <select required name="dosePerDay" id="dosePerDay" name="name" class="form-control selectpicker" data-live-search="true">
                                                        <option selected="" disabled="">Frequency</option>
                                                        <?php
                                                        $sql = $conn->query("SELECT * FROM `dosage`");
                                                        while ($row = mysqli_fetch_assoc($sql)) {
                                                            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td data-label="Duration">
                                                    <input type="text" name="duration" id="duration" class="form-control bg-transparent text-white" required>
                                                </td>
                                                <td data-label="Quantity">
                                                    <input type="text" name="quant" id="quant" class="form-control bg-transparent text-white">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <table class="table table-bordered" id="item_table">
                                        <tr class="mob_table">
                                            <th>Note</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td data-label="note">
                                                    <textarea name="note" rows="10" id="" class="form-control bg-transparent text-white"></textarea>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                    <div align="center">
                                        <input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Add To List" data-toggle="modalss" data-target="#exampleModalCenter" />
                                    </div>
                                </div>
                            </form>
                            <div class="cart">
                                <h3 class="center">List</h3>
                                <div class="elements">
                                    <div class="middle-cart">
                                        <?php
                                        $sql = "SELECT prescart.*, medicines.name, medicines.type
                                                FROM prescart
                                                JOIN medicines ON prescart.med_id = medicines.med_id
                                                WHERE user_id = '$phone_user'
                                                ;
                                                ";
                                        $rs = mysqli_query($con, $sql);
                                        if (mysqli_num_rows($rs)) {
                                            while ($row = mysqli_fetch_assoc($rs)) {
                                                $cartId = $row['id'];
                                        ?>

                                                <div class="element">
                                                    <div class="d-flex align-items-center">
                                                        <?php
                                                        echo "<a href='../../backend/remove_prescart.php?id=$cartId&user=$phone_user&pat_id=$pat_id'><b>X</b></a>";
                                                        echo  "<h4 class='my-0'>" . $row['name']  . "</h4>";
                                                        ?>
                                                    </div>
                                                </div>

                                        <?php
                                            }
                                        }

                                        ?>

                                    </div>
                                    <div class="bottom-cart">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">See Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered presPaper" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Prescription Summery</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
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
                        </tr>
                        <tbody>

                            <?php

                            $sql = "SELECT prescart.*, medicines.name, medicines.type
                    FROM prescart
                    JOIN medicines ON prescart.med_id = medicines.med_id
                    WHERE user_id = '$phone_user'
                    ";
                            $rs = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($rs)) {
                                $presId = $row['id'];
                            ?>
                                <tr>
                                    <td class="text-dark"><?php
                                                            echo $row['name'];
                                                            ?></td>
                                    <td class="text-dark"><?php
                                                            echo $row['type'];
                                                            ?></td>
                                    <td class="text-dark"><?php
                                                            echo $row['dosage'];
                                                            ?></td>
                                    <td class="text-dark"><?php
                                                            echo $row['route'];
                                                            ?></td>
                                    <td class="text-dark"><?php
                                                            echo $row['dose_per_day'];
                                                            ?></td>
                                    <td class="text-dark"><?php
                                                            echo $row['duration'];
                                                            ?></td>
                                    <td class="text-dark"><?php
                                                            echo $row['amount'];
                                                            ?></td>
                                    <td class="text-dark"><?php
                                                            echo $row['note'];
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
                    <a class="btn" href="../../backend/confirmPrescription.php?id=<?php echo $presId; ?>&user=<?php echo $phone_user; ?>">DONE</a>
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
</script>
