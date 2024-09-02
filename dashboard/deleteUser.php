<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../connection.php';

header('Content-Type: application/json');

// Pročitajte sirovi JSON ulaz
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $userId = intval($data['id']);

    // Provjerite korisnika s tim ID-om prije brisanja
    $checkSql = "SELECT * FROM osobe WHERE ID_Korisnika = ?";
    if ($stmt = $con->prepare($checkSql)) {
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            echo json_encode(['success' => false, 'error' => 'Nema korisnika s tim ID-om.']);
            $stmt->close();
            $con->close();
            exit();
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Greška pri pripremi SQL upita za provjeru.']);
        $con->close();
        exit();
    }

    // SQL za brisanje korisnika
    $sql = "DELETE FROM osobe WHERE ID_Korisnika = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param('i', $userId);
        if ($stmt->execute()) {
            $affectedRows = $stmt->affected_rows;
            if ($affectedRows > 0) {
                echo json_encode(['success' => true, 'affectedRows' => $affectedRows]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Nijedan redak nije izbrisan.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Greška pri izvršavanju SQL upita: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Greška pri pripremi SQL upita: ' . $con->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'ID korisnika nije dostavljen.']);
}

$con->close();
?>
