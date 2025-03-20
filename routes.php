<?php

$routes = [
    '/' => 'views/register.php',  // Page d'inscription
    '/register' => 'controllers/AuthController.php@register',
    '/login' => 'views/login.php',
    '/auth/login' => 'controllers/AuthController.php@login',
    '/logout' => 'controllers/AuthController.php@logout',
];

return $routes;
?>