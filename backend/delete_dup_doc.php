<?php
require 'db.php';
$name = $_GET['name'];
$pat = $_GET['pat'];

$sql = $conn->query("DELETE FROM `lab_cart2` WHERE `patient_id` = '$pat' AND `name` = '$name'");
if($sql){
    header("Location: ../Users/Doctor/lab_req.php?id=$pat");
}else{
    echo $conn->error;
}


?>