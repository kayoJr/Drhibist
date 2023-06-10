<?php 
	class DbConnect {
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
 ?>