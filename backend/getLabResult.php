<?php
require_once  "./db.php";
$id = $_GET['id'];
$date = $_GET['year'];

// $id = 1000;
// $date = '2023-02-20';

$table_results = array();
$cbc = $conn->query("SELECT *, 'cmc_ps' AS table_name FROM `cmc_ps` WHERE `patient_id`= '$id' AND `date` = '$date' ORDER BY `id` DESC");
$cbc_new = $conn->query("SELECT *, 'cbc' AS table_name FROM `cbc` WHERE `patient_id`= '$id' AND `date` = '$date' ORDER BY `id` DESC");
$afb = $conn->query("SELECT *, 'afb_sputum' AS table_name FROM `afb_sputum` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$crp = $conn->query("SELECT *, 'crp' AS table_name FROM `crp` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$bf = $conn->query("SELECT *, 'bf' AS table_name FROM `bf` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$bg = $conn->query("SELECT *, 'bg' AS table_name FROM `bg` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$fbs = $conn->query("SELECT *, 'fbs' AS table_name FROM `fbs` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$coag = $conn->query("SELECT *, 'coagulation' AS table_name FROM `coagulation` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$gram = $conn->query("SELECT *, 'gram_stain' AS table_name FROM `gram_stain` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$hpylori = $conn->query("SELECT *, 'hpylori' AS table_name FROM `hpylori` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$hpylori_ag = $conn->query("SELECT *, 'hylori_ag' AS table_name FROM `hylori_ag` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$let = $conn->query("SELECT *, 'let' AS table_name FROM `let` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$lft = $conn->query("SELECT *, 'lft' AS table_name FROM `lft` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$se = $conn->query("SELECT *, 's/e' AS table_name FROM `s/e` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$liver = $conn->query("SELECT *, 'liver_viral' AS table_name FROM `liver_viral` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$stool = $conn->query("SELECT *, 'stool' AS table_name FROM `stool` WHERE `petn_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$urine = $conn->query("SELECT *, 'urine' AS table_name FROM `urine` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$esr = $conn->query("SELECT *, 'esr' AS table_name FROM `esr` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$pict = $conn->query("SELECT *, 'pict' AS table_name FROM `pict` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$rft = $conn->query("SELECT *, 'rft' AS table_name FROM `rft` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$rpr = $conn->query("SELECT *, 'rpr' AS table_name FROM `rpr` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$tft = $conn->query("SELECT *, 'tft' AS table_name FROM `tft` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$uric = $conn->query("SELECT *, 'uric_acid' AS table_name FROM `uric_acid` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$vdrl = $conn->query("SELECT *, 'vdrl' AS table_name FROM `vdrl` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$weil = $conn->query("SELECT *, 'weil' AS table_name FROM `weil` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$widalh = $conn->query("SELECT *, 'widalh' AS table_name FROM `widalh` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$widalo = $conn->query("SELECT *, 'widalo' AS table_name FROM `widalo` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$csf = $conn->query("SELECT *, 'csf' AS table_name FROM `csf` WHERE `patient_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");
$bfa = $conn->query("SELECT *, 'blood_fs' AS table_name FROM `bfa` WHERE `pat_id`='$id' AND `date` = '$date' ORDER BY `id` DESC");

// $results = array_merge($cbc, $afb, $crp, $bf, $bg, 
// $fbs, $coag, $gram, $hpylori, $let, $se, 
// $liver, $stool, $urine, $esr, $pict,$rft, 
// $rpr, $tft, $uric, $vdrl, $weil, $widalh, $widalo, $csf);

if (!empty($bfa)) {
    $rows = array();
    while ($row = $bfa->fetch_assoc()
    ) {
        $rows[] = $row;
        $table_results['blood_fs'] = $rows;
    }
}
// if (!empty($cbc)) {
//     while($cbc){
//         $table_results['cbc'] = $cbc;
//     }
// }
if (!empty($cbc)) {
    $rows = array();
    while ($row = $cbc->fetch_assoc()) {
        $rows[] = $row;
        $table_results['cbc'] = $rows;
    }
}
if (!empty($cbc_new)) {
    $rows = array();
    while ($row = $cbc_new->fetch_assoc()) {
        $rows[] = $row;
        $table_results['cbc_new'] = $rows;
    }
}
// $table_results['hematology'] = $hematology = [
//     "hematology" =>[
//         "cbc" =>$cbc_rows,
//         "cbc_new" =>$cbc_new_rows
//     ]
//     ];

// if (!empty($afb)) {
//     $table_results['afb'] = $afb;
// }
if (!empty($afb)) {
    $rows = array();
    while ($row = $afb->fetch_assoc()) {
        $rows[] = $row;
        $table_results['afb'] = $rows;
    }
}
// if (!empty($crp)) {
//     $table_results['crp'] = $crp;
// }
if (!empty($crp)) {
    $rows = array();
    while ($row = $crp->fetch_assoc()) {
        $rows[] = $row;
        $table_results['crp'] = $rows;
    }
}
// if (!empty($bf)) {
//     $table_results['bf'] = $bf;
// }
if (!empty($bf)) {
    $rows = array();
    while ($row = $bf->fetch_assoc()) {
        $rows[] = $row;
        $table_results['bf'] = $rows;
    }
}
// if (!empty($bg)) {
//     $table_results['bg'] = $bg;
// }
if (!empty($bg)) {
    $rows = array();
    while ($row = $bg->fetch_assoc()) {
        $rows[] = $row;
        $table_results['bg'] = $rows;
    }
}
// if (!empty($fbs)) {
//     $table_results['fbs'] = $fbs;
// }
if (!empty($fbs)) {
    $rows = array();
    while ($row = $fbs->fetch_assoc()) {
        $rows[] = $row;
        $table_results['fbs'] = $rows;
    }
}
// if (!empty($coag)) {
//     $table_results['coag'] = $coag;
// }
if (!empty($coag)) {
    $rows = array();
    while ($row = $coag->fetch_assoc()) {
        $rows[] = $row;
        $table_results['coag'] = $rows;
    }
}
// if (!empty($gram)) {
//     $table_results['gram'] = $gram;
// }
if (!empty($gram)) {
    $rows = array();
    while ($row = $gram->fetch_assoc()) {
        $rows[] = $row;
        $table_results['gram'] = $rows;
    }
}
// if (!empty($hpylori)) {
//     $table_results['hpylori'] = $hpylori;
// }
if (!empty($hpylori)) {
    $rows = array();
    while ($row = $hpylori->fetch_assoc()) {
        $rows[] = $row;
        $table_results['hpylori'] = $rows;
    }
}
// if (!empty($hpylori_ag)) {
//     $table_results['hylori_ag'] = $hpylori_ag;
// }
if (!empty($hpylori_ag)) {
    $rows = array();
    while ($row = $hpylori_ag->fetch_assoc()) {
        $rows[] = $row;
        $table_results['hpylori_ag'] = $rows;
    }
}
// if (!empty($let)) {
//     $table_results['let'] = $let;
// }
if (!empty($let)) {
    $rows = array();
    while ($row = $let->fetch_assoc()) {
        $rows[] = $row;
        $table_results['let'] = $rows;
    }
}
// if (!empty($lft)) {
//     $table_results['lft'] = $lft;
// }
if (!empty($lft)) {
    $rows = array();
    while ($row = $lft->fetch_assoc()) {
        $rows[] = $row;
        $table_results['lft'] = $rows;
    }
}
// if (!empty($se)) {
//     $table_results['se'] = $se;
// }
if (!empty($se)) {
    $rows = array();
    while ($row = $se->fetch_assoc()) {
        $rows[] = $row;
        $table_results['se'] = $rows;
    }
}
// if (!empty($liver)) {
//     $table_results['liver'] = $liver;
// }
if (!empty($liver)) {
    $rows = array();
    while ($row = $liver->fetch_assoc()) {
        $rows[] = $row;
        $table_results['liver'] = $rows;
    }
}
// if (!empty($stool)) {
//     $table_results['stool'] = $stool;
// }
if (!empty($stool)) {
    $rows = array();
    while ($row = $stool->fetch_assoc()) {
        $rows[] = $row;
        $table_results['stool'] = $rows;
    }
}
// if (!empty($urine)) {
//     $table_results['urine'] = $urine;
// }
if (!empty($urine)) {
    $rows = array();
    while ($row = $urine->fetch_assoc()) {
        $rows[] = $row;
        $table_results['urine'] = $rows;
    }
}
// if (!empty($esr)) {
//     $table_results['esr'] = $esr;
// }
if (!empty($esr)) {
    $rows = array();
    while ($row = $esr->fetch_assoc()) {
        $rows[] = $row;
        $table_results['esr'] = $rows;
    }
}
// if (!empty($pict)) {
//     $table_results['pict'] = $pict;
// }
if (!empty($pict)) {
    $rows = array();
    while ($row = $pict->fetch_assoc()) {
        $rows[] = $row;
        $table_results['pict'] = $rows;
    }
}
// if (!empty($rft)) {
//     $table_results['rft'] = $rft;
// }
if (!empty($rft)) {
    $rows = array();
    while ($row = $rft->fetch_assoc()) {
        $rows[] = $row;
        $table_results['rft'] = $rows;
    }
}
// if (!empty($rpr)) {
//     $table_results['rpr'] = $rpr;
// }
if (!empty($rpr)) {
    $rows = array();
    while ($row = $rpr->fetch_assoc()) {
        $rows[] = $row;
        $table_results['rpr'] = $rows;
    }
}
// if (!empty($tft)) {
//     $table_results['tft'] = $tft;
// }
if (!empty($tft)) {
    $rows = array();
    while ($row = $tft->fetch_assoc()) {
        $rows[] = $row;
        $table_results['tft'] = $rows;
    }
}
// if (!empty($uric)) {
//     $table_results['uric'] = $uric;
// }
if (!empty($uric)) {
    $rows = array();
    while ($row = $uric->fetch_assoc()) {
        $rows[] = $row;
        $table_results['uric'] = $rows;
    }
}
// if (!empty($vdrl)) {
//     $table_results['vdrl'] = $vdrl;
// }
if (!empty($vdrl)) {
    $rows = array();
    while ($row = $vdrl->fetch_assoc()) {
        $rows[] = $row;
        $table_results['vdrl'] = $rows;
    }
}
// if (!empty($weil)) {
//     $table_results['weil'] = $weil;
// }
if (!empty($weil)) {
    $rows = array();
    while ($row = $weil->fetch_assoc()) {
        $rows[] = $row;
        $table_results['weil'] = $rows;
    }
}
// if (!empty($widalh)) {
//     $table_results['widalh'] = $widalh;
// }
if (!empty($widalh)) {
    $rows = array();
    while ($row = $widalh->fetch_assoc()) {
        $rows[] = $row;
        $table_results['widalh'] = $rows;
    }
}
// if (!empty($csf)) {
//     $table_results['csf'] = $csf;
// }
if (!empty($csf)) {
    $rows = array();
    while ($row = $csf->fetch_assoc()) {
        $rows[] = $row;
        $table_results['csf'] = $rows;
    }
}
// if (!empty($widalo)) {
//     $table_results['widalo'] = $widalo;
// }
if (!empty($widalo)) {
    $rows = array();
    while ($row = $widalo->fetch_assoc()) {
        $rows[] = $row;
        $table_results['widalo'] = $rows;
    }
}




$jsonResponse = json_encode($table_results);

// Send the JSON response
header('Content-Type: application/json');
echo $jsonResponse;
