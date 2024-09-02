<?php
require_once 'connection.php';
require_once 'Doctors.php';

$doctors = new Doctors($con);

// Pretpostavimo da je ID odjela 1
$ID_Odjela = 1;
$doctorList = $doctors->getDoctorsByDepartment($ID_Odjela);

echo "<pre>";
print_r($doctorList);
echo "</pre>";
?>
