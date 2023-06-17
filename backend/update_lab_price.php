<?php
    require 'db.php';
    if(isset($_POST['submit'])){
        $id = $_POST['med_id'];
        $price = $_POST['book'];

        $sql = $conn->query("UPDATE `laboratory` SET `price`= $price WHERE `id` = '$id'");

        if($sql){
            header("Location: ../Users/Admin/editPrice.php?msg=Price Updated");
        }
    }
    if(isset($_POST['edit_rec'])){
        $price = $_POST['book'];

        $sql = $conn->query("ALTER TABLE patient MODIFY COLUMN payment int(50) NOT NULL DEFAULT '$price'");

        if($sql){
            header("Location: ../Users/Admin/editPrice.php?msg=Price Updated");
        }
    }

?>