<?php
require_once __DIR__ . '/../../config/bd.php'; // Connexion à la base de données

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Vérifier si un email existe déjà
    public function emailExists($email) {
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch() ? true : false;
    }

    // Ajouter un nouvel utilisateur
    public function register($username, $email, $password, $role) {
        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Récupérer l'ID du rôle
        $stmt = $this->pdo->prepare("SELECT id FROM roles WHERE name = ?");
        $stmt->execute([$role]);
        $roleData = $stmt->fetch();
        
        if (!$roleData) {
            return false; // Rôle inexistant
        }

        $roleId = $roleData['id'];

        // Insérer l'utilisateur
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, role_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword, $roleId]);
    }
}
?>
