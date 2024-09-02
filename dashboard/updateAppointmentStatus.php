<?php
require_once '../connection.php';

$data = json_decode(file_get_contents('php://input'), true);
$terminId = $data['id'];
$newStatus = $data['status'];

$sql = "UPDATE termini SET status = ? WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $newStatus, $terminId);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

$stmt->close();
echo json_encode($response);
?>
