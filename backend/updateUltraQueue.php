<?php
require 'db.php';

$id = $_GET['id'];

$sql = $conn->query("UPDATE `ultraqueue` SET `status` = 1 WHERE `id` = '$id'");

?>