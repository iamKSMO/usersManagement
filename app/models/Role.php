<?php
require_once 'config/database.php';

class Role {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupérer tous les rôles
    public function getAllRoles() {
        $sql = "SELECT * FROM roles";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
?>
