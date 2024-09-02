<?php
header('Content-Type: application/json');

require_once '../connection.php';
require_once 'doktoriDashboard.php';

$doctors = new Doctors($con);

$doctorList = $doctors->getAllDoctorsWithDetails();

echo json_encode($doctorList);
?>
