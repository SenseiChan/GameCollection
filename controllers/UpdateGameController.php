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
}
