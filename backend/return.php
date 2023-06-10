<?php
require 'db.php';

if(isset($_POST['submit'])){
    $id = $_POST['name'];
    $amount = $_POST['quant'];
    $today = date("Y-m-d");
    $sql = "SELECT * FROM `cash_payment_pharm` WHERE `id` = '$id' AND `date` = '$today'";
    $rs = $conn->query($sql);
    if($rs){
        $row = $rs->fetch_assoc();
        $old_amount = $row['quan'];
        $price = $row['price'];
        if($amount > $old_amount){
            header("Location: ../Users/Admin/return.php?msg=Quantity is greater than sold number");
        }else{
        $sold = $old_amount - $amount;
        $new_price = $sold * $price;
        $sql_upd = "UPDATE `cash_payment_pharm` SET `quan` = '$sold', `sub_price`='$new_price' WHERE `id` = '$id' AND `date` = '$today'";
        $rs_upd = $conn->query($sql_upd);
        if($rs_upd){
            $sql2 = "SELECT * FROM `meds` WHERE `id` = '$id'";
            $rs = $conn->query($sql2);
            if($rs){
                $rows = $rs->fetch_assoc();
                $org_amount = $rows['amount'];
                $new_amount = $org_amount + $amount;
                $upd = "UPDATE `meds` SET `amount`='$new_amount' WHERE `id`='$id'";
                $rss = $conn->query($upd);
                if(!$rss){
                    echo $conn->error;
                }else{
                        header("Location: ../Users/Admin/return.php?msg=Returned");
                   
                }
            }
        }else{
            echo "failed";
        }
    }
    }else{
        echo $conn->error;
    }
}

?>