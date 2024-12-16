<?php

class HomeController {
    private $pdo;
    private $userId;
    private $userFirstName;
    private $games;

    // Le constructeur prend une instance de PDO et l'ID de l'utilisateur connecté
    public function __construct($pdo, $userId) {
        $this->pdo = $pdo;
        $this->userId = $userId;
        $this->userFirstName = $this->getUserFirstName();
        $this->games = $this->getUserGames();
    }

    // Récupérer le prénom de l'utilisateur
    private function getUserFirstName() {
        try {
            $stmt = $this->pdo->prepare("SELECT FirstName_user FROM users WHERE id_user = :id");
            $stmt->bindParam(':id', $this->userId, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user ? htmlspecialchars($user['FirstName_user']) : '';
        } catch (PDOException $e) {
            return ''; // En cas d'erreur, renvoie une chaîne vide
        }
    }

    // Récupérer les jeux de l'utilisateur
    private function getUserGames() {
        try {
            $stmt = $this->pdo->prepare("SELECT title, platform, playtime, image_url FROM games WHERE user_id = :id");
            $stmt->bindParam(':id', $this->userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des jeux : " . $e->getMessage());
        }
    }

    // Fonction pour afficher la page d'accueil
    public function display() {
        // Inclure la vue de la page d'accueil (home.php)
        include 'views/home.php';
    }

    // Gérer la logique liée à l'affichage des informations utilisateur (prénom et jeux)
    public function handle() {
        // Ici, on peut gérer des actions ou des erreurs liées à l'affichage des informations
        if (empty($this->userFirstName)) {
            echo "Nom de l'utilisateur non trouvé.";
            return;
        }

        // Vérifiez si les jeux de l'utilisateur existent
        if (empty($this->games)) {
            echo "Aucun jeu trouvé.";
            return;
        }
    }
}

?>
