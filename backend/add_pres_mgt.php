<?php
require './db.php';
if (isset($_POST['submitRoute'])) {
    $name = $_POST['name'];
    $sql = $conn->query("INSERT INTO `medroute` (`name`) VALUES ('$name')");
    if($sql){
        header("Location: ../Users/Admin/prescription.php?msg=Route Added");
    } else {
        echo $conn->error;
    }
} else if (isset($_POST['submitFreq'])) {
    $name = $_POST['name'];
    $sql = $conn->query("INSERT INTO `dosage` (`name`) VALUES ('$name')");
    if($sql){
        header("Location:../Users/Admin/prescription.php?msg=Frequency Added");
    } else {
        echo $conn->error;
    }
}
