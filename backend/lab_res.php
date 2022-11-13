<?php
require './db.php';

if(isset($_POST['submit'])){
    $wbc = $_POST['wbc'];
    $lymph_num = $_POST['lymph#'];
    $mid_num = $_POST['mid#'];
    $gran_num = $_POST['gran#'];
    $lymph_per = $_POST['lymph%'];
    $mid_per = $_POST['mid%'];
    $gran_per = $_POST['gran%'];
    $hgb = $_POST['hgb'];
    $rbc = $_POST['rbc'];
    $xxx = $_POST['xxx'];
    $mcv = $_POST['mcv'];
    $mch = $_POST['mch'];
    $mchc = $_POST['mchc'];
    $rdw_cv = $_POST['rdw-cv'];
    $rdw_sd = $_POST['rdw-sd'];
    $plt = $_POST['plt'];
    $mpv = $_POST['mpv'];
    $pdw = $_POST['pdw'];
    $pct = $_POST['pct'];
    $pat_id = $_POST['pat_id'];

    $sql = "INSERT INTO `lab_res`(`WBC`, `Lymph#`, `Mid#`, `Gran#`, `Lymph%`, `Mid%`, `Gran%`, `HGB`, `RBC`, `XXX`, `MCV`, `MCH`, `MCHC`, `RDW-CV`, `RDW-SD`, `PLT`, `MPV`, `PDW`, `PCT`, `pat_id`) 
            VALUES ('$wbc', '$lymph_num', '$mid_num', '$gran_num', '$lymph_per', '$mid_per', '$gran_per', '$hgb', '$rbc', '$xxx', '$mcv', '$mch', '$mchc', '$rdw_cv', '$rdw_sd', '$plt', '$mpv', '$pdw', '$pct', '$pat_id')";
    $rs = $conn->query($sql);
    if($rs){
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
    }else{  
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
    }
}

?>