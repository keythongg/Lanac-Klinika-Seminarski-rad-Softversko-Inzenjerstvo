
<?php
class Doctors {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllDoctorsWithDetails() {
        $sql = "SELECT 
                    osobe.ID_Korisnika AS ID, -- Dodajte ID ovdje
                    osobe.ime, 
                    osobe.prezime, 
                    osobe.email, 
                    odjeli.naziv AS odjel, 
                    doktori.grad
                FROM 
                    doktori
                JOIN 
                    osobe ON doktori.id = osobe.ID_Korisnika
                JOIN 
                    odjeli ON doktori.Odjel = odjeli.ID_Odjela
                WHERE 
                    osobe.Uloga = 'doktor'";
        
        $result = $this->db->query($sql);
    
        $doctors = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doctors[] = [
                    'ID' => $row['ID'],         // Dodajte ID u rezultat
                    'Ime' => $row['ime'],
                    'Prezime' => $row['prezime'],
                    'Email' => $row['email'],
                    'Odjel' => $row['odjel'],
                    'Grad' => $row['grad'],
                ];
            }
        }
    
        return $doctors;
    }
    
}
?>