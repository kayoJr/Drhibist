<?php
include 'db.php';
// $idd = $_GET['id'];
if (isset($_POST['ultra_payment'])) {
    $id = $_POST['id'];
    $price = $_POST['price'];
    $payment = $_POST['payment'];

    $sql = $conn->query("SELECT * FROM `patient` WHERE `id` = '$id'");
    $row = $sql->fetch_assoc();
    $name = $row['name'];
    $phone = $row['phone'];

    if ($payment == 'system') {
        $sql = "INSERT INTO `system_payment` (`price`, `reason`, `pat_id`) VALUES ('$price', 'ultrasound', '$id')";
        if (!$conn->query($sql)) {
            echo $conn->error;
        } else {
            $sql = "UPDATE `ultra_cart` SET `payment` = 1 WHERE `patient_id` = '$id'";
            if ($conn->query($sql)) {
                $queue = $conn->query("INSERT INTO `ultraqueue` (`name`, `phone`, `patient_id`) VALUES ('$name', '$phone', '$id')");
                if ($queue) {
                    $sql = $conn->query("UPDATE `patient` SET `status`= 1 WHERE `id` = '$id'");
                    if ($sql) {
                        header("Location:../Users/Reception/search.php?search=$id&searching=Search&msg=Payed");
                    }
                } else {
                    echo 'error';
                }
            } else {
                echo $conn->error;
            }
        }
    } else if ($payment == 'cash') {
        $sql = "INSERT INTO `income` (`price`, `reason`, `pat_id`) VALUES ('$price', 'ultrasound', '$id')";
        if (!$conn->query($sql)) {
            echo $conn->error . 'ONE';
        } else {
            $sql = "UPDATE `ultra_cart` SET `payment` = 1 WHERE `patient_id` = '$id'";
            if ($conn->query($sql)) {
                if ($conn->query($sql)) {
                    $queue = $conn->query("INSERT INTO `ultraqueue` (`name`, `phone`, `patient_id`) VALUES ('$name', '$phone', '$id')");
                    if ($queue) {
                        $sql = $conn->query("UPDATE `patient` SET `status`= 1 WHERE `id` = '$id'");
                        if ($sql) {
                            header("Location:../Users/Reception/search.php?search=$id&searching=Search&msg=Payed");
                        }
                    } else {
                        echo 'error TWO';
                    }
                } else {
                    echo $conn->error . "THREE";
                }
            } else {
                echo $conn->error . "FOUR";
            }
        }
    } else if ($payment == 'admission') {
        $sql = "INSERT INTO `admission_pay` (`price`, `reason`, `pat_id`) VALUES ('$price', 'ultrasound', '$id')";
        if (!$conn->query($sql)) {
            echo "error" . $conn->error;
        } else {
            $sql = "UPDATE `ultra_cart` SET `payment` = 1 WHERE `patient_id` = '$id'";
            if ($conn->query($sql)) {
                if ($conn->query($sql)) {
                    $queue = $conn->query("INSERT INTO `ultraqueue` (`name`, `phone`, `patient_id`) VALUES ('$name', '$phone', '$id')");
                    if ($queue) {
                        $sql = $conn->query("UPDATE `patient` SET `status`= 1 WHERE `id` = '$id'");
                        if ($sql) {
                            header("Location:../Users/Reception/search.php?search=$id&searching=Search&msg=Payed");
                        }
                    } else {
                        echo 'error';
                    }
                } else {
                    echo $conn->error;
                }
            } else {
                echo $conn->error;
            }
        }
    }
    if (isset($_POST['credit'])) {
        $credit = $_POST['credit'];
        if ($credit == 'cigna') {
            echo $idd;
            $sql = "INSERT INTO `credit` (`price`, `reason`, `pat_id`, `org`) VALUES ('$price', 'ultrasound', '$id', 'cigna')";
            $rss = $conn->query($sql);
            if ($rss) {
                $sql = "UPDATE `ultra_cart` SET `payment` = 1 WHERE `patient_id` = '$id'";
                if ($conn->query($sql)) {
                    if ($conn->query($sql)) {
                        $queue = $conn->query("INSERT INTO `ultraqueue` (`name`, `phone`, `patient_id`) VALUES ('$name', '$phone', '$id')");
                        if ($queue) {
                            $sql = $conn->query("UPDATE `patient` SET `status`= 1 WHERE `id` = '$id'");
                            if ($sql) {
                                header("Location:../Users/Reception/search.php?search=$id&searching=Search&msg=Payed");
                            }
                        } else {
                            echo 'error';
                        }
                    } else {
                        echo $conn->error;
                    }
                } else {
                    echo $conn->error;
                }
            } else {
                echo $conn->error;
            }
        } else if ($credit == 'stc') {
            $sql = "INSERT INTO `credit` (`price`, `reason`, `pat_id`, `org`) VALUES ('$price', 'ultrasound', '$id', 'stc')";
            $rss = $conn->query($sql);
            if ($rss) {
                $sql = "UPDATE `ultra_cart` SET `payment` = 1 WHERE `patient_id` = '$id'";
                if ($conn->query($sql)) {
                    if ($conn->query($sql)) {
                        $queue = $conn->query("INSERT INTO `ultraqueue` (`name`, `phone`, `patient_id`) VALUES ('$name', '$phone', '$id')");
                        if ($queue) {
                            $sql = $conn->query("UPDATE `patient` SET `status`= 1 WHERE `id` = '$id'");
                            if ($sql) {
                                header("Location:../Users/Reception/search.php?search=$id&searching=Search&msg=Payed");
                            }
                        } else {
                            echo 'error';
                        }
                    } else {
                        echo $conn->error;
                    }
                } else {
                    echo $conn->error;
                }
            } else {
                echo $conn->error;
            }
        }
    }
}
