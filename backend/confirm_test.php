<?php
require 'db.php';
if (isset($_GET['submit'])) {
    @$payment = $_GET['payment'];
    $tot_price = $_GET['tot_price'];
    $user_id = $_GET['user_id'];
    $result = $conn->query("SELECT * FROM `cart_test` WHERE `user_id` = '$user_id'");
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $type = $row['type'];
        $price = $row['price'];
        $amount = $row['quant'];
        $sub = $row['sub_price'];
        $pat_id = $row['pat_id'];
        $now = date("Y-m-d");
        if ($payment == 'cash') {
            $check_if_exist = $conn->query("SELECT * FROM `cash_payment_pharm_test` WHERE `id` = '$id' AND `date` = '$now' AND `patient_id` = '$pat_id'");
            if ($check_if_exist->num_rows > 0) {
                while ($row = $check_if_exist->fetch_assoc()) {
                    $prev_amount = $row['quan']; //previous amount
                    $price = $row['price']; //single price
                    $patient = $row['patient_id'];
                    $upd_amount = $prev_amount + $amount;
                    $new_price = $price * $upd_amount;
                    // echo 'prev amount <br> ' . $prev_amount;
                    $update_existing = $conn->query("UPDATE `cash_payment_pharm_test` SET `quan` = '$upd_amount', `sub_price`='$new_price' WHERE `id` = '$id' AND `patient_id` = '$pat_id' AND `date` = '$now'");
                    if ($update_existing) {
                        $del = $conn->query("DELETE FROM `cart_test` WHERE `user_id` = '$user_id'");
                        if ($del) {
                            header("Location:../Users/Pharmacy/pharmaTest.php?msg=Done");
                        } else {
                            header("Location:../Users/Pharmacy/pharmaTest.php?msg=$conn->error");
                        }
                    } else {
                        echo $conn->error;
                    }
                }
            }
            else {
                $add_new = $conn->query("INSERT INTO `cash_payment_pharm_test`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`patient_id`, `date`) VALUES ('$id', '$name','$type','$price','$amount','$sub', '$pat_id', '$now') ");
                if ($add_new) {
                    $del = $conn->query("DELETE FROM `cart_test` WHERE `user_id` = '$user_id'");
                    if ($del) {
                        header("Location:../Users/Pharmacy/pharmaTest.php?msg=Done");
                    } else {
                        header("Location:../Users/Pharmacy/pharmaTest.php?msg=$conn->error");
                    }
                } else {
                    echo "Error on saving in cash " . $conn->error;
                }
            }
        } elseif ($payment == 'system') {
            $check_if_exist = $conn->query("SELECT * FROM `system_payment_pharm_test` WHERE `id` = '$id' AND `date` = '$now' AND `patient_id` = '$pat_id'");
            if ($check_if_exist->num_rows > 0) {
                while ($row = $check_if_exist->fetch_assoc()) {
                    $prev_amount = $row['quan']; //previous amount
                    $price = $row['price']; //single price
                    $patient = $row['patient_id'];
                    $upd_amount = $prev_amount + $amount;
                    $new_price = $price * $upd_amount;
                    // echo 'prev amount <br> ' . $prev_amount;
                    $update_existing = $conn->query("UPDATE `system_payment_pharm_test` SET `quan` = '$upd_amount', `sub_price`='$new_price' WHERE `id` = '$id' AND `patient_id` = '$pat_id' AND `date` = '$now'");
                    if ($update_existing) {
                        $del = $conn->query("DELETE FROM `cart_test` WHERE `user_id` = '$user_id'");
                        if ($del) {
                            header("Location:../Users/Pharmacy/pharmaTest.php?msg=Done");
                        } else {
                            header("Location:../Users/Pharmacy/pharmaTest.php?msg=$conn->error");
                        }
                    } else {
                        echo $conn->error;
                    }
                }
            }
            else {
                $add_new = $conn->query("INSERT INTO `system_payment_pharm_test`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`patient_id`, `date`) VALUES ('$id', '$name','$type','$price','$amount','$sub', '$pat_id', '$now') ");
                if ($add_new) {
                    $del = $conn->query("DELETE FROM `cart_test` WHERE `user_id` = '$user_id'");
                    if ($del) {
                        header("Location:../Users/Pharmacy/pharmaTest.php?msg=Done");
                    } else {
                        header("Location:../Users/Pharmacy/pharmaTest.php?msg=$conn->error");
                    }
                } else {
                    echo "Error on saving in cash " . $conn->error;
                }
            }
        }
    }
}
