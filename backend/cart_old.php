<?php
require './db.php';

if (isset($_POST['submit'])) {
    $id = $_POST['name'];
    $type = $_POST['book'];
    $quant = $_POST['quant'];
    $med_id = $_POST['med_id'];
    $pat_id = $_POST['pat_id'];
    $user_id = $_POST['user_id'];
    $sql = "SELECT * FROM `meds` WHERE `id` = '$id'";
    $rs = mysqli_query($conn, $sql);
    if (mysqli_num_rows($rs)) {
        while ($row = mysqli_fetch_assoc($rs)) {
            $pd_id = $row['id'];
            $pd_name = $row['name'];
            $pd_price = $row['cost'];
            $amount = $row['amount'];
            $t_price = $pd_price * $quant;
            $sql = "SELECT * FROM `cart` WHERE `id` = '$pd_id' AND `user_id` = '$user_id'";
            $rs = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($rs);
            $cart = $row['id'];
            if ($amount >= $quant) {
                $nw_amount = $amount - $quant;
                $update = "UPDATE `meds` SET `amount` = '$nw_amount' WHERE `id` = '$id'";
                if ($row[0] > 1) {
                    $upd = "UPDATE `cart` SET `quant` = '$quant' WHERE `id`= '$pd_id'";
                    $query = "UPDATE `cart` SET `id`='$pd_id',`name`='$pd_name',`price`='$pd_price',`quant`='$quant',`sub_price`='$t_price' WHERE `id`='$pd_id'";
                    $rs2 = mysqli_query($conn, $query);
                    if (!$rs2) {
                        echo "Not Added". $conn->error;
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
                    $query = "INSERT INTO `cart` (`id`, `name`, `type`, `price`,`quant`, `sub_price`, `pat_id`, `user_id`) values 
            ('$pd_id', '$pd_name', '$type', '$pd_price', '$quant', '$t_price', '$pat_id', '$user_id')";
                    $rs2 = mysqli_query($conn, $query);
                    if (!$rs2) {
                        // header("Location:../Users/Pharmacy?msg=Nothing Added");
                        echo $conn->error;
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
} else if(isset($_POST['submit_adm'])) {
    $id = $_POST['name'];
    $type = $_POST['book'];
    $quant = $_POST['quant'];
    $med_id = $_POST['med_id'];
    $pat_id = $_POST['pat_id'];
    $sql = "SELECT * FROM `meds` WHERE `id` = '$id'";
    $rs = mysqli_query($conn, $sql);
    if (mysqli_num_rows($rs)) {
        while ($row = mysqli_fetch_assoc($rs)) {
            $pd_id = $row['id'];
            $pd_name = $row['name'];
            $pd_price = $row['cost'];
            $amount = $row['amount'];
            $t_price = $pd_price * $quant;
            $sql = "SELECT * FROM `cart` WHERE `id` = '$pd_id'";
            $rs = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($rs);
            $cart = $row['id'];
            if ($amount >= $quant) {
                $nw_amount = $amount - $quant;
                $update = "UPDATE `meds` SET `amount` = '$nw_amount' WHERE `id` = '$id'";
                if ($row[0] > 1) {
                    $upd = "UPDATE `cart` SET `quant` = '$quant' WHERE `id`= '$pd_id'";
                    $query = "UPDATE `cart` SET `id`='$pd_id',`name`='$pd_name',`price`='$pd_price',`quant`='$quant',`sub_price`='$t_price' WHERE `id`='$pd_id'";
                    $rs2 = mysqli_query($conn, $query);
                    if (!$rs2) {
                        echo "Not Added";
                    } else {
                        echo "updated";
                        $conn->query($update);
                        header("Location:../Users/Pharmacy/admission.php?msg=Updated");

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
                    $query = "INSERT INTO `cart` (`id`, `name`, `type`, `price`,`quant`, `sub_price`, `pat_id`, `user_id`) values 
            ('$pd_id', '$pd_name', '$type', '$pd_price', '$quant', '$t_price', '$pat_id', '$user_id')";
                    $rs2 = mysqli_query($conn, $query);
                    if (!$rs2) {
                        header("Location:../Users/Pharmacy/admission.php?msg=Nothing Added");
                    } else {
                        echo "added";
                        $conn->query($update);
                        header("Location:../Users/Pharmacy/admission.php?msg=Updated");
                    }
                }
            } else {
                header("Location:../Users/Pharmacy/admission.php?msg=Not Enough Medicine In The Store");
            }
        }
    }
}
