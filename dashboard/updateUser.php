<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Dohvati JSON podatke iz tijela zahtjeva
    $data = json_decode(file_get_contents('php://input'), true);

    $userId = $data['id'];
    $ime = $data['Ime'];
    $prezime = $data['Prezime'];
    $email = $data['Email'];
    $uloga = $data['Uloga'];

    // Ažuriranje osnovnih podataka u tabeli Osobe
    $query = "UPDATE osobe SET ime = '$ime', Prezime = '$prezime', Email = '$email', Uloga = '$uloga' WHERE ID_Korisnika = '$userId'";

    if (mysqli_query($con, $query)) {
        // Ažuriranje specifičnih podataka ovisno o ulozi
        if ($uloga == 'pacijent') {
            $telefon = $data['Telefon'];
            $medKarton = $data['MedKarton'];
            $query = "UPDATE pacijent SET telefon = '$telefon', med_karton = '$medKarton' WHERE id = '$userId'";
        } else if ($uloga == 'doktor') {
            $odjel = $data['Odjel'];
            $grad = $data['Grad'];
            $query = "UPDATE doktori SET Odjel = '$odjel', grad = '$grad' WHERE id = '$userId'";
        }

        if (mysqli_query($con, $query)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Greška pri ažuriranju specifičnih podataka.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Greška pri ažuriranju osnovnih podataka.']);
    }

    mysqli_close($con);
}
?>
