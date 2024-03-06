<?php
require_once  "./db.php";
$id = $_GET['id'];
$date = $_GET['year'];

// $id = 1000;
// $date = '2023-02-20';

$table_results = array();
$cbc = $conn->query("SELECT *, 'Patient Detail' AS table_name FROM `pat_detail` WHERE `pat_id`= '$id' AND `date` = '$date'")->fetch_assoc();


if (!empty($cbc)) {
    $table_results['Patient Detail'] = $cbc;
}




$jsonResponse = json_encode($table_results);

// Send the JSON response
header('Content-Type: application/json');
echo $jsonResponse;


					
								