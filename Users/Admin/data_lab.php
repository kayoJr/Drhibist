<?php 
	class DbConnection {
		private $host = 'localhost';
		private $dbName = 'drhibistpedriati_drhibist';
		private $user = 'drhibistpedriati_root';
		private $pass = '8T75YLCACKWe5Ep';

		public function connect() {
			try {
				$conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbName, $this->user, $this->pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch( PDOException $e) {
				echo 'Database Error: ' . $e->getMessage();
			}
		}
	}
	$today =  date("Y-m-d");
	if(isset($_POST['aid'])) {
		$name = $_POST['aid'];
		$db = new DbConnection;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT * FROM `laboratory` WHERE `id` = '$name'");
		$stmt->execute();
		$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($books);
		if(!$stmt->execute()){
			echo "<script>console.log('error')</script>";
		}
	}

	function loadLab() {
		$today = date("Y-m-d");
		$db = new DbConnection;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT * FROM `laboratory` ");
		$stmt->execute();
		$systems = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $systems;
	}

 ?>