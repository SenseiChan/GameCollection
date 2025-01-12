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

    public function display() {
        // Préparez les données utilisateur
        $id = $this->userId;
        $Prenom = $this->prenom;
        $Nom = $this->nom;
        $Email = $this->email;
    
        // Chargez la vue avec les variables nécessaires
        require_once __DIR__ . '/../views/users/Profile.php';
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
            var_dump($data);
            exit;
            $newPrenom = trim($data['prenom']);
            $newNom = trim($data['nom']);
            $newEmail = trim($data['email']);
            $newPassword = !empty($data['password']) ? password_hash(trim($data['password']), PASSWORD_DEFAULT) : null;
    
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
    
                // Rediriger vers la page de profil avec un message de succès
                header('Location: /profile?success=1');
                exit;
            } catch (PDOException $e) {
                // Afficher l'erreur
                echo "<p>Erreur lors de la mise à jour : " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p>Erreur : Données soumises incorrectes ou utilisateur non connecté.</p>";
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
        // Détruire la session pour déconnecter l'utilisateur
        session_destroy();
    
        // Rediriger l'utilisateur vers la page de connexion
        header("Location: /login");
        exit;
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
