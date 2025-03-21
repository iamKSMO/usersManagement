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

    public function login($email, $password) {
        $sql = "SELECT users.*, roles.name AS role_name FROM users 
                JOIN roles ON users.role_id = roles.id 
                WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($password, $user['password'])) {
            return $user;
            print_r($user);
        }
        return false;
    }

    // Récupérer les informations personnelles de l'utilisateur
    public function getUserInfo($userId) {
        try {
            $sql = "SELECT users.id, users.username, users.email, roles.name AS role_name 
                FROM users 
                JOIN roles ON users.role_id = roles.id
                WHERE users.id = :userId";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['userId' => $userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la recuperation des informations". $e->getMessage();
            return false;
        }
        
    }

    // modifier les informations
    public function updateUserInfo($userId, $username, $email) {
        try {
            $sql = "UPDATE users SET username = :username, email = :email WHERE id = :userId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'username' => $username,
                'email' => $email,
                'userId' => $userId
            ]);
            return true; // Succès
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }

    // Enregistrer une connexion
public function logUserSession($userId) {
    $sql = "INSERT INTO sessions (user_id, login_time) VALUES (:user_id, NOW())";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);

    return $this->pdo->lastInsertId(); // Retourne l'ID de la session créée
}

// Enregistrer une déconnexion
public function logUserLogout($sessionId) {
    $sql = "UPDATE sessions SET logout_time = NOW() WHERE id = :session_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['session_id' => $sessionId]);
}

// Récupérer l'historique de connexion d'un utilisateur
public function getLoginHistory($userId) {
    $sql = "SELECT login_time, logout_time FROM sessions WHERE user_id = :userId ORDER BY login_time DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['userId' => $userId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    
    
}
?>
