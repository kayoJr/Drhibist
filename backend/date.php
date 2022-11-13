<?php
require_once './db.php';
$id = $_GET['id'];
$sql = "SELECT * FROM `patient` WHERE `id` = 1";
$result = $conn->query($sql);
if($result){
    while($row = $result ->fetch_assoc()){
        $date = $row['date'];
        $now = date("Y-m-d");
        $date1 = new DateTime($date);
        $date2 = new DateTime(date("Y-m-d"));
        $interval = $date1->diff($date2);
       // echo "difference " . $interval->days . " days ";
        if(($interval->days) >= 10){
            $sql = "UPDATE `patient` SET `date` = '$now' WHERE `id` = '$id'";
            $rs = $conn->query($sql);
            if($rs){
                header("Location: ../Users/Reception/search.php?msg=User Updated");
            }
        }else{
            header("Location: ../Users/Reception/search.php?msg=User Updated");
        }
    }
}
?>