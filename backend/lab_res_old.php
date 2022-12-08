<?php
require 'db.php';

if (isset($_POST['upload'])) {

	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "../img/CBC/" . $filename;
	$pat_id= $_POST['pat_id'];
	$s="miki";
//	echo $filename;

	$sql = "INSERT INTO `cmc_ps` ( `patient_id` , `filename`) VALUES ('$pat_id','$filename')";

	
	$up= $conn->query($sql);	

	if($up){
		if (move_uploaded_file($tempname, $folder)) {
			header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
		} else {
			header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
	}
 }else{
 		echo mysqli_error($conn);
 	}
}
