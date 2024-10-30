<?php
require "db.php";
$id = $_GET['id'];
$delete = $conn->query("DELETE FROM `cbc` WHERE `id` = '$id'");
if($delete){
    header("Location: ../Users/Admin/removeLab.php?msg=Lab Result Deleted");
}

?>