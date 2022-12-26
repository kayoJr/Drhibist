<?php
require 'db.php';

if(isset($_POST['abdominal'])){
    $liver = $_POST['liver_res'];
    $gb = $_POST['gb'];
    $bowel = $_POST['bowel'];
    $kid = $_POST['kid'];
    $pel = $_POST['pel'];
    $impression = $_POST['impression'];
    $conclusion = $_POST['conclusion'];
    $drname = $_POST['drname'];
    $res_id = $_POST['pat'];
    $pat_id = $_POST['pat_id'];

    $sql = "UPDATE `abdominal` SET `liver`='$liver',`gb`='$gb',
        `bowel`='$gb',`kidney`='$kid',`pelvic`='$pel',
        `impression`='$impression',`conclusion`='$conclusion',
        `drname`='$drname' WHERE `id` = '$res_id'";
    $rs = $conn->query($sql);
    if($rs){
            header("Location:../Users/Ultrasound/ultraresu.php?id=$pat_id");
        }else{
            echo $conn->error;
        }
}else if(isset($_POST['breast'])){
    $breast = $_POST['breast_res'];
    $impression = $_POST['impression'];
    $conclusion = $_POST['conclusion'];
    $res_id = $_POST['pat'];
    $drname = $_POST['drname'];
    $pat_id = $_POST['pat_id'];
    $sql = "UPDATE `breast` SET `result`='$breast',
        `impression`='$impression',`conclusion`='$conclusion',
        `drname`='$drname' WHERE `id` = '$res_id'
    ";
    $rs = $conn->query($sql);
    if($rs){
        header("Location:../Users/Ultrasound/ultraresu.php?id=$pat_id");
    }else{
            echo $conn->error;
        }
}else if(isset($_POST['neck'])){
    $neck = $_POST['neck_res'];
    $impression = $_POST['impression'];
    $conclusion = $_POST['conclusion'];
    $drname = $_POST['drname'];
    $res_id = $_POST['pat'];
    $pat_id = $_POST['pat_id'];
    $sql = "UPDATE `neck` SET `result`='$neck',
        `impression`='$impression',`conclusion`='$conclusion',
        `drname`= '$drname' WHERE `id` = '$res_id'";
    $rs = $conn->query($sql);
    if($rs){
        header("Location:../Users/Ultrasound/ultraresu.php?id=$pat_id");
    }else{
            echo $conn->error;
        }
}else if(isset($_POST['scrotal'])){
    $scrotal = $_POST['scrotal_res'];
    $impression = $_POST['impression'];
    $conclusion = $_POST['conclusion'];
    $drname = $_POST['drname'];
    $res_id = $_POST['pat'];
    $pat_id = $_POST['pat_id'];
    $sql = "UPDATE `normal_brain` SET `result`='$scrotal',
        `impression`='$impression',`conclusion`='$conclusion',
        `drname`='$drname' WHERE `id` = '$res_id'";
    $rs = $conn->query($sql);
    if($rs){
        header("Location:../Users/Ultrasound/ultraresu.php?id=$pat_id");
    }else{
            echo $conn->error;
        }
}else if(isset($_POST['other'])){
    $other = $_POST['other_res'];
    $impression = $_POST['impression'];
    $conclusion = $_POST['conclusion'];
    $drname = $_POST['drname'];
    $res_id = $_POST['pat'];
    $pat_id = $_POST['pat_id'];
    $sql = "UPDATE `other` SET `result`='$other',
        `impression`='$impression',`conclusion`='$conclusion',
        `drname`='$drname' WHERE `id` = '$res_id'";
    $rs = $conn->query($sql);
    if($rs){
        header("Location:../Users/Ultrasound/ultraresu.php?id=$pat_id");
    }else{
            echo $conn->error;
        }
    }else{
        echo "error".$conn->error;
    }
?>