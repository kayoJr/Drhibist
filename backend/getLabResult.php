<?php
require_once  "./db.php";
$id = $_GET['id'];
$date = $_GET['year'];

// $id = 1000;
// $date = '2023-02-20';

$table_results = array();
$cbc = $conn->query("SELECT *, 'cmc_ps' AS table_name FROM `cmc_ps` WHERE `patient_id`= '$id' AND `date` = '$date'")->fetch_assoc();
$afb = $conn->query("SELECT *, 'afb_sputum' AS table_name FROM `afb_sputum` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$crp = $conn->query("SELECT *, 'crp' AS table_name FROM `crp` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$bf = $conn->query("SELECT *, 'bf' AS table_name FROM `bf` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$bg = $conn->query("SELECT *, 'bg' AS table_name FROM `bg` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$fbs = $conn->query("SELECT *, 'fbs' AS table_name FROM `fbs` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$coag = $conn->query("SELECT *, 'coagulation' AS table_name FROM `coagulation` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$gram = $conn->query("SELECT *, 'gram_stain' AS table_name FROM `gram_stain` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$hpylori = $conn->query("SELECT *, 'hpylori' AS table_name FROM `hpylori` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$hpylori_ag = $conn->query("SELECT *, 'hylori_ag' AS table_name FROM `hylori_ag` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$let = $conn->query("SELECT *, 'let' AS table_name FROM `let` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$lft = $conn->query("SELECT *, 'lft' AS table_name FROM `lft` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$se = $conn->query("SELECT *, 's/e' AS table_name FROM `s/e` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$liver = $conn->query("SELECT *, 'liver_viral' AS table_name FROM `liver_viral` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$stool = $conn->query("SELECT *, 'stool' AS table_name FROM `stool` WHERE `petn_id`='$id' AND `date` = '$date'")->fetch_assoc();
$urine = $conn->query("SELECT *, 'urine' AS table_name FROM `urine` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$esr = $conn->query("SELECT *, 'esr' AS table_name FROM `esr` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$pict = $conn->query("SELECT *, 'pict' AS table_name FROM `pict` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$rft = $conn->query("SELECT *, 'rft' AS table_name FROM `rft` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$rpr = $conn->query("SELECT *, 'rpr' AS table_name FROM `rpr` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$tft = $conn->query("SELECT *, 'tft' AS table_name FROM `tft` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$uric = $conn->query("SELECT *, 'uric_acid' AS table_name FROM `uric_acid` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$vdrl = $conn->query("SELECT *, 'vdrl' AS table_name FROM `vdrl` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$weil = $conn->query("SELECT *, 'weil' AS table_name FROM `weil` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$widalh = $conn->query("SELECT *, 'widalh' AS table_name FROM `widalh` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$widalo = $conn->query("SELECT *, 'widalo' AS table_name FROM `widalo` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();
$csf = $conn->query("SELECT *, 'csf' AS table_name FROM `csf` WHERE `patient_id`='$id' AND `date` = '$date'")->fetch_assoc();

// $results = array_merge($cbc, $afb, $crp, $bf, $bg, 
// $fbs, $coag, $gram, $hpylori, $let, $se, 
// $liver, $stool, $urine, $esr, $pict,$rft, 
// $rpr, $tft, $uric, $vdrl, $weil, $widalh, $widalo, $csf);

if (!empty($cbc)) {
    $table_results['cbc'] = $cbc;
}
if (!empty($afb)) {
    $table_results['afb'] = $afb;
}
if (!empty($crp)) {
    $table_results['crp'] = $crp;
}
if (!empty($bf)) {
    $table_results['bf'] = $bf;
}
if (!empty($bg)) {
    $table_results['bg'] = $bg;
}
if (!empty($fbs)) {
    $table_results['fbs'] = $fbs;
}
if (!empty($coag)) {
    $table_results['coag'] = $coag;
}
if (!empty($gram)) {
    $table_results['gram'] = $gram;
}
if (!empty($hpylori)) {
    $table_results['hpylori'] = $hpylori;
}
if (!empty($hpylori_ag)) {
    $table_results['hylori_ag'] = $hpylori_ag;
}
if (!empty($let)) {
    $table_results['let'] = $let;
}
if (!empty($lft)) {
    $table_results['lft'] = $lft;
}
if (!empty($se)) {
    $table_results['se'] = $se;
}
if (!empty($liver)) {
    $table_results['liver'] = $liver;
}
if (!empty($stool)) {
    $table_results['stool'] = $stool;
}
if (!empty($urine)) {
    $table_results['urine'] = $urine;
}
if (!empty($esr)) {
    $table_results['esr'] = $esr;
}
if (!empty($pict)) {
    $table_results['pict'] = $pict;
}
if (!empty($rft)) {
    $table_results['rft'] = $rft;
}
if (!empty($rpr)) {
    $table_results['rpr'] = $rpr;
}
if (!empty($tft)) {
    $table_results['tft'] = $tft;
}
if (!empty($uric)) {
    $table_results['uric'] = $uric;
}
if (!empty($vdrl)) {
    $table_results['vdrl'] = $vdrl;
}
if (!empty($weil)) {
    $table_results['weil'] = $weil;
}
if (!empty($widalh)) {
    $table_results['widalh'] = $widalh;
}
if (!empty($csf)) {
    $table_results['csf'] = $csf;
}
if (!empty($widalo)) {
    $table_results['widalo'] = $widalo;
}



$jsonResponse = json_encode($table_results);

// Send the JSON response
header('Content-Type: application/json');
echo $jsonResponse;
