<?php
require '../../backend/db.php';
require '../../backend/auth.php';

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
    <title>Edit Price</title>
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
        .pharmacy{
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
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
                            <form method="post" id="insert_form" action="../../backend/update_lab_price.php">
                                <div class="table-responsive">
                                    <h3>Edit Lab Price</h3>
                                    <table class="table table-bordered" id="item_table">
                                        <tr class="mob_table">
                                            <th>Name</th>
                                            <th>Price</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td data-label="Name" id="select-div">
                                                    <select name="name" class="form-control selectpicker" data-live-search="true" id="authors">
                                                        <option selected="" disabled="">Select Lab</option>
                                                        <?php
                                                        require 'data_lab.php';
                                                        $authors = loadLab();
                                                        foreach ($authors as $author) {
                                                            echo "<option id='" . $author['id'] . "' value='" . $author['id'] . "'>" . $author['name'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td data-label="Type" id="select-div">
                                                    <!-- <select name="type" id="books" name="books" class="form-control" data-live-search="true">
													<option selected="" disabled="">Select Type</option>
													</select> -->
                                                    <input type="text" name="book" id="books" class="form-control">
                                                    <input type="text" name="med_id" hidden id="med_id" class="form-control">

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div align="center">
                                        <input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Update" data-toggle="modalss" data-target="#exampleModalCenter" />
                                    </div>
                                </div>
                            </form>

                            <form method="post" id="insert_form" action="../../backend/update_lab_price.php">
                                <div class="table-responsive">
                                    <h3>Edit Reception Price</h3>
                                    <table class="table table-bordered" id="item_table">
                                        <tr class="mob_table">
                                            <th>Price</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td data-label="Type" id="select-div">
                                                    <?php
                                                        $sql = ($conn->query("SELECT COLUMN_DEFAULT
                                                        from INFORMATION_SCHEMA.COLUMNS 
                                                        where TABLE_SCHEMA='drhibist' and TABLE_NAME='patient' and COLUMN_NAME='payment'"))->fetch_assoc();
                                                        // var_dump($sql['COLUMN_DEFAULT']);
                                                        $price =  substr($sql['COLUMN_DEFAULT'], 0, 3);
                                                    // $price = $sql['payment']
                                                    ?>
                                                    <input type="number" min="0" value="<?php echo $price; ?>" name="book" id="books" class="form-control">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div align="center">
                                        <input type="submit" name="edit_rec" id="submit_button" class="btn btn-primary" value="Update" data-toggle="modalss" data-target="#exampleModalCenter" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

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
    $(document).ready(function() {
        $("#authors").change(function() {
            var aid = $("#authors").val();
            $.ajax({
                url: 'data_lab.php',
                method: 'post',
                data: 'aid=' + aid
            }).done(function(books) {
                // console.log(aid);
                // console.log(books);
                books = JSON.parse(books);
                $('#books').empty();
                books.forEach(function(book) {
                    //$('#books').append('<option>Hello</option>')
                    console.log(book.price);
                    $('#books').val(book.price),
                        $('#med_id').val(book.id)
                })
            })
        })
    })


    const feedback = document.getElementById("feedback");
    setTimeout(() => {
        feedback.style.display = "none";
    }, 3000)
</script>