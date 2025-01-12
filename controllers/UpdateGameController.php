<?php

require_once 'models/Library.php';

class UpdateGameController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function display() {
        // Récupérer l'ID du jeu depuis l'URL
        $gameId = isset($_GET['game_id']) ? intval($_GET['game_id']) : null;

        if (!$gameId) {
            echo "Jeu introuvable.";
            return;
        }

        // Récupérer les détails du jeu
        $libraryModel = new Library($this->pdo);
        $game = $libraryModel->getGameById($gameId);

        if (!$game) {
            echo "Jeu introuvable.";
            return;
        }

        require 'views/games/UpdateGame.php';
    }

    public function handleUpdate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['game_id'], $_POST['time_played'])) {
            $gameId = intval($_POST['game_id']);
            $timePlayed = floatval($_POST['time_played']);
            $userId = $_SESSION['user_id'] ?? null;

            if ($gameId && $userId) {
                try {
                    Library::updateTimePlayed($this->pdo, $userId, $gameId, $timePlayed);
                    header('Location: /library?success=update');
                    exit;
                } catch (PDOException $e) {
                    echo "Erreur lors de la mise à jour du temps de jeu : " . htmlspecialchars($e->getMessage());
                }
            } else {
                echo "Erreur : Informations manquantes pour la mise à jour.";
            }
        } else {
            echo "Requête invalide.";
        }
    }

    public function handleDelete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['game_id'])) {
            $gameId = intval($_POST['game_id']);
            $userId = $_SESSION['user_id'] ?? null;

            if ($gameId && $userId) {
                try {
                    Library::deleteGame($this->pdo, $userId, $gameId);
                    header('Location: /library?success=delete');
                    exit;
                } catch (PDOException $e) {
                    echo "Erreur lors de la suppression du jeu : " . htmlspecialchars($e->getMessage());
                }
            } else {
                echo "Erreur : Informations manquantes pour la suppression.";
            }
        } else {
            echo "Requête invalide.";
        }
    }
}
