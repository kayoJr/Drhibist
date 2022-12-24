<?php
require 'db.php';
$id = $_GET['id'];
$pat = $_GET['pat'];

$sql = $conn->query("DELETE FROM `lab_cart2` WHERE `id` = '$id'");
if($sql){
    header("Location: ../Users/Reception/search.php?search=$pat&searching=Search&msg=Done");
}else{
    echo $conn->error;
}


?>