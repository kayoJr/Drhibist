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
    <title>Doctor</title>
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

        .accordion-button {
            text-transform: capitalize;
        }

        @media print {
            .ultraResult {
                visibility: visible !important;
                display: block !important;
            }

            .lab-footer {
                width: 100% !important;
                height: 8rem !important;

                img {
                    height: auto !important;
                    width: 100% !important;
                }
            }
        }

        .lab_result {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .lab_result .result-box {
            width: 100%;
            height: 100%;
        }

        /* .lab_result .result-box ul li{
            display: flex;
            align-items: center;
            justify-content: space-between;
        } */
        .lab_result img {
            width: 100%;
        }

        .table-head th {
            background-color: transparent !important;
        }

        .table-head th,
        .table-head td {
            text-transform: capitalize;
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
                            echo "<p>$msg</p>";
                            $id = $_GET['id'];
                            $date = date("Y-m-d");

                            $rs1 = $conn->query("SELECT * FROM `abdominal` WHERE `patient_id`= '$id'");
                            $neck = $conn->query("SELECT * FROM `neck` WHERE `patient_id`='$id'");
                            $chest = $conn->query("SELECT * FROM `breast` WHERE `patient_id`='$id'");
                            $normal_brain = $conn->query("SELECT * FROM `normal_brain` WHERE `patient_id`='$id'");
                            $other = $conn->query("SELECT * FROM `other` WHERE `patient_id`='$id'");
                            $info = $conn->query("SELECT * FROM `patient` WHERE `id` = '$id'");
                            $info_det = $info->fetch_assoc();

                            ?>
                        </div>
                        <div class="navigation">
                            <button class="button" onclick="history.go(-1);"><i class="fa-solid fa-chevron-left fa-2x"></i></button>
                            <select class="px-4 py-2 fs-5" name="selectDate" id="selectDate" onchange="fetchResult()">

                            </select>
                            <input type="hidden" name="" id="pat_id" value="<?php echo $id; ?>">
                            <button class="btn" id="btnPrint">Print</button>
                        </div>
                        <div class="d-flex items-center justify-content-between print_info">
                            <p class="text-white fs-2" id="dateCont">

                            </p>
                            <p class="text-white fs-2"><?php echo $info_det['name']; ?></p>
                        </div>

                        <!-- <div class="details-page mt-0 row mt-4" id="lab_result">

                        </div> -->
                        <div class="row mt-4 ultraResult lab_result" id="lab_result">

                        </div>
                    </div>
                    <div class="lab-header">
                        <img src="../../img/lab_header.png" alt="">
                    </div>
                    <div class="lab-footer">
                        <img src="../../img/pharmacyFooter.jpg" alt="">
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
    document.getElementById("btnPrint").onclick = function() {
        window.print();
    }
    document.addEventListener('DOMContentLoaded', () => {
        fetchYears();
    })
    const url = "<?php echo $url; ?>"

    function fetchYears() {
        const id = document.getElementById("pat_id").value;
        fetch(`${url}/getYearUltra.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                let yearDropDown = document.getElementById('selectDate')
                // yearDropDown.innerHTML = '<option value="" selected default disabled>Please Select Year</option>';
                // const yearDropDown = document.createElement('select');
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
                const container = document.getElementById('lab_result');
                container.innerHtml = '';
                fetchResults(selectedYear, id)
            })
            .catch(error => console.log(error))
    }

    function fetchResults(date, id) {
        const dateCont = document.getElementById("dateCont");
        dateCont.innerText = date
        const container = document.getElementById('lab_result');
        fetch(`${url}/getUltraResult.php?id=${id}&year=${date}`)
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('lab_result');
                container.innerHTML = ''; // Clear previous content
                // Check if data is an object
                if (typeof data === 'object' && data !== null) {
                    // Object to store already created accordion content
                    const accordionContent = {};
                    // Loop through the data object
                    for (const table in data) {
                        if (Object.prototype.hasOwnProperty.call(data, table)) {
                            // Get results object for the current table
                            const resultsObject = data[table];
                            // Check if accordion with same group name exists
                            if (!accordionContent[table]) {
                                accordionContent[table] = ''; // Initialize accordion content
                            }
                            // Generate HTML for the results
                            let ul = '';
                            let rows = '';
                            if (resultsObject.length > 0) {
                                //     Array.from(resultsObject).forEach((moreData) => {
                                //         // Append content to existing accordion
                                //         accordionContent[table] +=
                                //             `<tr>
                                //     ${Object.keys(moreData)
                                //         .filter(key => ![ 'table_name', 'patient_id', 'petn_id','lab_user', 'P-LCR', 'P-LCC'].includes(key))
                                //         .map(key =>
                                //             `<td>${moreData[key]}}</td>`
                                //         ).join('')}
                                // </tr>`;
                                //     });
                                resultsObject.forEach(moreData => {
                                    rows += `<table class='table mt-0'>
                                            <thead>
                                              
                                            </thead>
                                            <tbody>`;

                                    Object.keys(moreData)
                                        .filter(key => !['table_name', 'patient_id', 'petn_id', 'lab_user', 'P-LCR', 'P-LCC'].includes(key))
                                        .forEach(key => {
                                            rows += `<tr>
                                                    <th>${key}</th>
                                                    <td>${moreData[key]}</td>
                                                 </tr>`;
                                        });

                                    rows += `</tbody></table><br/>`; // End of this specific table
                                });
                            } else {
                                Array.from(resultsObject).forEach((moreData) => {
                                    // Append content to existing accordion
                                    accordionContent[table] +=
                                        `<tr>
                                ${Object.keys(moreData)
                                    .filter(key => ![ 'table_name', 'patient_id', 'petn_id','lab_user', 'P-LCR', 'P-LCC'].includes(key))
                                    .map(key =>
                                        `<td>${moreData[key]}}</td>`
                                    ).join('')}
                            </tr>`;
                                });
                            }
                            // if (resultsObject.length > 0) {
                            //     Array.from(resultsObject).forEach((moreData) => {
                            //         // Append content to existing accordion
                            //         accordionContent[table] +=
                            //             `<tr>
                            //                 ${Object.keys(moreData)
                            //                     .filter(key => !['id', 'table_name', 'patient_id', 'petn_id','lab_user', 'P-LCR', 'P-LCC'].includes(key))
                            //                     .map(key =>
                            //                         `<td>${moreData[key]} ${(units[key] == undefined) ? '' : units[key]}</td>`
                            //                     ).join('')}
                            //             </tr>`;
                            //     });
                            // }
                            // Create accordion for the current table
                            //         container.innerHTML +=
                            //             `<div class="accordion-item bg-transparent w-full">
                            //     <h2 class="accordion-header w-25 mx-auto" id="heading${table}">
                            //         <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${table}" aria-expanded="true" aria-controls="collapse${table}">
                            //             ${table} Result
                            //         </button>
                            //     </h2>
                            //     <div id="collapse${table}" class="accordion-collapse collapse show" aria-labelledby="heading${table}" data-bs-parent="#print_lab_result">
                            //         <div class="accordion-body custom-grid">
                            //             <table class='table mt-0'>
                            //                 <thead>
                            //                     <tr>
                            //                         ${Object.keys(resultsObject[0])
                            //                             .filter(key => ![ 'table_name', 'patient_id', 'petn_id','lab_user', 'P-LCR', 'P-LCC'].includes(key))
                            //                             .map(key =>
                            //                                 `<th>${key}</th>`
                            //                             ).join('')}
                            //                     </tr>
                            //                 </thead>
                            //                 <tbody>
                            //                     ${accordionContent[table]}
                            //                 </tbody>
                            //             </table>
                            //         </div>
                            //     </div>
                            // </div>`;
                            container.innerHTML += `
                            <div class="accordion-item bg-transparent w-full">
                                <h2 class="accordion-header w-25 mx-auto" id="heading${table}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${table}" aria-expanded="true" aria-controls="collapse${table}">
                                        ${table} Result
                                    </button>
                                </h2>
                                <div id="collapse${table}" class="accordion-collapse collapse show" aria-labelledby="heading${table}" data-bs-parent="#print_lab_result">
                                    <div class="accordion-body custom-grid">
                                        ${rows}
                                    </div>
                                </div>
                            </div>`;
                        }
                    }
                }
            })


            .catch(error => console.log(error))
    }

    function printLabs(date, id) {

        const dateCont = document.getElementById("dateCont");
        dateCont.innerText = date
        const container = document.getElementById('print_lab_result');
        fetch(`${url}/getLabResult.php?id=${id}&year=${date}`)
            .then(response => response.json())
            .then(data => {
                // const container = document.getElementById('print_lab_result');
                container.innerHtml = '';
                // Check if data is an object
                if (typeof data === 'object' && data !== null) {
                    // Loop through the data object
                    for (const table in data) {
                        if (Object.prototype.hasOwnProperty.call(data, table)) { // Check if property is an own property
                            // Get results object for the current table
                            const resultsObject = data[table];
                            // Generate HTML for the results
                            container.innerHtml = '';
                            let ul = '';
                            if (resultsObject.length > 0) {
                                Array.from(resultsObject).forEach((moreData) => {
                                    ul +=
                                        `<table class='table mt-0'>
                                <thead>
                                <th>Test</th>
                                <th>Result</th>
                                </thead>
                                ${Object.keys(moreData)
                                    .filter(key => !['id', 'table_name', 'patient_id', 'petn_id','lab_user', 'P-LCR', 'P-LCC'].includes(key))
                                    .map(key =>
                                    `
                                    <thead class='table-head'>
                                
                                        <th>${(columns[key] == undefined) ? key : columns[key]}</th>
                                        <td>${moreData[key]} ${(units[key] == undefined) ? '' : units[key]}</td>
                                        </thead>
                                    
                                `,
                                )
                                }
                                    </table>
                           `
                                })
                            }

                            const html = `
                        <div class="result-box" id='result_box'>
                            <h2 class="text-center" id="result_name">${(tableName[table] == undefined) ? table : tableName[table]} Result</h2>
                            ${ul}
                        </div>
                    `;
                            // Append the HTML to the container
                            container.innerHTML += html;
                        }
                    }
                } else {
                    console.error('Invalid data format:', data);
                }
            })
            .catch(error => console.log(error))
    }

    function printLab() {
        const id = document.getElementById("pat_id").value;
        const date = document.getElementById("selectDate").value;
        const container = document.getElementById('print_lab_result');
        container.innerHTML = '';
        console.log(date);
        fetchResults(date, id)
    }

    function fetchResult() {
        const id = document.getElementById("pat_id").value;
        const date = document.getElementById("selectDate").value;
        const container = document.getElementById('lab_result');
        container.innerHTML = '';
        fetchResults(date, id)
    }
</script>
