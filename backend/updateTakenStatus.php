<?php
require './db.php';

$data = json_decode(file_get_contents("php://input"), true);
$prescriptionId = $data['prescriptionId'];
$takenStatus = $data['takenStatus'];

$updateQuery = $conn->prepare("UPDATE `prescription` SET `taken` = ? WHERE `id` = ?");
$updateQuery->bind_param("ii", $takenStatus, $prescriptionId);

$response = [];
if ($updateQuery->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);
?>