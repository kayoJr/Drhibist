<?php
require 'db.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    $sql = $conn->query("INSERT INTO `paymentmethod`(`name`) VALUES ('$name')");
    if ($sql) {
        header("Location: ../Users/Admin/addPayment.php?msg=Payment Added");
    }
}
