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
}

?>