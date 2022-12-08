<?php
require './db.php';

if (isset($_POST['submit'])) {
    $pat = $_POST['pat'];
    $brands = $_POST['brands'];
    foreach ($brands as $brand) {
        echo $brand;
        $sql = "INSERT INTO `ultra_cart`(`requests`, `patient_id`) VALUES ('$brand', '$pat')";
        $rs = $conn->query($sql);
        if (!$rs) {
            echo $conn->error;
        } else {
            header("Location:../Users/Doctor/index.php?msg=Done&search=$pat&searching=Search");
        }
    }
}
