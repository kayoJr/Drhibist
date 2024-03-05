<?php
    require '../backend/db.php';
    
    $sql = $conn->query("TRUNCATE TABLE `queue`");
// $date = date('m/d/Y h:i:s a');
// echo $date;
    
    ?>