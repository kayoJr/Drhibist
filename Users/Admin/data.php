<?php 
	require 'DbConnect.php';

	if(isset($_POST['aid'])) {
		$name = $_POST['aid'];
		$db = new DbConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT * FROM `pharma_daily_sell` WHERE `id` = '$name'");
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
		$stmt = $conn->prepare("SELECT DISTINCT * FROM `pharma_daily_sell` WHERE `date` = '$today'");
		$stmt->execute();
		$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $authors;
	}

 ?>