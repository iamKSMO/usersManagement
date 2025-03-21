<?php
require_once __DIR__ . '/../../../config/bd.php'; 
require_once __DIR__ . '/../../models/User.php';


// Gérer la déconnexion
    // Vérifie si l'utilisateur est connecté
    if (isset($_SESSION['user']['id'])) {
        $userId = $_SESSION['user']['id'];

        // Mettre à jour la table sessions pour enregistrer l'heure de déconnexion
        $stmt = $this->pdo->prepare("UPDATE sessions SET logout_time = NOW() WHERE user_id = :userId AND logout_time IS NULL");
        $stmt->execute(['userId' => $userId]);

        // Détruire la session
        session_destroy();
        setcookie("email", "", time() - 3600, "/"); // Supprimer le cookie

        // Redirection après déconnexion
        header("Location: /login.php");
        exit;
    }

// Détruire la session
session_destroy();

// Supprimer le cookie "email" (si l'option "se souvenir de moi" a été utilisée)
setcookie("email", "", time() - 3600, "/");

// Redirection vers la page de connexion
header("Location: /usersManagement/app/views/authentification/login.php");
exit;
?>
