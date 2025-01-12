<?php
require_once 'models/Library.php';

class AddGameController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function display() {
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        $libraryModel = new Library($this->pdo);

        if ($search) {
            // Recherche des jeux par nom
            $games = $libraryModel->searchGames($search);
        } else {
            // Récupérer tous les jeux
            $games = $libraryModel->getAllGames();
        }

        require 'views/games/AddGame.php';
    }

    public function addToLibrary() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer l'ID de l'utilisateur et du jeu
            $userId = $_SESSION['user_id'] ?? null;
            $gameId = $_POST['game_id'] ?? null;

            if ($userId && $gameId) {
                try {
                    Library::addGame($this->pdo, $userId, $gameId, 0);

                    // Rediriger avec un message de succès
                    header('Location: /addGame?success=1');
                    exit;
                } catch (PDOException $e) {
                    echo "Erreur lors de l'ajout à la bibliothèque : " . htmlspecialchars($e->getMessage());
                }
            } else {
                echo "Erreur : données utilisateur ou jeu manquantes.";
            }
        }
    }
}
?>