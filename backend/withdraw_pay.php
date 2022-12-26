<?php
include 'db.php';
// $id = $_GET['id'];

if (isset($_POST['pay'])) {
    $price = $_POST['tot_price'];
    $payment = $_POST['payment'];
    $id = $_POST['id'];

    if ($payment == 'system') {
        $sql = "INSERT INTO `system_payment` (`price`, `reason`, `pat_id`) VALUES ('$price', 'withdrawal', '$id')";
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
        $sql = "INSERT INTO `income` (`price`, `reason`, `pat_id`) VALUES ('$price', 'withdrawal', '$id')";
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
    }if (isset($_POST['credit'])) {
        $credit = $_POST['credit'];
        if ($credit == 'cigna') {
            $sql = "INSERT INTO `credit` (`price`, `reason`, `pat_id`, `org`) VALUES ('$price', 'withdrawal', '$id', 'cigna')";
            $rss = $conn->query($sql);
            if ($rss) {
                $sres =$conn->query("DELETE FROM `admission` WHERE `pat_id` = '$id'");
                if($sres){

                    header("Location:../Users/Reception/search.php?msg=Payed");
                }else{
                    echo $conn->error;
                }             } else {
                echo $conn->error;
            }
        } else if ($credit == 'stc') {
            $sql = "INSERT INTO `credit` (`price`, `reason`, `pat_id`, `org`) VALUES ('$price', 'withdrawal', '$id', 'stc')";
            $rss = $conn->query($sql);
            if ($rss) {
                $sres =$conn->query("DELETE FROM `admission` WHERE `pat_id` = '$id'");
                if($sres){

                    header("Location:../Users/Reception/search.php?msg=Payed");
                }else{
                    echo $conn->error;
                }             } else {
                echo $conn->error;
            }
        }
    }
}
