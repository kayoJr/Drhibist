<?php
require "db.php";
$id = $_GET['id'];
$delete = $conn->query("DELETE FROM `income` WHERE `id` = '$id'");
if($delete){
    header("Location: ../Users/Admin/index.php?msg=Payment Deleted");
}
?>