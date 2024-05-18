<?php
require "db.php";
$id = $_GET['id'];
$table_name = $_GET['table_name'];
if($table_name == 'income'){
    $delete = $conn->query("DELETE FROM `income` WHERE `id` = '$id'");
if($delete){
    header("Location: ../Users/Admin/index.php?msg=Payment Deleted");
}
}else{
    $delete = $conn->query("DELETE FROM `system_payment` WHERE `id` = '$id'");
if($delete){
    header("Location: ../Users/Admin/index.php?msg=Payment Deleted");
}
}
?>