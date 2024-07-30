<?php
require "db.php";
$id = $_GET['id'];
$phone_user = $_GET['user'];
$pat_id = $_GET['pat_id'];
$sql = "DELETE FROM `prescart` WHERE `id` = '$id' AND `user_id` = '$phone_user'";
$res = $conn->query($sql);
if ($res) {
    header("Location: ../Users/Doctor/prescription.php?msg=Deleted&id=" . $pat_id);
} else {
    header("Location: ./Users/Doctor/prescription.php?err=Failed to Delete&id=" . $pat_id);
}
