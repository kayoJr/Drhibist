<?php
require 'db.php';
if(isset($_POST['submit'])){
    $amount = $_POST['amount'];
    $for = $_POST['for'];
    $type = $_POST['type'];
    $pat_id = $_POST['patient'];
    $today = date('Y-m-d');
    if($type == 'cash'){
        if($for == 'lab'){

            $sql = $conn->query("SELECT * FROM `income` WHERE `date` = '$today' AND `reason` = 'laboratory' AND `pat_id` = '$pat_id'");
            $row = $sql->fetch_assoc();
            $lab_sum = $row['price'];

            $new_lab_sum = $lab_sum - $amount;

            $sql_upd = $conn->query("UPDATE `income` SET `price`= '$new_lab_sum' WHERE `date` = '$today' AND `reason` = 'laboratory' AND `pat_id` = '$pat_id'");
            if($sql_upd){
                header("Location: ../Users/Admin/return_other.php?msg=Returned");
            }else{
                echo $conn->error;
            }
        }else if($for == 'ultra'){
            $sql = $conn->query("SELECT * FROM `income` WHERE `date` = '$today' AND `reason` = 'ultrasound' AND `pat_id` = '$pat_id'");
            $row = $sql->fetch_assoc();
            $ultra_sum = $row['price'];

            $new_ultra_sum = $ultra_sum - $amount;

            $sql_upd = $conn->query("UPDATE `income` SET `price`= '$new_ultra_sum' WHERE `date` = '$today' AND `reason` = 'ultrasound' AND `pat_id` = '$pat_id'");
            if($sql_upd){
                header("Location: ../Users/Admin/return_other.php?msg=Returned");
            }else{
                echo $conn->error;
            }
        }else if($for == 'rec'){
            $sql = $conn->query("SELECT * FROM `income` WHERE `date` = '$today' AND `reason` = 'reception' AND `pat_id` = '$pat_id'");
            $row = $sql->fetch_assoc();
            $rec_sum = $row['price'];

            $new_rec_sum = $rec_sum - $amount;

            $sql_upd = $conn->query("UPDATE `income` SET `price`= '$new_rec_sum' WHERE `date` = '$today' AND `reason` = 'reception' AND `pat_id` = '$pat_id'");
            if($sql_upd){
                header("Location: ../Users/Admin/return_other.php?msg=Returned");
            }else{
                echo $conn->error;
            }
        }
    }else if($type == 'sys'){
        if($for == 'lab'){

            $sql = $conn->query("SELECT * FROM `system_payment` WHERE `date` = '$today' AND `reason` = 'laboratory' AND `pat_id` = '$pat_id'");
            $row = $sql->fetch_assoc();
            $lab_sum = $row['price'];

            $new_lab_sum = $lab_sum - $amount;

            $sql_upd = $conn->query("UPDATE `system_payment` SET `price`= '$new_lab_sum' WHERE `date` = '$today' AND `reason` = 'laboratory' AND `pat_id` = '$pat_id'");
            if($sql_upd){
                header("Location: ../Users/Admin/return_other.php?msg=Returned");
            }else{
                echo $conn->error;
            }
        }else if($for == 'rec'){
            $sql = $conn->query("SELECT * FROM `system_payment` WHERE `date` = '$today' AND `reason` = 'reception' AND `pat_id` = '$pat_id'");
            $row = $sql->fetch_assoc();
            $rec_sum = $row['price'];

            $new_rec_sum = $rec_sum - $amount;

            $sql_upd = $conn->query("UPDATE `system_payment` SET `price`= '$new_rec_sum' WHERE `date` = '$today' AND `reason` = 'reception' AND `pat_id` = '$pat_id'");
            if($sql_upd){
                header("Location: ../Users/Admin/return_other.php?msg=Returned");
            }else{
                echo $conn->error;
            }
        }
    }
}


// else if($for == 'ultra'){
//     $sql = $conn->query("SELECT SUM(price) AS ultra_sum FROM `system_payment` WHERE `date` = '$today' AND `reason` = 'ultrasound' AND `pat_id` = '$pat_id'");
//     $row = $sql->fetch_assoc();
//     $ultra_sum = $row['ultra_sum'];

//     $new_ultra_sum = $ultra_sum - $amount;

//     $sql_upd = $conn->query("UPDATE `system_payment` SET `price`= '$new_ultra_sum' WHERE `date` = '$today' AND `reason` = 'ultrasound' AND `pat_id` = '$pat_id'");
//     if($sql_upd){
//         header("Location: ../Users/Admin/return_other.php?msg=Returned");
//     }else{
//         echo $conn->error;
//     }
// }
?>