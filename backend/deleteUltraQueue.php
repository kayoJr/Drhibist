<?php
require 'db.php';

$id = $_GET['id'];

$sql = $conn->query("DELETE FROM `ultraqueue` WHERE `id` = '$id'");

?>