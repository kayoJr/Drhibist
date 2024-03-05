<?php
require './db.php';

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    echo $exam_id = $_POST['exam_id'];
    $bp = $_POST['bp'];
    $pr = $_POST['pr'];
    $saturation = $_POST['saturation'];
    $respiratory = $_POST['respiratory'];
    $temp = $_POST['temp'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $head = $_POST['head'];
    $muac = $_POST['muac'];

    $sql = "UPDATE `nurse_exam` SET `BP`='$bp',`PR`='$pr',
        `saturation`='$saturation',`respiratory`='$respiratory',
        `temprature`='$temp',`height`='$height',`weight`='$weight',
        `head_circum`='$head',`MUAC`='$muac' WHERE `id` = '$exam_id' AND `patient_id` = '$id'";
    $res = $conn->query($sql);
    if($res){
        header("Location: ../Users/Doctor/search.php?search=$id&searching=Search&msg=Updated");
    }else{
        echo 'error';
    }
}

?>