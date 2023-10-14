<?php
    require './db.php';
    $getRows = $conn->query("SELECT * FROM `ultraqueue`");

    echo $getRows->num_rows;
?>