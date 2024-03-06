<?php
require 'db.php';
$id = $_GET['id'];
$pat = $_GET['pat_id'];

$sql = $conn->query("DELETE FROM `pat_detail` WHERE `id` = '$id'");
if($sql){
    header("Location: ../Users/Doctor/search.php?search=$pat&searching=Search&msg=Deleted");
}else{
    echo $conn->error;
}


?>