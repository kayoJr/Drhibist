<?php
include 'db.php';
// $id = $_GET['id'];

if (isset($_POST['lab_payment'])) {
    $id = $_POST['id'];
    $price = $_POST['price'];
    $payment = $_POST['payment'];

    if ($payment == 'system') {
        $sql = "INSERT INTO `system_payment` (`price`, `reason`,`pat_id`) VALUES ('$price', 'laboratory', '$id')";
        if (!$conn->query($sql)) {
            echo $conn->error;
        } else {
            $sql = "UPDATE `lab_cart2` SET `payment` = 1 WHERE `patient_id` = '$id'";
            if ($conn->query($sql)) {
                header("Location:../Users/Reception/search.php?search=$id&searching=Search&msg=Payed");
            } else {
                echo $conn->error;
            }
        }
    }else if($payment == 'cash'){
        $sql = "INSERT INTO `income` (`price`, `reason`,`pat_id`) VALUES ('$price', 'laboratory', '$id')";
            if(!$conn->query($sql)){
                echo $conn->error;
            }else{
                $sql = "UPDATE `lab_cart2` SET `payment` = 1 WHERE `patient_id` = '$id'";
                if ($conn->query($sql)) {
                    header("Location:../Users/Reception/search.php?search=$id&searching=Search&msg=Payed");
                } else {
                    echo $conn->error;
                }
            }
    }else if($payment == 'admission'){
        $sql = "INSERT INTO `admission_pay` (`price`, `reason`, `pat_id`) VALUES ('$price', 'laboratory', '$id')";
            if(!$conn->query($sql)){
                echo "error".$conn->error;
            }else{
                $sql = "UPDATE `lab_cart2` SET `payment` = 1 WHERE `patient_id` = '$id'";
                if ($conn->query($sql)) {
                    header("Location:../Users/Reception/search.php?search=$id&searching=Search&msg=Payed");
                } else {
                    echo $conn->error;
                }
            }
    }
    if (isset($_POST['credit'])) {
        $credit = $_POST['credit'];
        if ($credit == 'cigna') {
            $sql = "INSERT INTO `credit` (`price`, `reason`, `pat_id`, `org`) VALUES ('$price', 'laboratory', '$id', 'cigna')";
            $rss = $conn->query($sql);
            if ($rss) {
                $sql = "UPDATE `lab_cart2` SET `payment` = 1 WHERE `patient_id` = '$id'";
                if ($conn->query($sql)) {
                    header("Location:../Users/Reception/search.php?search=$id&searching=Search&msg=Payed");
                } else {
                    echo $conn->error;
                }            } else {
                echo $conn->error;
            }
        } else if ($credit == 'stc') {
            $sql = "INSERT INTO `credit` (`price`, `reason`, `pat_id`, `org`) VALUES ('$price', 'laboratory', '$id', 'stc')";
            $rss = $conn->query($sql);
            if ($rss) {
                $sql = "UPDATE `lab_cart2` SET `payment` = 1 WHERE `patient_id` = '$id'";
                if ($conn->query($sql)) {
                    header("Location:../Users/Reception/search.php?search=$id&searching=Search&msg=Payed");
                } else {
                    echo $conn->error;
                }            } else {
                echo $conn->error;
            }
        }
    }
}
// else if($payment == 'credit'){
//     $sql = "INSERT INTO `credit` (`price`, `reason`) VALUES ('$price', 'laboratory')";
//         if(!$conn->query($sql)){
//             echo $conn->error;
//         }else{
//             $sql = "UPDATE `lab_cart2` SET `payment` = 1 WHERE `patient_id` = '$id'";
//             if ($conn->query($sql)) {
//                 header("Location:../Users/Reception/search.php?search=$id&searching=Search&msg=Payed");
//             } else {
//                 echo $conn->error;
//             }
//         }
// }