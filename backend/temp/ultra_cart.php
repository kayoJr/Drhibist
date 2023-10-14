<?php
require './db.php';

if (isset($_POST['submit'])) {
    $pat = $_POST['pat'];
    $brands = $_POST['brands'];
    //$detail = $_POST['det'];
    $abdo = $_POST['abdo'];
    $breast = $_POST['chest'];
    $neck = $_POST['neck'];
    $nb_det = $_POST['nb_det'];
    $other_det = $_POST['other_det'];
    $detail = '';
    foreach ($brands as $brand) {
        // foreach ($detail as $det ){
        //     array_push($ultra, $brand, $det);
        //     print_r($ultra);
        // }
        if($brand == 'Abdominal'){
            $detail = $abdo;
        }if($brand == 'Chest'){
            $detail = $breast;
        }if($brand == 'Neck'){
            $detail = $neck;
        }if($brand == 'normal_brain'){
            $detail = $nb_det;
        }if($brand == 'other'){
            $detail = $other_det;
        }
        
            $sql = "INSERT INTO `ultra_cart`(`requests`,`detail`, `patient_id`) VALUES ('$brand','$detail', '$pat')";
            $rs = $conn->query($sql);
            if (!$rs) {
                echo $conn->error;
            } else {
                header("Location:../Users/search/index.php?msg=Done&search=$pat&searching=Search");
            }
    }
}
