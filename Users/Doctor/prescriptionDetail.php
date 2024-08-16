<?php
require '../../backend/db.php';
require '../../backend/auth.php';
$pat_id = $_GET['id'];
$date = $_GET['date'];
$patientSql = "SELECT * FROM `patient` WHERE id = '$pat_id'";
$patientResult = mysqli_query($conn, $patientSql);
$patient = mysqli_fetch_assoc($patientResult);

// Fetch prescription details
$prescriptionSql = "SELECT * FROM `prescription` WHERE `pat_id` = '$pat_id' AND `date` = '$date' ORDER BY date DESC";
$prescriptionResult = mysqli_query($conn, $prescriptionSql);


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

        @media print {
            @page {
                size: landscape;
                margin: 0 auto;
            }
            .navigation{
                display: none !important; 
            }
            .prescription-paper * {
                visibility: visible;
            }

            .prescription-paper {
                visibility: visible;
                max-width: 50% !important;
                /* page-break-inside: avoid; */

                input {
                    text-transform: capitalize;
                }

                .patient-info {
                    position: fixed;
                    top: 6rem;
                    left: 1rem;
                    width: 50%;
                    margin: 1rem auto;
                }

                .signature {
                    position: fixed;
                    bottom: 5rem;
                    left: 1rem;
                    width: 50%;
                    margin: 0 auto;
                }

                header {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 50% !important;

                    img {
                        width: 100% !important;
                        overflow: hidden !important;
                    }
                }

                footer {
                    position: fixed;
                    bottom: 0;
                    left: 0;
                    width: 50% !important;

                    img {
                        width: 100% !important;
                        overflow: hidden !important;
                    }
                }

                table {
                    margin-top: 12rem;

                    page-break-inside: auto;
                }

                table thead tr th {
                    text-align: center;
                    padding: .5rem 0;

                    font-weight: bold;
                }

                table tbody tr td {
                    text-align: center;
                    padding: .5rem 0;
                    border: 1px solid #eee !important;
                }

                label,
                placeholder,
                table th {
                    font-size: 1rem !important;
                    font-weight: normal !important;
                    color: #000 !important;
                }
            }

            .signature {
                margin-top: 1.5rem;
                margin-bottom: 5rem;
                position: fixed;
                bottom: 5rem;

            }

            label,
            placeholder,
            table th {
                font-size: 1rem !important;
                font-weight: normal !important;
            }
        }

        .form-control {
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0;
        }

        form div {
            all: unset;
        }

        .prescription-paper form {
            background-color: transparent;

            .row {
                flex-wrap: nowrap !important;
            }
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
                        <div class="navigation">
                            <button class="button" onclick="history.go(-1);"><i class="fa-solid fa-chevron-left fa-2x"></i></button>
                            <button type="button" class="btn btn-secondary my-0" id="btnPrint">PRINT</button>
                        </div>
                        <div class="modal-body table-responsive presTable">
                            <table class="table table-bordered ">
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
                                    <th>Action</th>
                                </tr>
                                <tbody id="prescriptionTable">
                                    <?php
                                    $sql = "SELECT * FROM `prescription` WHERE `pat_id` = '$pat_id' AND `date`= '$date' ORDER BY `date` DESC ";
                                    $rs = mysqli_query($conn, $sql);
                                    if (!$rs) {
                                        echo $conn->error;
                                    }
                                    while ($row = mysqli_fetch_assoc($rs)) {
                                        $userId = $row['user_id'];
                                        $presId = $row['id'];
                                        $med_name = $row['med_name'];
                                        $med_type = $row['med_type'];
                                        $dosage = $row['dosage'];
                                        $route = $row['route'];
                                        $dose_per_day = $row['dose_per_day'];
                                        $duration = $row['duration'];
                                        $amount = $row['amount'];

                                        $sqlUser = "SELECT `role` FROM `users` WHERE `phone` = '$userId'";
                                        $rsUser = mysqli_query($conn, $sqlUser);
                                        $user = mysqli_fetch_assoc($rsUser);
                                        $role = $user['role']; // role will be 'doctor' or 'nurse'

                                        // Determine the checked state based on role
                                        $isOutPatientChecked = ($role === '4') ? 'checked' : 'disabled';
                                        $isInPatientChecked = ($role === '3') ? 'checked' : 'disabled';
                                    ?>
                                        <input type="hidden" name="pat_id" id="pat_id" value="<?php echo $pat_id; ?>">
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
                                            <td>
                                                <button type="button" data-pres-id="<?php echo $presId; ?>" class="btn fs-6 bg-danger my-0 button" onclick="removeRow(this,'<?php echo $presId; ?>')">Remove</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="prescription-paper">
                            <form class="my-0">
                                <header>
                                    <img src="../../img/lab_header.png" alt="">
                                </header>
                                <!-- title and date -->
                                <div class="patient-info">
                                    <div class="d-flex align-items-center justify-content-between my-2">
                                        <h1 class="fs-3">Prescription Paper</h1>
                                        <div class="d-flex">
                                            <label for="date" class="col-sm-2 col-form-label mr-2">Date:</label>
                                            <input type="text" class="form-control bg-transparent text-white" id="date" name="date" readonly>
                                        </div>
                                    </div>
                                    <!-- patient name -->
                                    <div class="d-flex">
                                        <label for="patientName" class="mr-2 text-nowrap">Patient's Name:</label>
                                        <input type="text" class="form-control bg-transparent text-white" id="patientName" name="patientName" readonly>
                                    </div>
                                    <!-- age sex and card number -->
                                    <div class="d-flex align-items-center justify-content-between mt-2 mb-1">
                                        <div class="d-flex">
                                            <label for="age" class="text-nowrap">Age:</label>
                                            <input type="text" class="form-control bg-transparent text-white" id="age" name="age" readonly>
                                        </div>
                                        <div class="d-flex">
                                            <label for="age" class="text-nowrap">Sex:</label>
                                            <input type="text" class="form-control bg-transparent text-white" id="sex" name="sex" readonly>
                                        </div>
                                        <div class="d-flex">
                                            <label for="age" class="text-nowrap">Card No.:</label>
                                            <input type="text" class="form-control bg-transparent text-white" id="cardNo" name="cardNo" readonly>
                                        </div>
                                    </div>
                                    <!-- inpatient or outpatient -->
                                    <div class="d-flex align-items-center justify-content-center gap-5">
                                        <div class="d-flex">
                                            <label for="age" class="mr-3 text-nowrap fs-4">In Patient:</label>
                                            <input type="radio" class="" name="pat_type" value="inpatient" <?php echo $isInPatientChecked; ?>>
                                        </div>
                                        <div class="d-flex">
                                            <label for="age" class="mr-3 text-nowrap fs-4">Out Patient:</label>
                                            <input type="radio" class="" name="pat_type" value="outpatient" <?php echo $isOutPatientChecked; ?>>
                                        </div>
                                    </div>
                                </div>
                                <table class="">
                                    <thead>
                                        <tr>
                                            <th>Treatment given (Drug name, strength, Dosage form, dose, and duration)</th>
                                            <!-- <th>Price of each item (for dispenser use only)</th> -->
                                        </tr>
                                    </thead>
                                    <tbody id="prescriptionBody">
                                        <!-- Prescription rows will be populated here by PHP -->
                                    </tbody>
                                </table>
                                <div class="signature row w-80 flex align-items-center justify-content-between">
                                    <div class="col-sm-5">
                                        <label>Prescriber's</label>
                                        <input type="text" class="form-control bg-transparent text-white" id="prescriberName" name="prescriberName" placeholder="Full name" readonly>
                                        <input type="text" class="form-control bg-transparent text-white" id="prescriberQualification" name="prescriberQualification" placeholder="Qualification" readonly>
                                        <input type="text" class="form-control bg-transparent text-white" id="prescriberRegNo" name="prescriberRegNo" placeholder="Registration" readonly>
                                        <input type="text" class="form-control bg-transparent text-white" id="prescriberSignature" name="prescriberSignature" placeholder="Signature" readonly>
                                    </div>
                                    <div class="col-sm-5">
                                        <label>Dispenser's</label>
                                        <input type="text" class="form-control bg-transparent text-white" id="dispenserName" name="dispenserName" placeholder="Full name" readonly>
                                        <input type="text" class="form-control bg-transparent text-white" id="dispenserQualification" name="dispenserQualification" placeholder="Qualification" readonly>
                                        <input type="text" class="form-control bg-transparent text-white" id="dispenserRegNo" name="dispenserRegNo" placeholder="Registration" readonly>
                                        <input type="text" class="form-control bg-transparent text-white" id="dispenserSignature" name="dispenserSignature" placeholder="Signature" readonly>
                                    </div>
                                </div>

                                <footer>
                                    <img src="../../img/pharmacyFooter.jpg" alt="">
                                </footer>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <?php


    ?>
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


    <script>
        // function removeRow(button) {
        //     // Get the row that contains the clicked button
        //     const row = button.closest('tr');
        //     // Remove the row from the table
        //     row.remove();
        // }
        function removeRow(button, presId) {
            // Get the row that contains the clicked button
            const row = button.closest('tr');
            // Remove the row from the table
            row.remove();
            // Also remove the row from the prescription paper table if it exists
            const prescriptionBody = document.getElementById('prescriptionBody');
            const rows = prescriptionBody.querySelectorAll('tr');
            rows.forEach(r => {
                if (r.dataset.presId === presId) {
                    r.remove();
                }
                // if (r.cells[0].textContent.includes(medName)) {
                //     r.remove();
                // }
            });
        }
        document.getElementById("btnPrint").onclick = function() {
            window.print();
        }
        const feedback = document.getElementById("feedback");
        setTimeout(() => {
            feedback.style.display = "none";
        }, 3000)

        document.addEventListener('DOMContentLoaded', function() {
            // Populate patient details
            document.getElementById('patientName').value = "<?php echo $patient['name']; ?>";
            document.getElementById('date').value = "<?php echo $date; ?>"
            document.getElementById('age').value = "<?php echo $patient['age']; ?>";
            document.getElementById('sex').value = "<?php echo $patient['sex']; ?>";
            document.getElementById('cardNo').value = "<?php echo $pat_id; ?>";

            // Populate prescription details
            let prescriptionBody = document.getElementById('prescriptionBody');
            let prescriptionTable = document.getElementById('prescriptionTable');

            prescriptionTable.querySelectorAll('tr').forEach(row => {
                let newRow = document.createElement('tr');
                newRow.dataset.presId = row.querySelector('.button').getAttribute('data-pres-id'); // Add presId to the new row
                newRow.innerHTML = `
            <td>${row.cells[0].textContent} &nbsp; &nbsp; &nbsp;
            ${row.cells[1].textContent} &nbsp; &nbsp;
            ${row.cells[2].textContent} &nbsp; &nbsp;
            ${row.cells[3].textContent} &nbsp; &nbsp;
            ${row.cells[4].textContent} &nbsp; &nbsp;
            ${row.cells[5].textContent} &nbsp; &nbsp;
            ${row.cells[6].textContent} &nbsp; &nbsp;
        `;
                prescriptionBody.appendChild(newRow);
            });


        });
    </script>
</body>

</html>
