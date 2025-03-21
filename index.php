<?php
require_once __DIR__.'/config/bd.php';
require_once __DIR__.'/app/controllers/AuthController.php';

 $authController = new AuthController($pdo);

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
    case 'register':
        $authController->register();
        break;
    case 'login':
        $authController->login();
        break;
    default:
        require 'app/views/authentification/register.php';
        break;
}
?>
