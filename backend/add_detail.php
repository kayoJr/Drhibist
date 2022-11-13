<?php
require 'db.php';
if(isset($_POST['submit'])){
    $text = $_POST['detail'];
    $id = $_POST['pat_id'];
    $sql = "INSERT INTO `pat_detail`(`detail`, `pat_id`) 
            VALUES ('$text', '$id')";
    $res = $conn->query($sql);
    if($res){
        header("Location: ../Users/Doctor/index.php?msg=Done&search=$id&searching=Search");
    }else{
        header("Location: ../Users/Doctor/index.php?msg=Error&search=$id&searching=Search");
    }
}

?>