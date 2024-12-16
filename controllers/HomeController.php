<?php
session_start();

// Connexion à la base de données
$host = 'localhost';
$dbname = 'game-collection';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connection.php"); // Rediriger vers la page de connexion
    exit();
}

$user_id = $_SESSION['user_id'];
$prenom = ''; // Valeur par défaut pour éviter "Undefined variable"

try {
    $stmt = $pdo->prepare("SELECT FirstName_user FROM users WHERE id_user = :id");
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && !empty($user['FirstName_user'])) {
        $prenom = htmlspecialchars($user['FirstName_user']);
    }
} catch (PDOException $e) {
    $prenom = ''; // Assigner une valeur par défaut même en cas d'erreur
}


// Récupérer les jeux de l'utilisateur
$jeux = [];
try {
    $stmt = $pdo->prepare("SELECT title, platform, playtime, image_url FROM games WHERE user_id = :id");
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $jeux = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des jeux : " . $e->getMessage());
}

// Inclure la vue HTML
include 'views/home.php';
?>
