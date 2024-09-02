<?php
header('Content-Type: application/json');

require_once '../connection.php';
require_once 'pacijentiDashboard.php';

$pacijentiObj = new Pacijenti($con);
$pacijenti = $pacijentiObj->getAllPacijenti();

echo json_encode($pacijenti);
?>
