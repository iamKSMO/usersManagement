<?php
require_once 'models/User.php';
session_start();

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    // Liste des utilisateurs (uniquement pour l'admin)
    public function listUsers() {
        if ($_SESSION['user']['role_name'] !== 'admin') {
            header("Location: dashboard.php");
            exit();
        }
        return $this->userModel->getAllUsers();
    }

    // Modifier un utilisateur
    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $role_id = $_POST['role_id'];
            $status = $_POST['status'];

            $this->userModel->updateUser($id, $username, $email, $role_id, $status);
            header("Location: admin_dashboard.php");
            exit();
        }
    }

    // Supprimer un utilisateur
    public function deleteUser($id) {
        $this->userModel->deleteUser($id);
        header("Location: admin_dashboard.php");
        exit();
    }
}
?>
