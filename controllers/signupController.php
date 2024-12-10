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
    $name = trim($_POST['name']);
    $first_name = trim($_POST['first_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($name) || empty($first_name) || empty($email) || empty($password)) {
        die("Tous les champs sont requis.");
    }

    $stmt = $pdo->prepare("SELECT * FROM User WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->rowCount() > 0) {
        die("Cet email est déjà utilisé.");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO User (name, first_name, email, password) VALUES (:name, :first_name, :email, :password)");
    $stmt->execute([
        'name' => $name,
        'first_name' => $first_name,
        'email' => $email,
        'password' => $hashedPassword,
    ]);

    echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
}



?>