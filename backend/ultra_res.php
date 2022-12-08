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
}



?>