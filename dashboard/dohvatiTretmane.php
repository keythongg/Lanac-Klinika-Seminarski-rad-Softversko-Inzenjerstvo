<?php
header('Content-Type: application/json');

require_once '../connection.php';
require_once 'tretmaniDashboard.php';

$tretmaniDashboard = new TretmaniDashboard($con);
$services = $tretmaniDashboard->getAllServices();

echo json_encode($services);
?>
