<?php
require 'db.php';
if (isset($_GET['submit'])) {
	$payment = $_GET['payment'];
	$tot_price = $_GET['tot_price'];
	$ssq = "SELECT * FROM cart";
	$result = $conn->query($ssq);
	if ($payment == "system") {
		$sql = "INSERT INTO `system_payment` (`price`) VALUES ('$tot_price')";
		if ($conn->query($sql)) {
			$sql = "TRUNCATE TABLE `cart`";
			$res = $conn->query($sql);
			if ($res) {
				header("Location:../Users/Pharmacy?msg=Done");
			} else {
				echo mysqli_error($conn);
			}
		}
	}
		while ($row = $result->fetch_assoc()) {
			$id = $row['id'];
			$name = $row['name'];
			$type = $row['type'];
			$price = $row['price'];
			$amount = $row['quant'];
			$sub = $row['sub_price'];
			$now = date("Y-m-d");
			$sql = "SELECT * FROM `pharma_daily_sell` WHERE `id` = '$id' AND `date` = '$now'";
			$rs = $conn->query($sql);
			if ($rs->num_rows > 0) {
				while ($row = $rs->fetch_assoc()) {
					$prev_amount = $row['quan'];
					$price = $row['price'];
					$upd_amount = $prev_amount + $amount;
					$new_price = $price * $upd_amount;
					$upd = "UPDATE `pharma_daily_sell` SET `quan` = '$upd_amount', `sub_price`='$new_price' WHERE `id` = '$id'";
					if (!$conn->query($upd)) {
						echo $conn->error;
					} else {

						$sql = "TRUNCATE TABLE `cart`";
						$res = $conn->query($sql);
						if ($res) {
							header("Location:../Users/Pharmacy?msg=Done");
						} else {
							echo mysqli_error($conn);
						}
					}
				}
			} else {
				$copy = "INSERT INTO `pharma_daily_sell`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`date`) VALUES ('$id', '$name','$type','$price','$amount','$sub','$now') ";
				if ($conn->query($copy)) {

					$sql = "TRUNCATE TABLE `cart`";
					$res = $conn->query($sql);
					if ($res) {
						header("Location:../Users/Pharmacy?msg=Done");
					} else {
						echo mysqli_error($conn);
					}
				}
			}
		}
	
}
// $ssq = "SELECT * FROM cart";
// $result = $conn->query($ssq);
// while ($row = $result->fetch_assoc()) {
// 	$id = $row['id'];
// 	$name = $row['name'];
// 	$type = $row['type'];
// 	$price = $row['price'];
// 	$amount = $row['quant'];
// 	$sub = $row['sub_price'];
// 	$now = date("Y-m-d");
// 	$sql = "SELECT * FROM `pharma_daily_sell` WHERE `id` = '$id' AND `date` = '$now'";
// 	$rs = $conn->query($sql);
// 	if ($rs->num_rows > 0) {
// 		while ($row = $rs->fetch_assoc()) {
// 			$prev_amount = $row['quan'];
// 			$price = $row['price'];
// 			$upd_amount = $prev_amount + $amount;
// 			$new_price = $price * $upd_amount;
// 			$upd = "UPDATE `pharma_daily_sell` SET `quan` = '$upd_amount', `sub_price`='$new_price' WHERE `id` = '$id'";
// 			if (!$conn->query($upd)) {
// 				echo $conn->error;
// 			} else {
// 				$sql = "TRUNCATE TABLE `cart`";
// 				$res = $conn->query($sql);
// 				if ($res) {
// 					header("Location:../Users/Pharmacy");
// 				} else {
// 					echo mysqli_error($conn);
// 				}
// 			}
// 		}
// 	} else {
// 		$copy = "INSERT INTO `pharma_daily_sell`( `id`, `name`, `type`, `price`, `quan`, `sub_price`,`date`) VALUES ('$id', '$name','$type','$price','$amount','$sub','$now') ";
// 		if ($conn->query($copy)) {
// 			$sql = "TRUNCATE TABLE `cart`";
// 			$res = $conn->query($sql);
// 			if ($res) {
// 				header("Location:../Users/Pharmacy");
// 			} else {
// 				echo mysqli_error($conn);
// 			}
// 		}
// 	}
// }
