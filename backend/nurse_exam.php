<?php
require './db.php';

if(isset($_POST['add'])){
    $id = $_POST['id'];
    $bp = $_POST['bp'];
    $pr = $_POST['pr'];
    $saturation = $_POST['saturation'];
    $respiratory = $_POST['respiratory'];
    $temp = $_POST['temp'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $head = $_POST['head'];
    $muac = $_POST['muac'];

    $sql = "INSERT INTO `nurse_exam` (`BP`, `PR`, `saturation`, `respiratory`, `temprature`, `height`, `weight`, `head_circum`, `MUAC`, `patient_id`) 
            VALUES('$bp', '$pr', '$saturation', '$respiratory', '$temp', '$height', '$weight', '$head', '$muac', '$id')";
    $res = $conn->query($sql);
    if($res){
        header("Location: ../Users/Nurse/index.php?msg=Successfully Registered");
    }else{
        echo 'error';
    }
}

?>