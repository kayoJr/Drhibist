<?php
require 'db.php';
// session_start();
// global $conn;

if (isset($_POST['add_pat'])) {
    $name = $_POST['name'];
    $age_num = $_POST['age'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];
    $age_type = $_POST['age_type'];
    $payment = $_POST['payment'];

    $age = $age_num . ' ' . $age_type;

    $sql = "INSERT INTO `patient`(`name`, `age`, `sex`, `phone`) 
            VALUES ('$name', '$age', '$sex', $phone)";
    $res = $conn->query($sql);
    $idd =  mysqli_insert_id($conn);

    if ($res) {
        if ($payment == "system") {
            $sql = "INSERT INTO `system_payment` (`price`, `reason`) VALUES (100, 'reception')";
            if (!$conn->query($sql)) {
                echo $conn->error;
            } else {
                header("Location: ../Users/Reception/index.php?msg=Patient Added at &rn=$idd");
            }
        } else if ($payment == "cash") {
            $sql = "INSERT INTO `income` (`price`, `reason`) VALUES (100, 'reception')";
            if (!$conn->query($sql)) {
                echo $conn->error;
            } else {
                header("Location: ../Users/Reception/index.php?msg=Patient Added at &rn=$idd");
            }
        }
        if (isset($_POST['credit'])) {
            $credit = $_POST['credit'];
            if ($credit == 'cigna') {
                echo $idd;
                $sql = "INSERT INTO `credit` (`price`, `reason`, `pat_id`, `org`) VALUES (100, 'reception', '$idd', 'cigna')";
                $rss = $conn->query($sql);
                if ($rss) {
                    header("Location: ../Users/Reception/index.php?msg=Patient Added at &rn=$idd");
                } else {
                    echo $conn->error;
                }
            } else if ($credit == 'stc') {
                $sql = "INSERT INTO `credit` (`price`, `reason`, `pat_id`, `org`) VALUES (100, 'reception', '$idd', 'stc')";
                $rss = $conn->query($sql);
                if ($rss) {
                    header("Location: ../Users/Reception/index.php?msg=Patient Added at &rn=$idd");
                } else {
                    echo $conn->error;
                }
            }
        }
    } else {
        header("Location: ../Users/Reception/index.php?err=Patient Not Added");
    }
}

// else if ($payment == "credit") {
//     $sql = "INSERT INTO `credit` (`price`, `reason`) VALUES (100, 'reception')";
//     if (!$conn->query($sql)) {
//         echo $conn->error;
//     } else {
       
//         header("Location: ../Users/Reception/index.php?msg=Patient Added&rn=$idd");
//     }
// }