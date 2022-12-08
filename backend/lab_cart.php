<?php
require './db.php';

// $id = $_GET['rn'];
// $num = $_GET['quant'];
if (isset($_POST['submit'])) {
    $pat = $_POST['pat'];
    $chems = $_POST['chem'];
    $labs = $_POST['lab'];
    $specials = $_POST['special'];
    $serology = $_POST['sero'];
    if (isset($_POST['lab'])) {
        foreach ($labs as $lab) {
            $sql = "INSERT INTO `lab_cart`(`name`, `patient_id`) VALUES ('$lab', '$pat')";
            $rs = $conn->query($sql);
            if (!$rs) {
                echo $conn->error;
            } else {
                header("Location:../Users/Doctor/index.php?msg=Done&search=$pat&searching=Search");
            }
        }
    }
    if(isset($_POST['chem'])){
        foreach ($chems as $chem){
            $sql = "INSERT INTO `chem_req`(`name`, `patient_id`) VALUES ('$chem', '$pat')";
            $res = $conn->query($sql);
            if(!$res){
                echo $conn->error;
            }else{
                header("Location:../Users/Doctor/index.php?msg=Done&search=$pat&searching=Search");
            }
        }
    }
    if(isset($_POST['sero'])){
        foreach ($serology as $sero){
            $sql = "INSERT INTO `sero_req`(`name`, `patient_id`) VALUES ('$sero', '$pat')";
            $res = $conn->query($sql);
            if(!$res){
                echo $conn->error;
            }else{
                header("Location:../Users/Doctor/index.php?msg=Done&search=$pat&searching=Search");
            }
        }
    }
    if(isset($_POST['special'])){
        foreach ($specials as $special){
            $sql = "INSERT INTO `special_req`(`name`, `patient_id`) VALUES ('$special', '$pat')";
            $res = $conn->query($sql);
            if(!$res){
                echo $conn->error;
            }else{
                header("Location:../Users/Doctor/index.php?msg=Done&search=$pat&searching=Search");
            }
        }
    }


    // $id = $_POST['name'];
    // $price = $_POST['books'];
    // $doc = $_POST['doc'];
    // $sql = "INSERT INTO `lab_cart`(`name`, `price`, `patient_id`, `doctor_id`) VALUES ('$id', '$price', '$pat', '$doc')";
    // $rs = $conn->query($sql);
    // if(!$rs){
    //     echo $conn->error;
    // }else{
    //     header("Location:../Users/Doctor/index.php?search=$pat&searching=Search");
    // }

}
