<?php 
	require 'DbConnect.php';

	if(isset($_POST['aid'])) {
		$name = $_POST['aid'];
		$db = new DbConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT * FROM `medicines` WHERE `med_id` = '$name'");
		$stmt->execute();
		$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($books);
	}

	function loadAuthors() {
		$db = new DbConnect;
		$conn = $db->connect();

		$stmt = $conn->prepare("SELECT DISTINCT name, med_id FROM `medicines`");
		$stmt->execute();
		$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $authors;
	}

 ?>