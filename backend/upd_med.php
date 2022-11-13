<?php
require "db.php";
if(isset($_POST['upd_med'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $org_price = $_POST['org_price'];
    $sell_price = $_POST['sell_price'];
    $reg_date = $_POST['reg_date'];
    $exp_date = $_POST['id'];

    $sql = "UPDATE `medicine` SET `name`='$name',`type`='$type',`amount`='$amount',`org_price`='$org_price',`sell_price`='$sell_price',`reg_date`='$reg_date',`exp_date`='$exp_date' WHERE `id` = '$id'";
    if($conn->query($sql)){
        header("Location: ../Users/Admin/pharmacy.php?msg=Updated");
    }else{
        echo $conn->error;
    }
}

?>