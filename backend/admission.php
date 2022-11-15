<?php
require 'db.php';
$id = $_GET['id'];
$doc_phone = $_GET['doc'];

$sql = "SELECT * FROM `patient` WHERE `id` = '$id' OR `phone`='$id'";
$res = $conn->query($sql);
while($row = $res->fetch_assoc()){
    $pat_id = $row['id'];
    $pat_phone = $row['phone'];
}

$sql = "INSERT INTO `admission` (`pat_id`, `pat_phone`, `doc_id`) 
        VALUES ('$pat_id', '$pat_phone', '$doc_phone')";
if(!$conn->query($sql)){
    echo $conn->error;
}else{
    header("Location: ../Users/Doctor?msg=Added");
}
?>