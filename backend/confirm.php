<?php
require 'db.php';
if (isset($_GET['submit'])) {
    @$payment = $_GET['payment'];
    $tot_price = $_GET['tot_price'];
    $user_id = $_GET['user_id'];
    $ssq = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
    $result = $conn->query($ssq);
    // if (!$payment || !isset($_GET['credit'])) {
    //     header("Location:../Users/Pharmacy?msg=Please Select Payment Method");
    // } else {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $type = $row['type'];
            $price = $row['price'];
            $amount = $row['quant'];
            $sub = $row['sub_price'];
            $pat_id = $row['pat_id'];
            $now = date("Y-m-d");
            $sql = "SELECT * FROM `pharma_daily_sell` WHERE `id` = '$id' AND `date` = '$now' AND `patient_id` = '$pat_id'";
            $rs = $conn->query($sql);
            if ($rs->num_rows > 0) {
                while ($row = $rs->fetch_assoc()) {
                    $prev_amount = $row['quan'];
                    $price = $row['price'];
                    $patient = $row['patient_id'];
                    $upd_amount = $prev_amount + $amount;
                    $new_price = $price * $upd_amount;
                    if ($payment == 'cash') {
                        $copy = $conn->query("UPDATE `pharma_daily_sell` SET `quan` = '$upd_amount', `sub_price`='$new_price' WHERE `id` = '$id' AND `patient_id` = '$pat_id'");
                        if ($copy) {
                            $copy_to_sys = $conn->query("UPDATE `cash_payment_pharm` SET `quan` = '$upd_amount', `sub_price`='$new_price' WHERE `id` = '$id' AND `patient_id` = '$pat_id'");
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
                    } else if ($payment == 'system') {
                        $copy = $conn->query("UPDATE `pharma_daily_sell` SET `quan` = '$upd_amount', `sub_price`='$new_price' WHERE `id` = '$id' AND `patient_id` = '$pat_id'");
                        if ($copy) {
                            $copy_to_sys = $conn->query("UPDATE `system_payment_pharm` SET `quan` = '$upd_amount', `sub_price`='$new_price' WHERE `id` = '$id' AND `patient_id` = '$pat_id'");
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
                }
            } else {
                if ($payment == 'cash') {
                    $copy = $conn->query("INSERT INTO `pharma_daily_sell`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`patient_id`, `payment`, `date`) VALUES ('$id', '$name','$type','$price','$amount','$sub', '$pat_id', 'cash', '$now') ");
                    if ($copy) {
                        $copy_to_sys = $conn->query("INSERT INTO `cash_payment_pharm`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`patient_id`, `date`) VALUES ('$id', '$name','$type','$price','$amount','$sub', '$pat_id', '$now') ");
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
                } else if ($payment == 'system') {
                    $copy = $conn->query("INSERT INTO `pharma_daily_sell`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`patient_id`, `payment`, `date`) VALUES ('$id', '$name','$type','$price','$amount','$sub', '$pat_id', 'system', '$now') ");
                    if ($copy) {
                        $copy_to_sys = $conn->query("INSERT INTO `system_payment_pharm`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`patient_id`, `date`) VALUES ('$id', '$name','$type','$price','$amount','$sub', '$pat_id', '$now') ");
                        if ($copy_to_sys) {
                            $del = $conn->query("DELETE FROM `cart` WHERE `user_id` = '$user_id'");
                            if ($del) {
                                header("Location:../Users/Pharmacy?msg=Done");
                            } else {
                                header("Location:../Users/Pharmacy?msg=$conn->error");
                            }
                        }
                    } else {
                        echo "Error on saving in system " . $conn->error;
                    }
                }
            }
        }
  //  }
    if (isset($_GET['credit'])) {
        $credit = $_GET['credit'];
        $ssq = $conn->query("SELECT * FROM `cart` WHERE `user_id` = '$user_id'");
        while ($row = $ssq->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $type = $row['type'];
            $price = $row['price'];
            $amount = $row['quant'];
            $sub = $row['sub_price'];
            $pat_id = $row['pat_id'];
            $now = date("Y-m-d");
            $sql = $conn->query("SELECT * FROM `pharma_daily_sell` WHERE `id` = '$id' AND `date` = '$now' AND `patient_id` = '$pat_id' AND `payment` = 'credit'");
            if ($sql->num_rows > 0) {
                while ($row = $sql->fetch_assoc()) {
                    $prev_amount = $row['quan'];
                    $price = $row['price'];
                    $patient = $row['patient_id'];
                    $upd_amount = $prev_amount + $amount;
                    $new_price = $price * $upd_amount;
                    if ($credit == 'cigna') {
                        $copy = $conn->query("UPDATE `pharma_daily_sell` SET `quan` = '$upd_amount', `sub_price`='$new_price' WHERE `id` = '$id' AND `patient_id` = '$pat_id' AND `payment` = 'credit'");
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
                    } else if ($credit == 'stc') {
                        $copy = $conn->query("UPDATE `pharma_daily_sell` SET `quan` = '$upd_amount', `sub_price`='$new_price' WHERE `id` = '$id' AND `patient_id` = '$pat_id' AND `payment` = 'credit'");
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
                }
            } else {
                if ($credit == 'cigna') {
                    $copy = $conn->query("INSERT INTO `pharma_daily_sell`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`patient_id`, `payment`, `date`) VALUES ('$id', '$name','$type','$price','$amount','$sub', '$pat_id', 'credit', '$now') ");
                    if ($copy) {
                        $copy_to_sys = $conn->query("INSERT INTO `credit_pharm`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`patient_id`, `org`, `date`) VALUES ('$id', '$name','$type','$price','$amount','$sub', '$pat_id', 'cigna', '$now') ");
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
                } else if ($credit == 'stc') {
                    $copy = $conn->query("INSERT INTO `pharma_daily_sell`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`patient_id`, `payment`, `date`) VALUES ('$id', '$name','$type','$price','$amount','$sub', '$pat_id', 'credit', '$now') ");
                    if ($copy) {
                        $copy_to_sys = $conn->query("INSERT INTO `credit_pharm`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`patient_id`, `org`, `date`) VALUES ('$id', '$name','$type','$price','$amount','$sub', '$pat_id', 'stc', '$now') ");
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
            }
        }
    }
}
