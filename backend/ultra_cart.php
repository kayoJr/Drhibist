<?php
require './db.php';

if (isset($_POST['submit'])) {
    $pat = $_POST['pat'];
    $brands = $_POST['brands'];
    //$detail = $_POST['det'];
    $abdo = $_POST['abdo'];
    $breast = $_POST['breast'];
    $neck = $_POST['neck'];
    $scrotal_det = $_POST['scrotal_det'];
    $detail = '';
    foreach ($brands as $brand) {
        // foreach ($detail as $det ){
        //     array_push($ultra, $brand, $det);
        //     print_r($ultra);
        // }
        if($brand == 'Abdominal'){
            $detail = $abdo;
        }if($brand == 'Breast'){
            $detail = $breast;
        }if($brand == 'Neck'){
            $detail = $neck;
        }if($brand == 'Scrotal'){
            $detail = $scrotal;
        }
        
            $sql = "INSERT INTO `ultra_cart`(`requests`,`detail`, `patient_id`) VALUES ('$brand','$detail', '$pat')";
            $rs = $conn->query($sql);
            if (!$rs) {
                echo $conn->error;
            } else {
                header("Location:../Users/Doctor/index.php?msg=Done&search=$pat&searching=Search");
            }
    }
}
