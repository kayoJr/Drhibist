<?php
require "db.php";
$id = $_GET['rn'];
$sel = "SELECT * FROM `cart_adm` WHERE `id`='$id'";
$pro = $conn->query($sel);
while ($row = $pro->fetch_assoc()) {
    $quant_cart = $row['quant'];
    $med = "SELECT * FROM `meds` WHERE `id`='$id'";
    $medd = $conn->query($med);
    while ($rows = $medd->fetch_assoc()) {
        $quant_med = $rows['amount'];
        $new = $quant_cart + $quant_med;
        $upd = "UPDATE `meds` SET `amount` = '$new' WHERE `id` = '$id'";
        $resl = $conn->query($upd);
        if ($resl) {
            $sql = "DELETE FROM `cart_adm` WHERE `id` = '$id'";
            $res = $conn->query($sql);
            if ($res) {
                header("Location: ../Users/Pharmacy/admission.php?msg=Deleted");
            } else {
                header("Location: ./Users/Pharmacy/admission.php?err=Failed to Delete");
            }
        }else{
            echo mysqli_error($conn);
        }
    }
}
// $sql = "DELETE FROM `cart` WHERE `id` = '$id'";
// $res = $conn->query($sql);
// if($res){
//     header("Location: ../Users/Pharmacy/index.php?msg=Deleted");
// }else{
//     header("Location: ./Users/Pharmacy/index.php?err=Failed to Delete");
// }
