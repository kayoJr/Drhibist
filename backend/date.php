<?php
require_once './db.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    echo '<script>console.log($id)</script>';
    @$payment = $_POST['payment'];
    $sql = "SELECT * FROM `patient` WHERE `id` = '$id'";
    $result = $conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $date = $row['date'];
            $now = date("Y-m-d");
            $date1 = new DateTime($date);
            $date2 = new DateTime(date("Y-m-d"));
            $interval = $date1->diff($date2);
            // echo "difference " . $interval->days . " days ";
            if (($interval->days) >= 10) {
                $sql = "UPDATE `patient` SET `date` = '$now', `status` = 0 WHERE `id` = '$id'";
                $rs = $conn->query($sql);
                if ($rs) {
                    if ($payment == 'system') {
                        $sql = "INSERT INTO `system_payment` (`price`, `reason`) VALUES (200, 'reception')";
                        if (!$conn->query($sql)) {
                            echo $conn->error;
                        } else {
                            header("Location: ../Users/Reception/search.php?search=$id&searching=Search");
                        }
                    } else if ($payment == 'cash') {
                        $sql = "INSERT INTO `income` (`price`, `reason`) VALUES (200, 'reception')";
                        if (!$conn->query($sql)) {
                            echo $conn->error;
                        } else {
                            header("Location: ../Users/Reception/search.php?search=$id&searching=Search");
                        }
                    } else if (isset($_POST['credit'])) {
                        $credit = $_POST['credit'];
                        if ($credit == 'cigna') {
                            $sql = "INSERT INTO `credit` (`price`, `reason`, `pat_id`, `org`) VALUES (200, 'reception', '$id', 'cigna')";
                            $rss = $conn->query($sql);
                            if ($rss) {
                                header("Location: ../Users/Reception/search.php?search=$id&searching=Search");
                            } else {
                                echo $conn->error;
                            }
                        } else if ($credit == 'stc') {
                            $sql = "INSERT INTO `credit` (`price`, `reason`, `pat_id`, `org`) VALUES (200, 'reception', '$id', 'stc')";
                            $rss = $conn->query($sql);
                            if ($rss) {
                                header("Location: ../Users/Reception/search.php?search=$id&searching=Search");
                            } else {
                                echo $conn->error;
                            }
                        } else {
                            echo "error: " . $conn->error;
                        }
                    } else {
                        echo $conn->error;
                    }
                } else {
                    echo $conn->error;
                }
            } else {
                header("Location: ../Users/Reception/search.php?msg=User Updated");
            }
        }
    } else {
        echo $conn->error;
    }
} else {
    echo "not clicked";
}
