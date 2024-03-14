<?php
require 'db.php';

$ssq = "SELECT * FROM cart_adm";
$result = $conn->query($ssq);
while ($row = $result->fetch_assoc()) {

    $id = $row['id'];
    $name = $row['name'];
    $type = $row['type'];
    $price = $row['price'];
    $amount = $row['quant'];
    $sub = $row['sub_price'];
    $pat_id = $row['pat_id'];
    $now = date("Y-m-d");

    $check_if_exist = $conn->query("SELECT * FROM `admission_med` WHERE `id` = '$id' AND `date` = '$now' AND `patient_id` = '$pat_id' AND `payment` = 0");
    if ($check_if_exist->num_rows > 0) {
        while ($row = $check_if_exist->fetch_assoc()) {
            $prev_amount = $row['amount']; //previous amount
            $price = $row['price']; //single price
            $patient = $row['patient_id'];
            $upd_amount = $prev_amount + $amount;
            $new_price = $price * $upd_amount;
            $update_existing = $conn->query("UPDATE `admission_med` SET `amount` = '$upd_amount', `tot_amount`='$new_price' WHERE `id` = '$id' AND `patient_id` = '$pat_id' AND `date` = '$now' AND `payment` = 0");
            if ($update_existing) {
                $sql = "TRUNCATE TABLE `cart_adm`";
                $res = $conn->query($sql);
                if ($res) {
                    header("Location:../Users/Pharmacy/admission.php?msg=Done");
                } else {
                    echo mysqli_error($conn);
                }
            }
        }
    } else {
        $sql = "INSERT INTO `admission_med`(`id`, `name`, `type`, `price`, `amount`, `tot_amount`, `patient_id`) 
        VALUES ('$id', '$name', '$type', '$price', '$amount', '$sub', '$pat_id')";
        $res = $conn->query($sql);
        if (!$res) {
            echo $conn->error;
        } else {
            $sql = "TRUNCATE TABLE `cart_adm`";
            $res = $conn->query($sql);
            if ($res) {
                header("Location:../Users/Pharmacy/admission.php?msg=Done");
            } else {
                echo mysqli_error($conn);
            }
        }
    }
}
