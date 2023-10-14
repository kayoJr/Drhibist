<?php
require "db.php";
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];

    $sql = "UPDATE `patient` SET `name`='$name',`age`='$age',`sex`='$sex',`phone`='$phone' WHERE `id` = '$id'";
    if($conn->query($sql)){
        header("Location: ../Users/Doctor/search.php?search=$id&searching=Search&msg=Updated");
    }else{
        echo $conn->error;
    }
}

?>