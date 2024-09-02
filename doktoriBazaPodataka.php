<?php
header('Content-Type: application/json');

require_once 'connection.php';
require_once 'Doctors.php';

$doctors = new Doctors($con);

$ID_odjela = isset($_GET['ID_Odjela']) ? (int)$_GET['ID_Odjela'] : 0; // Provjera ID_odjela
$doctorList = $doctors->getDoctorsByDepartment($ID_odjela);

echo json_encode($doctorList);
?>
