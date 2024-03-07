<?php
require_once  "./db.php";
$id = $_GET['id'];
$date = $_GET['year'];

// $id = 1000;
// $date = '2023-02-20';

$table_results = array();
$abdominal = $conn->query("SELECT *, 'abdominal' AS table_name FROM `abdominal` WHERE `patient_id`= '$id' AND `date` = '$date'")->fetch_assoc();
$neck = $conn->query("SELECT *, 'neck' AS table_name FROM `neck` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$breast = $conn->query("SELECT *, 'breast' AS table_name FROM `breast` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$normal_brain = $conn->query("SELECT *, 'normal_brain' AS table_name FROM `normal_brain` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$other = $conn->query("SELECT *, 'other' AS table_name FROM `other` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();


// $results = array_merge($abdominal, $neck, $breast, $normal_brain, $other, 
// $fbs, $coag, $gram, $hpylori, $let, $se, 
// $liver, $stool, $urine, $esr, $pict,$rft, 
// $rpr, $tft, $uric, $vdrl, $weil, $widalh, $widalo, $csf);

if (!empty($abdominal)) {
    $table_results['abdominal'] = $abdominal;
}
if (!empty($neck)) {
    $table_results['neck'] = $neck;
}
if (!empty($breast)) {
    $table_results['breast'] = $breast;
}
if (!empty($normal_brain)) {
    $table_results['normal_brain'] = $normal_brain;
}
if (!empty($other)) {
    $table_results['other'] = $other;
}




$jsonResponse = json_encode($table_results);

// Send the JSON response
header('Content-Type: application/json');
echo $jsonResponse;
