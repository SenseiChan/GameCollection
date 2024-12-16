<?php

class SignupController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function display() {
        require 'views/users/Signup.php';
    }

    public function handleSignup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $first_name = trim($_POST['first_name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (empty($name) || empty($first_name) || empty($email) || empty($password)) {
                echo "Tous les champs sont requis.";
                return;
            }

            $stmt = $this->pdo->prepare("SELECT * FROM User WHERE Email_user = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->rowCount() > 0) {
                echo "Cet email est déjà utilisé.";
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare("INSERT INTO User (LastName_user, FistName_user, Email_user, Password_user) VALUES (:name, :first_name, :email, :password)");
            $stmt->execute([
                'name' => $name,
                'first_name' => $first_name,
                'email' => $email,
                'password' => $hashedPassword,
            ]);

            echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            header('Location: connection.php'); // Redirigez vers la page de connexion
            exit;
        }
    }
}

?>
