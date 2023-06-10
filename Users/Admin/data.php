<?php 
	require 'DbConnect.php';
	$today =  date("Y-m-d");
	if(isset($_POST['aid'])) {
		$name = $_POST['aid'];
		$db = new DbConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT * FROM `cash_payment_pharm` WHERE `id` = '$name' AND `date` = '$today'");
		$stmt->execute();
		$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($books);
		if(!$stmt->execute()){
			echo "<script>console.log('error')</script>";
		}
	}

	function loadAuthors() {
		$today = date("Y-m-d");
		$db = new DbConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT DISTINCT * FROM `cash_payment_pharm` WHERE `date` = '$today'");
		$stmt->execute();
		$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $authors;
	}

 ?>