<?php
require_once 'models/Game.php';
require_once 'models/Library.php';
require_once 'models/Platform.php';

class AddGameFormController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function display() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $platformModel = new Platform($this->pdo);
        $platforms = Platform::getAll($this->pdo);
        require 'views/games/AddGameForm.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            // Récupérer les données du formulaire
            $name = trim($_POST['name']);
            $publisher = trim($_POST['publisher']);
            $releaseDate = trim($_POST['release_date']);
            $description = trim($_POST['description']);
            $urlPicture = trim($_POST['url_picture']);
            $urlSite = trim($_POST['url_site']);
            $platformIds = isset($_POST['platforms']) ? $_POST['platforms'] : [];
            // Vérifier que tous les champs sont remplis
            if (!empty($name) && !empty($publisher) && !empty($releaseDate) && !empty($description) && !empty($urlPicture) && !empty($urlSite)) {
                try {
                    // Ajouter le jeu dans la table Game
                    $gameId = Game::create($this->pdo, $name, $urlPicture, $urlSite, $description, $releaseDate, $publisher);

                    // Ajouter les relations plateforme-jeu dans la table Available
                    foreach ($platformIds as $platformId) {
                        Available::add($this->pdo, $gameId, $platformId);
                    }

                    header('Location: /addGameForm?success=1');
                    exit;
                } catch (PDOException $e) {
                    echo "Erreur lors de l'ajout du jeu : " . htmlspecialchars($e->getMessage());
                }
            } else {
                echo "Tous les champs doivent être remplis.";
            }
        }
    }
}
?>