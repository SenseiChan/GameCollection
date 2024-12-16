<?php

require_once 'models/User.php';

class LoginController {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function display() {
        require 'views/users/Login.php';
    }

    public function handleLogin() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (empty($email) || empty($password)) {
                echo "Tous les champs sont requis.";
                return;
            }

            $stmt = $this->pdo->prepare("SELECT * FROM User WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_first_name'] = $user['first_name'];

                header('Location: index.php');
                exit;
            } else {
                echo "Email ou mot de passe incorrect.";
            }
        }
    }
}

?>
