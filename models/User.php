<?php
require_once '../config/Database.php';

class User {
    private $id_user;
    private $firstName;
    private $lastName;
    private $email;
    private $password;

    public function __construct($id_user = null, $firstName = null, $lastName = null, $email = null, $password = null) {
        $this->id_user = $id_user;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }

    // Méthode pour créer un utilisateur
    public static function create($pdo, $firstName, $lastName, $email, $password) {
        $stmt = $pdo->prepare("INSERT INTO Users (FirstName_user, LastName_user, Email_user, Password_user) VALUES (?, ?, ?, ?)");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$firstName, $lastName, $email, $hashedPassword]);
    }

    // Méthode pour récupérer un utilisateur par ID
    public static function getById($pdo, $id_user) {
        $stmt = $pdo->prepare("SELECT * FROM Users WHERE Id_user = ?");
        $stmt->execute([$id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour vérifier l'authentification
    public static function authenticate($pdo, $email, $password) {
        $stmt = $pdo->prepare("SELECT * FROM Users WHERE Email_user = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['Password_user'])) {
            return $user;
        }
        return null;
    }
}
