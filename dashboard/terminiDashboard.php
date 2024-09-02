<?php
class TerminiDashboard {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllAppointments() {
        $sql = "SELECT 
                    termini.id, 
                    termini.pacijent_id, 
                    termini.doktor_id,  
                    termini.datum, 
                    termini.napomena, 
                    termini.vrijeme, 
                    tretmani.naziv AS tretman,
                    statusi.Stanje AS status, 
                    pacijenti.ime AS pacijent_ime, 
                    pacijenti.prezime AS pacijent_prezime,
                    doktori.ime AS doktor_ime, 
                    doktori.prezime AS doktor_prezime
                FROM termini
                JOIN statusi ON termini.status = statusi.ID_Statusa
                JOIN osobe AS pacijenti ON termini.pacijent_id = pacijenti.ID_Korisnika
                JOIN osobe AS doktori ON termini.doktor_id = doktori.ID_Korisnika
                JOIN tretmani ON termini.tretman_id=tretmani.id ";
    
        $result = $this->db->query($sql);
        $appointments = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $appointments[] = [
                    'id' => $row['id'],
                    'pacijent_id' => $row['pacijent_id'],
                    'pacijent_ime' => $row['pacijent_ime'] . ' ' . $row['pacijent_prezime'],
                    'doktor_id' => $row['doktor_id'],
                    'doktor_ime' => $row['doktor_ime'] . ' ' . $row['doktor_prezime'],
                    'tretman_id' => $row['tretman'],
                    'datum' => $row['datum'],
                    'napomena' => $row['napomena'],
                    'vrijeme' => $row['vrijeme'],
                    'status' => $row['status']
                ];
            }
        }
    
        return $appointments;
    }
    
}
?>
