<?php
    require './db.php';
    $getRows = $conn->query("SELECT * FROM `queue`");

    echo $getRows->num_rows;
?>