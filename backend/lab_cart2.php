<?php
require './db.php';
$checkbox1 = $_POST['lab'];
if (isset($_POST['submit'])) {
    foreach ($checkbox1 as $ch) {
        $sqlc = "SELECT * FROM `laboratory` WHERE `name`= '$ch' ";
        $rss5 = $conn->query($sqlc);
        while ($r = $rss5->fetch_assoc()) {
            $name = $r['name'];
            $pat = $_POST['pat'];
            $doc = $_POST['doc'];
            $price = $r['price'];

            $sql = "INSERT INTO `lab_cart2`(`name`, `price`, `patient_id`, `doctor_id`) VALUES ('$name', '$price', '$pat', '$doc')";
            $rs = $conn->query($sql);
            if (!$rs) {
                echo $conn->error;
            } else {
                header("Location:../Users/Doctor/index.php?msg=Done&search=$pat&searching=Search");
            }
        }
    }
}


