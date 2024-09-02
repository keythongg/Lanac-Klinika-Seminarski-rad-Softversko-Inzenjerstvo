<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../connection.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = intval($data['id']);
    $ime = $data['ime'];
    $prezime = $data['prezime'];
    $email = $data['email'];
    $odjel = $data['odjel'];
    $grad = $data['grad'];

    $sql = "UPDATE osobe INNER JOIN doktori ON osobe.ID_Korisnika = doktori.id 
            SET osobe.ime = ?, osobe.Prezime = ?, osobe.Email = ?, doktori.Odjel = ?, doktori.grad = ? 
            WHERE osobe.ID_Korisnika = ?";

    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param('sssssi', $ime, $prezime, $email, $odjel, $grad, $id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Greška pri izvršavanju SQL upita.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Greška pri pripremi SQL upita.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Podaci nisu dostavljeni.']);
}

$con->close();
?>
