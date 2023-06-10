<?php
require 'db.php';
$name = $_GET['name'];
$pat = $_GET['pat'];

$sql = $conn->query("DELETE FROM `ultra_cart` WHERE `patient_id` = '$pat' AND `requests` = '$name'");
if($sql){
    header("Location: ../Users/Doctor/ultrareq.php?id=$pat");
}else{
    echo $conn->error;
}


?>