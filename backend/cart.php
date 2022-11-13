<?php
require './db.php';

// $id = $_GET['rn'];
// $num = $_GET['quant'];
if (isset($_POST['submit'])) {
    $id = $_POST['name'];
    $type = $_POST['books'];
    $quant = $_POST['quant'];
    $sql = "SELECT * FROM `medicine` WHERE `id` = '$id'";
    $rs = mysqli_query($conn, $sql);
    if (mysqli_num_rows($rs)) {
        while ($row = mysqli_fetch_assoc($rs)) {
            $pd_id = $row['id'];
            $pd_name = $row['name'];
            $pd_price = $row['sell_price'];
            $amount = $row['amount'];
            $t_price = $pd_price * $quant;
            $sql = "SELECT * FROM `cart` WHERE `id` = '$pd_id'";
            $rs = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($rs);
            $cart = $row['id'];
            if ($amount >= $quant) {
                $nw_amount = $amount - $quant;
                $update = "UPDATE `medicine` SET `amount` = '$nw_amount' WHERE `id` = '$id'";
                if ($row[0] > 1) {
                    $upd = "UPDATE `cart` SET `quant` = '$quant' WHERE `id`= '$pd_id'";
                    $query = "UPDATE `cart` SET `id`='$pd_id',`name`='$pd_name',`price`='$pd_price',`quant`='$quant',`sub_price`='$t_price' WHERE `id`='$pd_id'";
                    $rs2 = mysqli_query($conn, $query);
                    if (!$rs2) {
                        echo "Not Added";
                    } else {
                        echo "updated";
                        $conn->query($update);
                        header("Location:../Users/Pharmacy?msg=Updated");

                        // echo "<script>
                        // window.location.href='index.php?msg=Added';
                        // </script>";
                    }
                    // if(mysqli_query($conn, $upd)){
                    //     header("Location:index.php?warn=UPDATEd");
                    // }else{
                    //     echo "error";
                    // }
                    // header("Location:index.php?warn=Already Added");
                } else {
                    $query = "INSERT INTO `cart` (`id`, `name`, `type`, `price`,`quant`, `sub_price`) values 
            ('$pd_id', '$pd_name', '$type', '$pd_price', '$quant', '$t_price')";
                    $rs2 = mysqli_query($conn, $query);
                    if (!$rs2) {
                        header("Location:../Users/Pharmacy?msg=Nothing Added");
                    } else {
                        echo "added";
                        $conn->query($update);
                        header("Location:../Users/Pharmacy?msg=Updated");
                    }
                }
            } else {
                header("Location:../Users/Pharmacy?msg=Not Enough Medicine In The Store");
            }
        }
    }
} else {
    echo "not clicked";
}
