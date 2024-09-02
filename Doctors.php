<?php
class Doctors {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getDoctorsByDepartment($departmentId) {
        $sql = "SELECT osobe.ID_Korisnika, osobe.ime, osobe.Prezime, doktori.grad
                FROM osobe
                JOIN doktori ON osobe.ID_Korisnika = doktori.id
                WHERE osobe.Uloga = 'doktor' 
                AND doktori.Odjel = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $departmentId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $doctors = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doctors[] = [
                    'ID' => $row['ID_Korisnika'],
                    'Ime' => $row['ime'],
                    'Prezime' => $row['Prezime'],
                    'Grad' => $row['grad'] // Dodajte lokaciju ili koristite "Grad"
                ];
            }
        }
    
        $stmt->close();
        return $doctors;
    }
    
    public function getAllDoctors() {
        $sql = "SELECT ID_Korisnika, ime, Prezime  
        FROM osobe 
        WHERE Uloga = 'doktor'";
        $result = $this->db->query($sql);

        $doctors = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doctors[] = [
                    'ID' => $row['ID_Korisnika'],
                    'Ime' => $row['ime'],
                    'Prezime' => $row['Prezime'],
                ];
            }
        }

        return $doctors;
    }
}
?>