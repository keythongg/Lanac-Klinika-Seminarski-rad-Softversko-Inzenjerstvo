<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllUsers() {
        $sql = "SELECT ID_Korisnika, ime, Prezime, Password, Email, Uloga  
                FROM osobe";
        $result = $this->db->query($sql);

        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = [
                    'ID' => $row['ID_Korisnika'],
                    'Ime' => $row['ime'],
                    'Prezime' => $row['Prezime'],
                    'Password' => $row['Password'],
                    'Email' => $row['Email'],
                    'Uloga' => $row['Uloga'],
                ];
            }
        }

        return $users;
    }
}
?>
