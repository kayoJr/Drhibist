<?php
require 'db.php';
	$sql = "TRUNCATE TABLE `cart`";
	$res = $conn->query($sql);
	if($res){
		header("Location:../Users/Pharmacy");
	}else{
		echo mysqli_error($conn);
	}
