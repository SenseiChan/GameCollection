<?php
// Activer l'affichage des erreurs (à désactiver en production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Démarre la session
session_start();

// Chargement des dépendances
require_once 'config/Database.php';

// Récupération du paramètre 'url' qui contient l'URL réécrite
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$params = explode('/', $url);

// Détermine le contrôleur et l'action à partir de l'URL
// Exemple : /login -> Controller = LoginController, Action = index
//           /login/show -> Controller = LoginController, Action = show
$controllerName = !empty($params[0]) ? ucfirst($params[0]) . 'Controller' : null;
$actionName = !empty($params[1]) ? $params[1] : 'display';

// Instancier la connexion à la base de données
$pdo = Database::getConnection();

// Chemin vers le fichier du contrôleur
$controllerFile = 'controllers/' . $controllerName . '.php';

// Vérifier si le contrôleur existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Instancier le contrôleur
    $controller = new $controllerName($pdo);

    // Vérifier si l'action (méthode) existe dans le contrôleur
    if (method_exists($controller, $actionName)) {
        // Appeler l'action avec les paramètres restants
        $controller->$actionName(array_slice($params, 2));
    } else {
        // Action introuvable
        http_response_code(404);
        echo "L'action $actionName n'a pas été trouvée dans le contrôleur $controllerName.";
    }
} else {
    // Contrôleur introuvable
    http_response_code(404);
    echo "Le contrôleur $controllerName est introuvable.";
}
