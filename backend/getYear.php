<?php
require_once  "./db.php";
$id = $_GET['id'];
// $id = 1500;
$fetchYear = $conn->query(
   "SELECT DISTINCT `date` AS year FROM `cmc_ps`WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `afb_sputum`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `crp`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `bf`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `bg`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `fbs`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `coagulation`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `gram_stain`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `hpylori`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `let`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `lft`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `s/e`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `liver_viral`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `stool`  WHERE `petn_id`='$id'
      UNION
     SELECT DISTINCT `date` AS year FROM `urine`  WHERE `patient_id`='$id'
      UNION
     SELECT DISTINCT `date` AS year FROM `esr`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `pict`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `rft`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `rpr`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `tft`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `uric_acid`  WHERE `patient_id`='$id'
UNION
     SELECT DISTINCT `date` AS year FROM `vdrl`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `weil`  WHERE `patient_id`='$id'
        UNION
     SELECT DISTINCT `date` AS year FROM `widalh`  WHERE `patient_id`='$id'
        UNION
 SELECT DISTINCT `date` AS year FROM `widalo`  WHERE `patient_id`='$id'
        UNION
 SELECT DISTINCT `date` AS year FROM `csf`   WHERE `patient_id`='$id'
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
