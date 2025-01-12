<?php
// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Démarrage de la session

require_once 'config/Database.php'; // Chargement de la configuration de la base de données

// Récupération de l'URL réécrite
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$params = explode('/', $url);

// Vérification de la connexion de l'utilisateur
$isLoggedIn = isset($_SESSION['user_id']);

// Déterminer le contrôleur et l'action
if (empty($url)) {
    $controllerName = $isLoggedIn ? 'LibraryController' : 'LoginController';
    $actionName = 'display';
} else {
    $controllerName = ucfirst($params[0]) . 'Controller';
    $actionName = !empty($params[1]) ? $params[1] : 'display';
}

$pdo = Database::getConnection(); // Connexion à la base de données
$controllerFile = 'controllers/' . $controllerName . '.php';

if (!$isLoggedIn && $controllerName !== 'SignupController' && $controllerName !== 'LoginController') {
    header('Location: /login');
    exit;
} elseif (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName($pdo); // Instanciation du contrôleur

    // Exécution de l'action si elle existe
    if (method_exists($controller, $actionName)) {
        $controller->$actionName(array_slice($params, 2));
    } else {
        http_response_code(404);
        echo "L'action $actionName n'a pas été trouvée dans le contrôleur $controllerName.";
    }
} else {
    header('Location: /Library');
}