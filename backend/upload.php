<?php
require 'db.php';

if (isset($_POST['upload'])) {

	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "../img/Screenshots/" . $filename;
	$pat_id = $_POST['pat_id'];
	$s = "miki";

	$sql = "INSERT INTO `cmc_ps` ( `patient_id` , `filename`) VALUES ('$pat_id', '$filename')";


	$up = $conn->query($sql);

	if ($up) {

		$sqld = "DELETE FROM `lab_cart2` WHERE `name`='CBC'  AND `patient_id` = '$pat_id'";
		$rsd = $conn->query($sqld);
		if ($rsd) {
			if (move_uploaded_file($tempname, $folder)) {
				header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
			} else {
				header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
			}
		} else {
			echo mysqli_error($conn);
		}
	}
} else if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$date = date('Y-m-d');
	$sql = $conn->query("SELECT * FROM `cbc` WHERE `patient_id` = '$id' AND `date` = '$date'");
	if ($sql->num_rows > 0) {
		$sqld = "DELETE FROM `lab_cart2` WHERE `name`='CBC'  AND `patient_id` = '$id'";
		$rsd = $conn->query($sqld);
		if ($rsd) {
			header("Location: ../Users/Laboratory/index.php?search=$id&searching=Search&msg=Sent");
		} else {
			header("Location: ../Users/Laboratory/index.php?search=$id&searching=Search?msg=Error");
		}
	}
}
