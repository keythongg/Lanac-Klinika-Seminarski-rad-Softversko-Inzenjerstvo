<?php
header('Content-Type: application/json');

require_once '../connection.php';
require_once 'terminiDashboard.php';

$terminiDashboard = new TerminiDashboard($con);
$appointments = $terminiDashboard->getAllAppointments();

echo json_encode($appointments);
?>
