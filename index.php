<?php
require_once __DIR__.'/config/bd.php';
require_once __DIR__.'/app/controllers/AuthController.php';

 $authController = new AuthController($pdo);

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action) {
    case 'register':
        $authController->register();
        break;
    default:
        require 'app/views/authentification/register.php';
        break;
}
?>
