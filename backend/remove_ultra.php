
// require "db.php";
// $id = $_GET['id'];
// $delete = $conn->query("DELETE FROM `income` WHERE `id` = '$id'");
// $delete = $conn->query("DELETE FROM `ultraqueue` WHERE `ultraId` = '$id'");
// if ($delete) {
//     header("Location: ../Users/Admin/index.php?msg=Payment Deleted");
// }


<?php
require "db.php";
$id = $_GET['id'];
$table_name = $_GET['table'];
if ($table_name == 'income') {
    $delete = $conn->query("DELETE FROM `income` WHERE `id` = '$id'");
    $delete = $conn->query("DELETE FROM `ultraqueue` WHERE `ultraId` = '$id'");
    if ($delete) {
        header("Location: ../Users/Admin/index.php?msg=Payment Deleted");
    }
} else {
    $delete = $conn->query("DELETE FROM `admission_pay` WHERE `id` = '$id'");
    $delete = $conn->query("DELETE FROM `ultraqueue` WHERE `ultraId` = '$id'");
    if ($delete) {
        header("Location: ../Users/Admin/index.php?msg=Payment Deleted");
    }
}
?>