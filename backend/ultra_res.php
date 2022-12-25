<?php
require 'db.php';

if(isset($_POST['abdominal'])){
    $liver = $_POST['liver_res'];
    $gb = $_POST['gb'];
    $bowel = $_POST['bowel'];
    $kid = $_POST['kid'];
    $pel = $_POST['pel'];
    $impression = $_POST['impression'];
    $conclusion = $_POST['conclusion'];
    $drname = $_POST['drname'];
    $pat_id = $_POST['pat'];

    $sql = "INSERT INTO `abdominal`(`liver`, `gb`, `bowel`, `kidney`, `pelvic`, `impression`, `conclusion`, `drname`, `patient_id`) VALUES 
    (
        '$liver',
        '$gb',
        '$bowel',
        '$kid',
        '$pel',
        '$impression',
        '$conclusion',
        '$drname',
        '$pat_id'
    )";
    $rs = $conn->query($sql);
    if($rs){
        $sql = "DELETE FROM `ultra_cart` WHERE `requests` = 'Abdominal' AND `patient_id` = '$pat_id'";
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
    $conclusion = $_POST['conclusion'];

    $drname = $_POST['drname'];
    $pat_id = $_POST['pat'];

    $sql = "INSERT INTO `breast`(`result`, `impression`,`conclusion`, `drname`, `patient_id`) VALUES 
    (
        '$breast',
        '$impression',
        '$conclusion',
        '$drname',
        '$pat_id'
    )";
    $rs = $conn->query($sql);
    if($rs){
        $sql = "DELETE FROM `ultra_cart` WHERE `requests` = 'Chest' AND `patient_id` = '$pat_id'";
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
    $conclusion = $_POST['conclusion'];
    $drname = $_POST['drname'];
    $pat_id = $_POST['pat'];

    $sql = "INSERT INTO `neck`(`result`, `impression`,`conclusion`, `drname`, `patient_id`) VALUES 
    (
        '$neck',
        '$impression',
        '$conclusion',
        '$drname',
        '$pat_id'
    )";
    $rs = $conn->query($sql);
    if($rs){
        $sql = "DELETE FROM `ultra_cart` WHERE `requests` = 'Neck' AND `patient_id` = '$pat_id'";
        $rs = $conn->query($sql);
        if($rs){
            header("Location: ../Users/Ultrasound/index.php?search=$pat_id&searching=Search&msg=Sent");
        }else{
            echo $conn->error;
        }
    }else{
        echo "error".$conn->error;
    }
    $impression = $_POST['impression'];
    $conclusion = $_POST['conclusion'];
    $drname = $_POST['drname'];
    $pat_id = $_POST['pat'];

    $sql = "INSERT INTO `neck`(`result`, `impression`, `conclusion`, `drname`, `patient_id`) VALUES 
    (
        '$scrotal',
        '$impression',
        '$conclusion',
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
    $conclusion = $_POST['conclusion'];
    $drname = $_POST['drname'];
    $pat_id = $_POST['pat'];

    $sql = "INSERT INTO `normal_brain`(`result`, `impression`, `conclusion`, `drname`, `patient_id`) VALUES 
    (
        '$scrotal',
        '$impression',
        '$conclusion',
        '$drname',
        '$pat_id'
    )";
    $rs = $conn->query($sql);
    if($rs){
        $sql = "DELETE FROM `ultra_cart` WHERE `requests` = 'normal_brain' AND `patient_id` = '$pat_id'";
        $rs = $conn->query($sql);
        if($rs){
            header("Location: ../Users/Ultrasound/index.php?search=$pat_id&searching=Search&msg=Sent");
        }else{
            echo $conn->error;
        }
    }else{
        echo "error".$conn->error;
    }
}else if(isset($_POST['other'])){
    $other = $_POST['other_res'];
    $impression = $_POST['impression'];
    $conclusion = $_POST['conclusion'];
    $drname = $_POST['drname'];
    $pat_id = $_POST['pat'];

    $sql = "INSERT INTO `other`(`result`, `impression`, `conclusion`, `drname`, `patient_id`) VALUES 
    (
        '$other',
        '$impression',
        '$conclusion',
        '$drname',
        '$pat_id'
    )";
    $rs = $conn->query($sql);
    if($rs){
        $sql = "DELETE FROM `ultra_cart` WHERE `requests` = 'other' AND `patient_id` = '$pat_id'";
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