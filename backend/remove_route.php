<?php
require './db.php';
$id = $_GET['id'];

$sql = $conn->query("DELETE FROM `medroute` WHERE `id` = '$id'");

if($sql){
    header("Location:../Users/Admin/prescription.php?msg=Deleted");
}else{
    echo $conn->error;
}
?>