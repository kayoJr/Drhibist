<?php
require 'db.php';

$id = $_GET['id'];

$sql = $conn->query("DELETE FROM `queue` WHERE `id` = '$id'");

?>