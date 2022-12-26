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
    $sql = "INSERT INTO `admission_med`(`name`, `type`, `price`, `amount`, `tot_amount`, `patient_id`) 
        VALUES ('$name', '$type', '$price', '$amount', '$sub', '$pat_id')";
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
