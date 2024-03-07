<?php
require_once  "./db.php";
$id = $_GET['id'];
// $id = 1500;
$fetchYear = $conn->query(
    "SELECT DISTINCT `date` AS year FROM `abdominal`WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `neck`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `breast`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `normal_brain`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `other`  WHERE `patient_id`='$id'
        ORDER BY year ASC;
 "
);
$years = [];

if ($fetchYear->num_rows > 0) {
    while ($row = $fetchYear->fetch_assoc()) {
        $years[] = $row['year'];
    }
}
echo json_encode($years);
