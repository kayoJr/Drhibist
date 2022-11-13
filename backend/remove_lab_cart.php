<?php
require "db.php";
$id = $_GET['rn'];
$sql = "DELETE * FROM `lab_cart` WHERE `id` = '$id'";
if(!$conn->query($sql)){
    echo $conn->error;
}else{
    header("Location:../Users/Doctor?msg=Deleted");
}

?>