<?php
require_once  "./db.php";
$id = $_GET['id'];
// $id = 1500;
$fetchYear = $conn->query(
    "SELECT DISTINCT `date` AS year FROM `prescription` WHERE `pat_id`='$id'
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
