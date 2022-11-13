<?php
require "db.php";

if(isset($_POST['submit'])){
    $cat1 = $_POST['hematology'];
    $cat2 = $_POST['chemistry'];
    $cat3 = $_POST['stool'];
    $cat4 = $_POST['special'];
    $cat5 = $_POST['serum'];
    $cat6 = $_POST['urinal'];
    $cat7 = $_POST['bacteria'];
    $cat8 = $_POST['sputum'];
    $cat9 = $_POST['microscopy'];
    $cat10 = $_POST['serology'];
    $card = $_POST['card'];
    

    $hema = serialize($cat1);
    $chemi = serialize($cat2);
    $stool = serialize($cat3);
    $special = serialize($cat4);
    $serum = serialize($cat5);
    $urinal = serialize($cat6);
    $bact = serialize($cat7);
    $sputum = serialize($cat8);
    $micro = serialize($cat9);
    $sero = serialize($cat10);

    $sql = "INSERT INTO `lab_req`(`hematology`, `chemistry`, `stool`, `special`, `serum`, `urinalysis`, `bacteriology`, `sputum`, `microscopy`, `serology`, `patient_id`) 
            VALUES ('$hema', '$chemi', '$stool', '$special', '$serum', '$urinal', '$bact', '$sputum', '$micro', '$sero', '$card')";

        $rs = $conn->query($sql);
    if(!$rs){
        echo mysqli_error($conn);
    }

}
$sql2 = "SELECT * FROM `lab_req`";
$res = $conn->query($sql2);
if($res){
    while($row = $res->fetch_assoc()){
        $lab = $row['hematology'];
        $ch = $row['chemistry'];
    }
}
$lab2 = unserialize($lab);
$chemi = unserialize($ch);
// foreach($lab2 as $lab3){
//     echo $lab3.'<br>';   
// }
$h = count($lab2)*100;
$c = count($chemi)*100;
$r = $c+$h;
echo $r;
echo 'doc = '.$r/2;
?>