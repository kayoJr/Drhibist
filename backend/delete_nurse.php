<?php
require "db.php";
$id = $_GET['rn'];
$pat_id = $_GET['id'];

$sql = "DELETE FROM `nurse_exam` WHERE `id` = '$id'";
$res = $conn->query($sql);
if($res){
    header("Location: ../Users/Doctor/index.php?search=$pat_id&searching=Search&msg=Deleted");

}else{
    header("Location: ../Users/Doctor/index.php?search=$pat_id&searching=Search&msg=Not Deleted");
}

?> 