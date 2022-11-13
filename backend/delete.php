<?php
require "db.php";
$id = $_GET['id'];

$sql = "DELETE FROM `users` WHERE `id` = '$id'";
$res = $conn->query($sql);
if($res){
    header("Location: ../Users/Admin/user.php?msg=Deleted");
}else{
    header("Location: ./Users/Admin/user.php?err=Failed to Delete");
}

?> 