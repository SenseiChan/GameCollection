<?php
session_start();

$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_DBNAME'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
        die("Tous les champs sont requis.");
    }

    $stmt = $pdo->prepare("SELECT * FROM Utilisateur WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->rowCount() > 0) {
        die("Cet email est déjà utilisé.");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO Utilisateur (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)");
    $stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'mot_de_passe' => $hashedPassword,
    ]);

    echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
}



?>