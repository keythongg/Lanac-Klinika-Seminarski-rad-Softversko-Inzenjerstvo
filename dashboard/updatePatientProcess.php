<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['ID']);
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $medKarton = $_POST['medKarton'];

    // Priprema SQL upita za ažuriranje
    $sql = "UPDATE osobe 
            JOIN pacijent ON osobe.ID_Korisnika = pacijent.id
            SET osobe.ime = ?, osobe.prezime = ?, osobe.email = ?, pacijent.telefon = ?, pacijent.med_karton = ?
            WHERE osobe.ID_Korisnika = ?";

    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param('sssssi', $ime, $prezime, $email, $telefon, $medKarton, $id);
        if ($stmt->execute()) {
            echo 'Podaci su uspješno ažurirani.';
        } else {
            echo 'Greška pri ažuriranju podataka: ' . $stmt->error;
        }
    } else {
        echo 'Greška pri pripremi SQL upita.';
    }
    $stmt->close();
    $con->close();
}
?>
