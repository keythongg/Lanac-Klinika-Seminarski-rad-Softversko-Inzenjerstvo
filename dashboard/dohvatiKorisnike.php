<?php
header('Content-Type: application/json');

require_once '../connection.php';
require_once 'Korisnici.php';

$user = new User($con);

$allUsers = $user->getAllUsers();

echo json_encode($allUsers);
?>
