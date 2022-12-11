<?php
include 'db.php';
// $id = $_GET['id'];

if (isset($_POST['pay'])) {
    $price = $_POST['tot_price'];
    $payment = $_POST['payment'];
    $id = $_POST['id'];

    if ($payment == 'system') {
        $sql = "INSERT INTO `system_payment` (`price`, `reason`) VALUES ('$price', 'withdrawal')";
        if (!$conn->query($sql)) {
            echo $conn->error;
        } else {
                $sres =$conn->query("DELETE FROM `admission` WHERE `pat_id` = '$id'");
                if($sres){

                    header("Location:../Users/Reception/search.php?msg=Payed");
                }else{
                    echo $conn->error;
                }
            
        }
    }else if($payment == 'cash'){
        $sql = "INSERT INTO `income` (`price`, `reason`) VALUES ('$price', 'withdrawal')";
            if(!$conn->query($sql)){
                echo $conn->error;
            }else{
                
                $sres =$conn->query("DELETE FROM `admission` WHERE `pat_id` = '$id'");
                if($sres){

                    header("Location:../Users/Reception/search.php?msg=Payed");
                }else{
                    echo $conn->error;
                }                
            }
    }else if($payment == 'credit'){
        $sql = "INSERT INTO `credit` (`price`, `reason`) VALUES ('$price', 'withdrawal')";
            if(!$conn->query($sql)){
                echo $conn->error;
            }else{
                
                $sres =$conn->query("DELETE FROM `admission` WHERE `pat_id` = '$id'");
                if($sres){

                    header("Location:../Users/Reception/search.php?msg=Payed");
                }else{
                    echo $conn->error;
                }                
            }
    }
}
