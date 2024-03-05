<?php
require 'db.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    $sql = $conn->query("INSERT INTO `creditproviders`(`name`) VALUES ('$name')");
    if ($sql) {
        header("Location: ../Users/Admin/addCredit.php?msg=Partner Added");
    }
}
