<?php
require "db.php";
$id = $_GET['id'];
$delete = $conn->query("DELETE FROM `creditProviders` WHERE `id` = '$id'");
if($delete){
    header("Location: ../Users/Admin/addCredit.php?msg=Partner Deleted");
}

?>