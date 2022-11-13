<?php
include 'db.php';
$id = $_GET['id'];

$sql = "UPDATE `lab_cart` SET `payment` = 1 WHERE `patient_id` = '$id'";
if($conn->query($sql)){
    header("Location:../Users/Reception/search.php?msg=Payed");
}else{
    echo $conn->error;
}

?>