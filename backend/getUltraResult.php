<?php
require_once  "./db.php";
$id = $_GET['id'];
$date = $_GET['year'];

// $id = 1000;
// $date = '2023-02-20';

$table_results = array();
$abdominal = $conn->query("SELECT *, 'abdominal' AS table_name FROM `abdominal` WHERE `patient_id`= '$id' AND `date` = '$date'  ORDER BY `id` DESC");
$neck = $conn->query("SELECT *, 'neck' AS table_name FROM `neck` WHERE `patient_id`='$id' AND `date` = '$date'  ORDER BY `id` DESC");
$breast = $conn->query("SELECT *, 'breast' AS table_name FROM `breast` WHERE `patient_id`='$id' AND `date` = '$date'  ORDER BY `id` DESC");
$normal_brain = $conn->query("SELECT *, 'normal_brain' AS table_name FROM `normal_brain` WHERE `patient_id`='$id' AND `date` = '$date'  ORDER BY `id` DESC");
$other = $conn->query("SELECT *, 'other' AS table_name FROM `other` WHERE `patient_id`='$id' AND `date` = '$date'  ORDER BY `id` DESC");


// $results = array_merge($abdominal, $neck, $breast, $normal_brain, $other, 
// $fbs, $coag, $gram, $hpylori, $let, $se, 
// $liver, $stool, $urine, $esr, $pict,$rft, 
// $rpr, $tft, $uric, $vdrl, $weil, $widalh, $widalo, $csf);
if (!empty($cbc)) {
    
}
if (!empty($abdominal)) {
    $rows = array();
    while ($row = $abdominal->fetch_assoc()) {
        $rows[] = $row;
        $table_results['abdominal'] = $rows;
    }
}
if (!empty($neck)) {
    $rows = array();
    while ($row = $neck->fetch_assoc()) {
        $rows[] = $row;
        $table_results['neck'] = $rows;
    }
}
if (!empty($breast)) {
    $rows = array();
    while ($row = $breast->fetch_assoc()) {
        $rows[] = $row;
        $table_results['breast'] = $rows;
    }
}
if (!empty($normal_brain)) {
    $rows = array();
    while ($row = $normal_brain->fetch_assoc()) {
        $rows[] = $row;
        $table_results['normal_brain'] = $rows;
    }
}
if (!empty($other)) {
    $rows = array();
    while ($row = $other->fetch_assoc()) {
        $rows[] = $row;
        $table_results['other'] = $rows;
    }
}




$jsonResponse = json_encode($table_results);

// Send the JSON response
header('Content-Type: application/json');
echo $jsonResponse;
