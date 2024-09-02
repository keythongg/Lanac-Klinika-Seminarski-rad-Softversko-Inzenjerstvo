<?php
class Appointment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function bookAppointment($doctorId, $userId, $serviceId, $date, $time, $message, $status = 1) {
        $sql = "INSERT INTO termini (doktor_id, tretman_id, datum, status, napomena, pacijent_id, vrijeme) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        
        // Definirajte tipove podataka za svaki parametar
        $stmt->bind_param("iisssss", $doctorId, $serviceId, $date, $status, $message, $userId, $time);
        
        if ($stmt->execute()) {
            $response = "Termin uspješno zakazan! Uskoro ćemo Vas kontaktirati. Pratite < Obavijesti > na našoj web aplikaciji.";
        } else {
            $response = "Greška: " . $stmt->error;
        }
        
        $stmt->close();
        return $response;
    }
    
    
    
}
?>


