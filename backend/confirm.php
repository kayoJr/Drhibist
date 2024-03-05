<?php
require 'db.php';
if (isset($_GET['submit'])) {
    $payment = $_GET['payment'];
    $credit = @$_GET['credit'];
    $tot_price = $_GET['tot_price'];
    $user_id = $_GET['user_id'];
    $result = $conn->query("SELECT * FROM `cart` WHERE `user_id` = '$user_id'");
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $type = $row['type'];
        $price = $row['price'];
        $amount = $row['quant'];
        $sub = $row['sub_price'];
        $pat_id = $row['pat_id'];
        $now = date("Y-m-d");
        if (!empty($credit)) {
            $sql = $conn->query("SELECT * FROM `pharmacy_sale` WHERE `id` = '$id' AND `date` = '$now' AND `patient_id` = '$pat_id' AND `payment` = 'credit'");
            if ($sql->num_rows > 0) {
                while ($row = $sql->fetch_assoc()) {
                    $prev_amount = $row['quan'];
                    $price = $row['price'];
                    $patient = $row['patient_id'];
                    $upd_amount = $prev_amount + $amount;
                    $new_price = $price * $upd_amount;
                        $copy = $conn->query("UPDATE `pharmacy_sale` SET `quan` = '$upd_amount', `sub_price`='$new_price' WHERE `id` = '$id' AND `patient_id` = '$pat_id' AND `payment` = 'credit'");
                        if ($copy) {
                            $copy_to_sys = $conn->query("UPDATE `credit_pharm` SET `quan` = '$upd_amount', `sub_price`='$new_price' WHERE `id` = '$id' AND `patient_id` = '$pat_id'");
                            if ($copy_to_sys) {
                                $del = $conn->query("DELETE FROM `cart` WHERE `user_id` = '$user_id'");
                                if ($del) {
                                    header("Location:../Users/Pharmacy?msg=Done");
                                } else {
                                    header("Location:../Users/Pharmacy?msg=$conn->error");
                                }
                            }
                        } else {
                            echo "Error on saving in cash " . $conn->error;
                        }
                }
            }else{
                $copy = $conn->query("INSERT INTO `pharmacy_sale`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`patient_id`, `payment`, `date`) VALUES ('$id', '$name','$type','$price','$amount','$sub', '$pat_id', '$payment', '$now') ");
                if ($copy) {
                    $copy_to_sys = $conn->query("INSERT INTO `credit_pharm`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`patient_id`, `org`, `date`) VALUES ('$id', '$name','$type','$price','$amount','$sub', '$pat_id', '$credit', '$now') ");
                    if ($copy_to_sys) {
                        $del = $conn->query("DELETE FROM `cart` WHERE `user_id` = '$user_id'");
                        if ($del) {
                            header("Location:../Users/Pharmacy?msg=Done");
                        } else {
                            header("Location:../Users/Pharmacy?msg=$conn->error");
                        }
                    }
                } else {
                    echo "Error on saving in credit cigna " . $conn->error;
                }
            }
        } else {
            $check_if_exist = $conn->query("SELECT * FROM `pharmacy_sale` WHERE `id` = '$id' AND `date` = '$now' AND `patient_id` = '$pat_id' AND `payment` = '$payment'");
      
            if ($check_if_exist->num_rows > 0) {
                while ($row = $check_if_exist->fetch_assoc()) {
                    $prev_amount = $row['quan']; //previous amount
                    $price = $row['price']; //single price
                    $patient = $row['patient_id'];
                    $upd_amount = $prev_amount + $amount;
                    $new_price = $price * $upd_amount;
                    // echo 'prev amount <br> ' . $prev_amount;
                    $update_existing = $conn->query("UPDATE `pharmacy_sale` SET `quan` = '$upd_amount', `sub_price`='$new_price' WHERE `id` = '$id' AND `patient_id` = '$pat_id' AND `date` = '$now' AND `payment` = '$payment'");
                    if ($update_existing) {
                        $del = $conn->query("DELETE FROM `cart` WHERE `user_id` = '$user_id'");
                        if ($del) {
                            header("Location:../Users/Pharmacy?msg=Done");
                        } else {
                            header("Location:../Users/Pharmacy?msg=$conn->error");
                        }
                    } else {
                        echo $conn->error;
                    }
                }
            } else {
                $add_new = $conn->query("INSERT INTO `pharmacy_sale`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`patient_id`,`payment`, `date`) VALUES ('$id', '$name','$type','$price','$amount','$sub', '$pat_id', '$payment', '$now') ");
                if ($add_new) {
                    $del = $conn->query("DELETE FROM `cart` WHERE `user_id` = '$user_id'");
                    if ($del) {
                        header("Location:../Users/Pharmacy?msg=Done");
                    } else {
                        header("Location:../Users/Pharmacy?msg=$conn->error");
                    }
                } else {
                    echo "Error on saving in cash " . $conn->error;
                }
            }
        }
    }
}
