<?php
require 'db.php';
if(isset($_POST['adm_det'])){
    $id = $_POST['id'];
    $detail = $_POST['adm_detail'];

    $sql = "INSERT INTO `nurse_message` (`detail`, `patient_id`) VALUES ('$detail', '$id')";
    $rs = $conn->query($sql);
    if($rs){
        header("Location: ../Users/Doctor?msg=Done");
    }else{
        echo $conn->error;
    }
}


?>