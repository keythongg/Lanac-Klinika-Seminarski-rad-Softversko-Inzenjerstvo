<?php
include '../connection.php';

$doctorId = $_GET['id'] ?? '';

if (empty($doctorId)) {
    echo 'ID doktora nije dostavljen.';
    exit;
}

$doctorId = intval($doctorId);

$sql = "SELECT osobe.Ime, osobe.Prezime, osobe.Email, doktori.Odjel, doktori.Grad 
        FROM osobe INNER JOIN doktori ON osobe.ID_Korisnika = doktori.id 
        WHERE osobe.ID_Korisnika = ?";

if ($stmt = $con->prepare($sql)) {
    $stmt->bind_param('i', $doctorId);
    $stmt->execute();
    $result = $stmt->get_result();
    $doctor = $result->fetch_assoc();
    $stmt->close();
} else {
    echo 'Greška pri pripremi SQL upita.';
    $con->close();
    exit;
}

if (!$doctor) {
    echo 'Nema doktora s tim ID-om.';
    $con->close();
    exit;
}


// Funkcija za dohvaćanje odjela iz baze podataka
function getAllDepartments($db) {
    $sql = "SELECT ID_Odjela, naziv FROM odjeli";
    $result = $db->query($sql);

    $departments = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $departments[] = $row;
        }
    }

    return $departments;
}
$departments = getAllDepartments($con);

$con->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ažuriranje doktora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Ažuriranje doktora</h2>
        <form id="updateForm">
            <input type="hidden" id="updateId" name="id" value="<?= htmlspecialchars($doctorId) ?>">
            <div class="mb-3">
                <label for="updateIme" class="form-label">Ime</label>
                <input type="text" class="form-control" id="updateIme" name="ime" value="<?= htmlspecialchars($doctor['Ime']) ?>">
            </div>
            <div class="mb-3">
                <label for="updatePrezime" class="form-label">Prezime</label>
                <input type="text" class="form-control" id="updatePrezime" name="prezime" value="<?= htmlspecialchars($doctor['Prezime']) ?>">
            </div>
            <div class="mb-3">
                <label for="updateEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="updateEmail" name="email" value="<?= htmlspecialchars($doctor['Email']) ?>">
            </div>
            <div class="mb-3">
            <label for="updateOdjel" class="form-label">Odjel</label>
            <select class="form-select" id="updateOdjel" name="odjel">
                <?php foreach ($departments as $department): ?>
                    <option value="<?= htmlspecialchars($department['ID_Odjela']) ?>" <?= $department['naziv'] === $doctor['Odjel'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($department['naziv']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
            <div class="mb-3">
                <label for="updateGrad" class="form-label">Grad</label>
                <input type="text" class="form-control" id="updateGrad" name="grad" value="<?= htmlspecialchars($doctor['Grad']) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Spremi promjene</button>
        </form>
    </div>
    <script>
        document.getElementById('updateForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            fetch('updateDoctorProcess.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Doktor je uspješno ažuriran.');
                    window.location.href = 'dashboard.php'; // Preusmjeravanje na dashboard ili drugu stranicu
                } else {
                    alert('Greška pri ažuriranju doktora.');
                }
            })
            .catch(error => {
                console.error('Greška pri slanju zahtjeva:', error);
            });
        });
    </script>
</body>
</html>
