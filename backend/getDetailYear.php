<?php
require_once  "./db.php";
$id = $_GET['id'];
// $id = 1000;
$fetchYear = $conn->query(
    "SELECT DISTINCT `date` AS year FROM `pat_detail` WHERE `pat_id`='$id'
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
