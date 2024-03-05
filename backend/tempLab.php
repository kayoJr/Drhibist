<?php
require './db.php';

    $id = $_POST['id'];

    $sql = $conn->query("INSERT INTO `lab_cart2`(`name`, `price`, `patient_id`,`doctor_id`) VALUES ('CRP', '500', '$id', 1)");
    $sql2 = $conn->query("INSERT INTO `lab_cart2`(`name`, `price`, `patient_id`,`doctor_id`) VALUES ('PICT', '100', '$id', 1)");
