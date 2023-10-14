<?php
require 'db.php';
if(isset($_POST['submit'])){
    $price = $_POST['proc'];
    $pat_id = $_POST['pat'];

    $sql = "INSERT INTO `procedure` (`patient_id`, `price`) VALUES ('$pat_id', '$price')";
    $rs = $conn->query($sql);
    if($rs){
        header("Location: ../Users/Doctor/search.php?search=$pat_id&searching=Search&msg=Done");
    }else{
        echo $conn->error;
    }
}


?>