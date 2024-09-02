<?php
class Departments {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllDepartments() {
        $sql = "SELECT * FROM odjeli";
        $result = $this->db->query($sql);

        $departments = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $departments[] = [
                    'ID' => $row['ID_Odjela'],
                    'Naziv' => $row['Naziv']
                ];
            }
        }

        return $departments;
    }
}
?>
