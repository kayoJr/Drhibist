<?php
require 'db.php';
// session_start();
// global $conn;

if(isset($_POST['add_pat'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];
    $payment = $_POST['payment'];

    $sql = "INSERT INTO `patient`(`name`, `age`, `sex`, `phone`) 
            VALUES ('$name', '$age', '$sex', $phone)";
    $res = $conn->query($sql);
    
    if($res){
        if($payment == "system"){
            $sql = "INSERT INTO `system_payment` (`price`) VALUES (100)";
            if(!$conn->query($sql)){
                echo $conn->error;
            }else{
                header("Location: ../Users/Reception/index.php?msg=Patient Added");
            }
        }else{
            header("Location: ../Users/Reception/index.php?msg=Patient Added");
        }
    }else{
        header("Location: ../Users/Reception/index.php?err=Patient Not Added");
    }
    
}

?>