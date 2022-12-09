<?php
require 'db.php';

if(isset($_POST['abdominal'])){
    $liver = $_POST['liver_res'];
    $gb = $_POST['gb'];
    $bowel = $_POST['bowel'];
    $kid = $_POST['kid'];
    $pel = $_POST['pel'];
    $impression = $_POST['impression'];
    $drname = $_POST['drname'];
    $pat_id = $_POST['pat'];

    $sql = "INSERT INTO `abdominal`(`liver`, `gb`, `bowel`, `kidney`, `pelvic`, `impression`, `drname`, `patient_id`) VALUES 
    (
        '$liver',
        '$gb',
        '$bowel',
        '$kid',
        '$pel',
        '$impression',
        '$drname',
        '$pat_id'
    )";
    $rs = $conn->query($sql);
    if($rs){
        $sql = "DELETE FROM `ultra_cart` WHERE `requests` = 'Abdominal'";
        $rs = $conn->query($sql);
        if($rs){
            header("Location: ../Users/Ultrasound/index.php?search=$pat_id&searching=Search&msg=Sent");
        }else{
            echo $conn->error;
        }
    }else{
        echo "error".$conn->error;
    }
}else if(isset($_POST['breast'])){
    $breast = $_POST['breast_res'];
    $impression = $_POST['impression'];
    $drname = $_POST['drname'];
    $pat_id = $_POST['pat'];

    $sql = "INSERT INTO `breast`(`result`, `impression`, `drname`, `patient_id`) VALUES 
    (
        '$breast',
        '$impression',
        '$drname',
        '$pat_id'
    )";
    $rs = $conn->query($sql);
    if($rs){
        $sql = "DELETE FROM `ultra_cart` WHERE `requests` = 'Breast'";
        $rs = $conn->query($sql);
        if($rs){
            header("Location: ../Users/Ultrasound/index.php?search=$pat_id&searching=Search&msg=Sent");
        }else{
            echo $conn->error;
        }
    }else{
        echo "error".$conn->error;
    }
}else if(isset($_POST['neck'])){
    $neck = $_POST['neck_res'];
    $impression = $_POST['impression'];
    $drname = $_POST['drname'];
    $pat_id = $_POST['pat'];

    $sql = "INSERT INTO `neck`(`result`, `impression`, `drname`, `patient_id`) VALUES 
    (
        '$neck',
        '$impression',
        '$drname',
        '$pat_id'
    )";
    $rs = $conn->query($sql);
    if($rs){
        $sql = "DELETE FROM `ultra_cart` WHERE `requests` = 'Neck'";
        $rs = $conn->query($sql);
        if($rs){
            header("Location: ../Users/Ultrasound/index.php?search=$pat_id&searching=Search&msg=Sent");
        }else{
            echo $conn->error;
        }
    }else{
        echo "error".$conn->error;
    }
}else if(isset($_POST['scrotal'])){
    $scrotal = $_POST['scrotal_res'];
    $impression = $_POST['impression'];
    $drname = $_POST['drname'];
    $pat_id = $_POST['pat'];

    $sql = "INSERT INTO `scrotal`(`result`, `impression`, `drname`, `patient_id`) VALUES 
    (
        '$scrotal',
        '$impression',
        '$drname',
        '$pat_id'
    )";
    $rs = $conn->query($sql);
    if($rs){
        $sql = "DELETE FROM `ultra_cart` WHERE `requests` = 'Scrotal'";
        $rs = $conn->query($sql);
        if($rs){
            header("Location: ../Users/Ultrasound/index.php?search=$pat_id&searching=Search&msg=Sent");
        }else{
            echo $conn->error;
        }
    }else{
        echo "error".$conn->error;
    }
}



?>