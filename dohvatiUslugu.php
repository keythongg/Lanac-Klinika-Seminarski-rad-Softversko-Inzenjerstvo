<?php
header('Content-Type: application/json');

require_once 'connection.php';
require_once 'Services.php';


$services = new Services($con);

$ID_odjela = isset($_GET['ID_Odjela']) ? (int)$_GET['ID_Odjela'] : 0;
$serviceList = $services->getServicesByDepartment($ID_odjela);



echo json_encode($serviceList);
?>
