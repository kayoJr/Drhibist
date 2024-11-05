<?php
require_once  "./db.php";
$pat_id = $_GET['pat_id'];
$date = $_GET['date'];
// $id = 1500;
$fetchYear = $conn->query("SELECT * FROM `prescription` WHERE `pat_id`='$pat_id' AND `date` = '$date' ORDER BY `taken` DESC");
$prescription = [];

if ($fetchYear->num_rows > 0) {
    while ($row = $fetchYear->fetch_assoc()) {
        $prescription[] = $row;
    }
}
echo json_encode($prescription);
