<?php
include '../connection.php';

// Provjerite je li ID pacijenta poslan
$patientId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($patientId > 0) {
    // Dohvatite podatke pacijenta
    $sql = "SELECT 
                osobe.ID_Korisnika AS ID,
                osobe.ime,
                osobe.prezime,
                osobe.email,
                pacijent.telefon,
                pacijent.med_karton
            FROM 
                osobe
            JOIN 
                pacijent ON osobe.ID_Korisnika = pacijent.id
            WHERE 
                osobe.ID_Korisnika = ?";
    
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param('i', $patientId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $patient = $result->fetch_assoc();
        } else {
            echo 'Nema pacijenta s tim ID-om.';
            exit();
        }
    } else {
        echo 'Greška pri pripremi SQL upita.';
        exit();
    }
} else {
    echo 'Nevažeći ID pacijenta.';
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ažuriraj Pacijenta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Ažuriraj Pacijenta</h2>
        <form action="updatePatientProcess.php" method="post">
            <input type="hidden" name="ID" value="<?php echo $patient['ID']; ?>">
            <div class="mb-3">
                <label for="ime" class="form-label">Ime</label>
                <input type="text" class="form-control" id="ime" name="ime" value="<?php echo $patient['ime']; ?>">
            </div>
            <div class="mb-3">
                <label for="prezime" class="form-label">Prezime</label>
                <input type="text" class="form-control" id="prezime" name="prezime" value="<?php echo $patient['prezime']; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $patient['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="telefon" class="form-label">Telefon</label>
                <input type="text" class="form-control" id="telefon" name="telefon" value="<?php echo $patient['telefon']; ?>">
            </div>
            <div class="mb-3">
                <label for="medKarton" class="form-label">Med Karton</label>
                <input type="text" class="form-control" id="medKarton" name="medKarton" value="<?php echo $patient['med_karton']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Spremi promjene</button>
        </form>
    </div>
</body>
</html>
