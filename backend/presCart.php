<?php
require_once './db.php';
if (isset($_POST['submit'])) {
    $med_id = $_POST['medName'];
    $dosage = $_POST['dosage'];
    $pat_id = $_POST['pat_id'];
    $user_id = $_POST['user_id'];
    $type = $_POST['type'];
    $route = $_POST['route'];
    $dosePerDay = $_POST['dosePerDay'];
    $duration = $_POST['duration'];
    $quant = $_POST['quant'];
    $note = $_POST['note'];

    $sql = $conn->query("INSERT INTO `prescart`( `med_id`, `dosage`, `route`, `dose_per_day`, `duration`, `amount`, `note`, `pat_id`, `user_id`) VALUES (
        '$med_id',
        '$dosage',
        '$route',
        '$dosePerDay',
        '$duration',
        '$quant',
        '$note',
        '$pat_id',
        '$user_id'
    )");

    if ($sql) {
        header("Location:../Users/Doctor/prescription.php?msg=Added&id=$pat_id");
    } else {
        echo $conn->error;
    }
}
