<?php

require_once 'controllers/ConnectionController.php';
require_once 'controllers/SignupController.php';

// Création des instances des contrôleurs
$controllerConnection = new ConnectionController();
$controllerSignup = new SignupController();

// Définir la route en fonction de l'URL
$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri === '/login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    // Afficher la page de connexion
    $controllerConnection->displayConnection();
} elseif ($requestUri === '/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traiter la soumission du formulaire de connexion
    $controllerConnection->handleLogin();
} elseif ($requestUri === '/signup' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    // Afficher la page d'inscription
    $controllerSignup->displaySignup();
} elseif ($requestUri === '/signup' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traiter la soumission du formulaire d'inscription
    $controllerSignup->handleSignup();
} else {
    // Route par défaut ou erreur 404
    http_response_code(404);
    echo "Page non trouvée.";
}

?>
