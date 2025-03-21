<?php
require_once __DIR__ . '/../../../config/bd.php';
require_once __DIR__.'/../../models/User.php';
require_once __DIR__.'/../../controllers/AuthController.php';

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$authController = new AuthController($pdo);
$authController->updateUser();
?>