<?php
require '../../backend/db.php';
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

                        <form action="prescription.php" class="search" onsubmit="return false;">
                            <h3>Search Patient</h3>
                            <div class="search-form">
                                <input type="number" name="search" id="search" min="0" required placeholder="Phone or Card Number" />
                                <button type="button" onclick="fetchDates()" class="btn ml-4 btn-primary bg-primary">Search</button>
                            </div>
                            <div id="dateDropdownContainer" style="display: none;" class="mt-4">
                                <label for="selectDate">Select Date:</label>
                                <select id="selectDate" name="selectDate" onchange="fetchPrescriptions()">
                                    <!-- Dates will be dynamically populated here -->
                                </select>
                            </div>
                        </form>

                        <div id="prescriptionTableContainer">
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
    // document.addEventListener('DOMContentLoaded', () => {
    //     fetchYears();
    // })
    const url = "<?php echo $url; ?>"
    // document.getElementById("btnPrint").onclick = function() {
    //     window.print();
    // }
    const feedback = document.getElementById("feedback");
    setTimeout(() => {
        feedback.style.display = "none";
    }, 3000)

    function fetchDates() {
        const patientId = document.getElementById("search").value;

        if (patientId === '') {
            alert("Please enter a valid patient ID");
            return;
        }

        fetch(`${url}/getPresYear.php?id=${patientId}`)
            .then(response => response.json())
            .then(data => {
                const dateDropdownContainer = document.getElementById("dateDropdownContainer");
                const selectDate = document.getElementById("selectDate");
                selectDate.innerHTML = ""; // Clear any previous options

                if (data.length > 0) {
                    dateDropdownContainer.style.display = "block";

                    data.forEach(date => {
                        const option = document.createElement("option");
                        option.value = date;
                        option.textContent = date;
                        selectDate.appendChild(option);
                    });

                    // Automatically fetch prescriptions for the first date in the list
                    fetchPrescriptions();
                } else {
                    alert("No prescription dates found for this patient.");
                    dateDropdownContainer.style.display = "none";
                }
            })
            .catch(error => console.log(error));
    }

    function fetchYears() {
        const id = document.getElementById("pat_id").value;
        fetch(`${url}/getPresYear.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                let yearDropDown = document.getElementById('selectDate');
                yearDropDown.innerHTML = ''; // Clear previous options

                if (data.length === 0) {
                    // Optional: Handle case where no dates are available
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'No prescriptions found';
                    yearDropDown.appendChild(option);
                } else {
                    data.forEach(year => {
                        const option = document.createElement('option');
                        option.value = year;
                        option.textContent = year;
                        yearDropDown.appendChild(option);
                    });

                    // Set the default selected year if available
                    yearDropDown.value = data[0];
                }
            })
            .catch(error => console.log(error));
    }

    function fetchPrescriptions() {
        const patientId = document.getElementById("search").value;
        const selectedDate = document.getElementById("selectDate").value;

        fetch(`${url}/getPrescriptions.php?pat_id=${patientId}&date=${selectedDate}`)
            .then(response => response.json())
            .then(data => {
                const tableContainer = document.getElementById("prescriptionTableContainer");
                tableContainer.innerHTML = ""; // Clear previous data
                if (data.length > 0) {
                    let tableHtml = `
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
                            <th>Action</th>
                        </tr>
                        <tbody>
                `;

                    data.forEach(prescription => {
                        
                        const isChecked = (prescription.taken === 1 || prescription.taken === "1") ? "checked" : "";
                        tableHtml += `
                        <tr>
                            <td>${prescription.med_name}</td>
                            <td>${prescription.med_type}</td>
                            <td>${prescription.dosage}</td>
                            <td>${prescription.route}</td>
                            <td>${prescription.dose_per_day}</td>
                            <td>${prescription.duration}</td>
                            <td>${prescription.amount}</td>
                            <td>${prescription.note}</td>
                            <td>${prescription.date}</td>
                            <td><input type="checkbox" class="taken-checkbox" data-id="${prescription.id}" ${isChecked} /></td>
                        </tr>
                    `;
                    });

                    tableHtml += "</tbody></table>";
                    tableHtml += "<div class='modal-footer'>";
                    tableHtml += "<button type='button' class='btn btn-secondary my-0' id='printPage'>VIEW</button>";
                    tableHtml += "</div>";
                    tableContainer.innerHTML = tableHtml;
                    document.getElementById('printPage').addEventListener('click', function() {
                        const id = document.getElementById("search").value;
                        const selectedYear = document.getElementById('selectDate').value;
                        window.location.href = `printPrescription.php?year=${selectedYear}&id=${id}`;
                    });
                } else {
                    tableContainer.innerHTML = "<p>No prescriptions found for this date.</p>";
                }
            })
            .catch(error => console.log(error));
    }
    document.addEventListener('change', (event) => {
    if (event.target.classList.contains('taken-checkbox')) {
        const prescriptionId = event.target.getAttribute('data-id');
        const takenStatus = event.target.checked ? 1 : 0;

        // Send the taken status to the server
        fetch(`${url}/updateTakenStatus.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ prescriptionId, takenStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Taken status updated successfully');
            } else {
                console.error('Failed to update taken status');
            }
        })
        .catch(error => console.log(error));
    }
});

</script>