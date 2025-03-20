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
                header("Location: /usersManagement/app/views/authentification/login.php");
                exit;
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    }

    // Gérer la connexion
//     public function login() {
//         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//             $email = trim($_POST['email']);
//             $password = $_POST['password'];

//             $user = $this->userModel->login($email, $password);

//             if ($user) {
//                 $_SESSION['user'] = $user;

//                 // Option "Se souvenir de moi"
//                 if (isset($_POST['remember'])) {
//                     setcookie("email", $email, time() + 3600 * 24 * 30, "/"); // Cookie pour 30 jours
//                 }

//                 // Redirection selon le rôle
//                 if ($user['role_name'] == 'admin') {
//                     header("Location: /admin/dashboard.php");
//                 } else {
//                     header("Location: /client/profile.php");
//                 }
//                 exit;
//             } else {
//                 echo "Email ou mot de passe incorrect.";
//             }
//         }
//     }

//     // Gérer la déconnexion
//     public function logout() {
//         session_destroy();
//         setcookie("email", "", time() - 3600, "/"); // Supprime le cookie
//         header("Location: /login.php");
//         exit;
//     }
// }

// // Instanciation du contrôleur
// $authController = new AuthController($pdo);

// // Déterminer l'action en fonction de la requête
// if (isset($_GET['action'])) {
//     $action = $_GET['action'];

//     if ($action === 'register') {
//         $authController->register();
//     } elseif ($action === 'login') {
//         $authController->login();
//     } elseif ($action === 'logout') {
//         $authController->logout();
//     }
}
?>
