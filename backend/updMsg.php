<?php
require 'db.php';

$id = $_POST['id'];
$detail = $_POST['detail'];

$sql = $conn->query("UPDATE `nurse_message` SET `detail` = '$detail' WHERE `id` = '$id'");

?>