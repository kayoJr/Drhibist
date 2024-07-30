<?php
require_once './db.php';

$presId = $_GET['id'];
$phone_user = $_GET['user'];

$sqlSelect = $conn->query("SELECT prescart.*, medicines.name, medicines.type
                    FROM prescart
                    JOIN medicines ON prescart.med_id = medicines.id
                    WHERE user_id = '$phone_user'");

while ($row = $sqlSelect->fetch_assoc()) {
    var_dump($row);
    $med_name = $row['name'];
    $med_type = $row['type'];
    $dosage = $row['dosage'];
    $route = $row['route'];
    $dose_per_day = $row['dose_per_day'];
    $duration = $row['duration'];
    $amount = $row['amount'];
    $note = $row['note'];
    $user_id = $row['user_id'];
    $pat_id = $row['pat_id'];

    $sqlInsert = $conn->query("INSERT INTO `prescription`(`med_name`, `med_type`, `dosage`, `route`, `dose_per_day`, `duration`, `amount`, `note`, `user_id`, `pat_id`) VALUES (
    '$med_name', '$med_type', '$dosage', 
    '$route', '$dose_per_day', '$duration', 
    '$amount', '$note', '$user_id', '$pat_id')");

    if ($sqlInsert) {
        $deleteQuery = $conn->query("DELETE FROM `prescart` WHERE `user_id` = '$phone_user'");
        header("Location:../Users/Doctor/prescription.php?msg=Prescription Sent&id=$pat_id");
    } else {
        echo $conn->error;
    }
}
