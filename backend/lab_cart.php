<?php
require './db.php';

// $id = $_GET['rn'];
// $num = $_GET['quant'];
if(isset($_POST['submit'])){
    $id = $_POST['name'];
    $price = $_POST['books'];
    $doc = $_POST['doc'];
    $pat = $_POST['pat'];
    $sql = "INSERT INTO `lab_cart`(`name`, `price`, `patient_id`, `doctor_id`) VALUES ('$id', '$price', '$pat', '$doc')";
    $rs = $conn->query($sql);
    if(!$rs){
        echo $conn->error;
    }else{
        header("Location:../Users/Doctor?msg=Added");
    }
}
