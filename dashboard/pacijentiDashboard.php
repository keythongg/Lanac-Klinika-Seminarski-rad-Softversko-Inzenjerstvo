<?php
class Pacijenti {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllPacijenti() {
        $sql = "SELECT 
                    osobe.ID_Korisnika AS ID, -- Dodajte ID ovdje
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
                    osobe.Uloga = 'pacijent'";
        
        $result = $this->db->query($sql);
    
        $pacijenti = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pacijenti[] = [
                    'ID' => $row['ID'],         // Dodajte ID u rezultat
                    'Ime' => $row['ime'],
                    'Prezime' => $row['prezime'],
                    'Email' => $row['email'],
                    'Telefon' => $row['telefon'],
                    'MedKarton' => $row['med_karton']
                ];
            }
        }
    
        return $pacijenti;
    }
    
}
?>
