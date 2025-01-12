<?php

class ProfileController {
    private $pdo;
    private $userId;
    private $prenom;
    private $nom;
    private $email;

    public function __construct($pdo, $userId) {
        $this->pdo = $pdo;
        $this->userId = $userId;
        $this->loadUserData();
    }

    // Charger les données de l'utilisateur à partir de la base de données
    private function loadUserData() {
        if ($this->userId) {
            try {
                $sql = "SELECT FirstName_user, Email_user, Password_user, LastName_user FROM User WHERE id_user = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id', $this->userId, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $this->prenom = $result['FirstName_user'];
                    $this->email = $result['Email_user'];
                    $this->nom = $result['LastName_user'];
                }
            } catch (PDOException $e) {
                die("Erreur lors de la requête : " . $e->getMessage());
            }
        }
    }

    // Gérer la mise à jour du profil utilisateur
    public function handleUpdateProfile($data) {
        if ($this->userId && isset($data['submit'])) {
            $newPrenom = $data['prenom'];
            $newNom = $data['nom'];
            $newEmail = $data['email'];
            $newPassword = !empty($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : null;

            try {
                $updateSql = "UPDATE User SET Email_user = :email, FirstName_user = :prenom, LastName_user = :nom";

                if ($newPassword) {
                    $updateSql .= ", Password_user = :password";
                }

                $updateSql .= " WHERE id_user = :id";

                $updateStmt = $this->pdo->prepare($updateSql);
                $updateStmt->bindParam(':email', $newEmail, PDO::PARAM_STR);
                $updateStmt->bindParam(':prenom', $newPrenom, PDO::PARAM_STR);
                $updateStmt->bindParam(':nom', $newNom, PDO::PARAM_STR);
                $updateStmt->bindParam(':id', $this->userId, PDO::PARAM_INT);

                if ($newPassword) {
                    $updateStmt->bindParam(':password', $newPassword, PDO::PARAM_STR);
                }

                $updateStmt->execute();

                // Mettre à jour les variables d'instance
                $this->prenom = $newPrenom;
                $this->nom = $newNom;
                $this->email = $newEmail;

                return "<p>Mise à jour réussie !</p>";
            } catch (PDOException $e) {
                return "<p>Erreur lors de la mise à jour : " . $e->getMessage() . "</p>";
            }
        }
    }

    // Gérer la suppression du compte utilisateur
    public function handleDeleteAccount() {
        if ($this->userId && isset($_POST['delete_account'])) {
            try {
                $deleteSql = "DELETE FROM User WHERE id_user = :id";
                $deleteStmt = $this->pdo->prepare($deleteSql);
                $deleteStmt->bindParam(':id', $this->userId, PDO::PARAM_INT);
                $deleteStmt->execute();

                session_destroy();
                header("Location: signup.php");
                exit;
            } catch (PDOException $e) {
                return "<p>Erreur lors de la suppression : " . $e->getMessage() . "</p>";
            }
        }
    }

    // Gérer la déconnexion de l'utilisateur
    public function handleLogout() {
        if (isset($_POST['logout'])) {
            session_destroy();
            header("Location: Login.php");
            exit;
        }
    }

    // Récupérer les informations utilisateur
    public function getUserInfo() {
        return [
            'prenom' => $this->prenom,
            'nom' => $this->nom,
            'email' => $this->email
        ];
    }
}
?>
