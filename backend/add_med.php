<?php
require_once "db.php";

if(isset($_POST['add_med'])){
    $name = $_POST['name'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $org_price = $_POST['org_price'];
    $sell_price = $_POST['sell_price'];
    $reg_date = $_POST['reg_date'];
    $exp_date = $_POST['exp_date'];
    
    $sql = "INSERT INTO `medicine`(`name`, `type`, `amount`, `org_price`, `sell_price`, `reg_date`, `exp_date`)
        VALUES ('$name', '$type', '$amount', '$org_price', '$sell_price', '$reg_date', '$exp_date')";
    if($conn->query($sql)){
        header("Location:../Users/Admin/add.php?msg=Added");
    }else{
        echo $conn->error;
    }
}

?>