<?php
class TretmaniDashboard {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllServices() {
        // Ispravljeni SQL upit
        $sql = "SELECT 
                    tretmani.id,
                    tretmani.naziv,
                    tretmani.cijena,
                    tretmani.grad,
                    odjeli.Naziv AS odjel
                FROM tretmani 
                JOIN odjeli ON tretmani.Odjel = odjeli.ID_Odjela";
    
        $result = $this->db->query($sql);
        $services = []; // Inicijalizacija niza
    
        if (!$result) {
            die('Greška u upitu: ' . $this->db->error);
        }
    
        while ($row = $result->fetch_assoc()) {
            $services[] = [  // Ispravka: koristi se $services, a ne $appointments
                'id' => $row['id'],
                'naziv' => $row['naziv'],
                'cijena' => $row['cijena'],
                'grad' => $row['grad'],
                'odjel' => $row['odjel']
            ];
        }
    
        return $services;
    }
}
?>
