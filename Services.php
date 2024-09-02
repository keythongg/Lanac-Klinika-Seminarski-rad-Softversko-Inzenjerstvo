<?php
class Services {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getServicesByDepartment($departmentId) {
        $sql = "SELECT id, naziv FROM tretmani WHERE Odjel = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $departmentId);
        $stmt->execute();
        $result = $stmt->get_result();

        $services = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $services[] = [
                    'ID' => $row['id'],
                    'Naziv' => $row['naziv'],
                ];
            }
        }

        $stmt->close();
        return $services;
    }
}
?>
