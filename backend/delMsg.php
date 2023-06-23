<?php
require './db.php';
$id = $_GET['id'];

$sql = "DELETE FROM `nurse_message` WHERE `id` = '$id'";

if ($conn->query($sql)) {
    // Return a success response
    echo "Item deleted successfully";
} else {
    // Return an error response
    echo "Error deleting item: " . $conn->error;
}

$conn->close();
