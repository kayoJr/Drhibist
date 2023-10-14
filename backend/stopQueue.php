<?php
require 'db.php';

$id = $_GET['id'];

$sql = $conn->query("UPDATE `queue` SET `status` = 2 WHERE `id` = '$id'");

?>