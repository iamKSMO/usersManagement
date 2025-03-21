<?php
require_once __DIR__ . '/../../config/bd.php';
require_once __DIR__.'/../models/User.php';

session_start();

class AuthController {
    private $pdo;
    private $userModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
    }

    // Gérer l'inscription
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $role = $_POST['role'] ?? 'client'; // Par défaut, rôle "client"

            // Vérifier si l'email existe déjà
            if ($this->userModel->emailExists($email)) {
                echo "Erreur : cet email est déjà utilisé.";
                return;
            }

            // Enregistrer l'utilisateur
            if ($this->userModel->register($username, $email, $password, $role)) {
                header("Location: /usersManagement/app/views/user/profile.php");
                exit;
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    }

    // Gérer la connexion
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $user = $this->userModel->login($email, $password);
            

            if ($user) {
                $_SESSION['user'] = $user;

                // enregistrer la connexion dans la table sessions 
                $sessionId = $this->userModel->logUserSession($user['id']);

                // on stocke l' id de la session en cours
                $_SESSION['session_id'] = $sessionId;

                // Option "Se souvenir de moi"
                if (isset($_POST['remember'])) {
                    setcookie("email", $email, time() + 3600 * 24 * 30, "/"); // Cookie pour 30 jours
                }

                // Redirection selon le rôle
                if ($user['role_name'] == 'admin') {
                    header("Location: /usersManagement/app/views/admin/dashboard.php");
                    echo "vous etes connectés admin";
                } else {
                    header("Location: /usersManagement/app/views/user/profile.php");
                    echo "vous etes connectés client";
                }
                exit;
            } else {
                echo "Email ou mot de passe incorrect.";
            }
        }
    }

    


    // modifications du profil
public function updateUser() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = $_SESSION['user']['id'];
        $username = trim($_POST['usernameU']);
        $email = trim($_POST['emailU']);

        // Vérifier si les champs sont remplis
        if (empty($username) || empty($email)) {
            echo "Tous les champs sont obligatoires.";
            return;
        }

        // Mise à jour des informations
        $updated = $this->userModel->updateUserInfo($userId, $username, $email);

        if ($updated) {
            // Mettre à jour la session
            $_SESSION['user']['username'] = $username;
            $_SESSION['user']['email'] = $email;

            // Redirection vers le profil
            header("Location: profile.php");
            exit;
        } else {
            echo "Erreur lors de la mise à jour.";
        }
    }
}

// Afficher l'historique des connexions
public function showLoginHistory() {
    // Vérifie si l'utilisateur est connecté
    if (isset($_SESSION['user']['id'])) {
        $userId = $_SESSION['user']['id'];

        // Récupérer l'historique des connexions de l'utilisateur
        $loginHistory = $this->userModel->getLoginHistory($userId);

        // Passer l'historique des connexions à la vue
        require_once __DIR__ . '/../views/user/profile.php';
    } else {
        // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
        header("Location: /login.php");
        exit;
    }
}

}

// Afficher les informations personnelles de l'utilisateur
// public function showUserInfo($userId) {
//     $userInfo = $this->userModel->getUserInfo($userId);
//     return $userInfo;
// }



?>
