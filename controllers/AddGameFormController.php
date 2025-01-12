<?php
require_once 'models/Game.php';
require_once 'models/Library.php';

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
        require 'views/games/AddGameForm.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            // Récupérer les données du formulaire
            $name = trim($_POST['name']);
            $urlPicture = trim($_POST['url_picture']);
            $urlSite = trim($_POST['url_site']);
            $description = trim($_POST['description']);
            $releaseDate = trim($_POST['release_date']);
            $publisher = trim($_POST['publisher']);
            // Vérifier que tous les champs sont remplis
            if (!empty($name) && !empty($urlPicture) && !empty($urlSite) && !empty($description) && !empty($releaseDate) && !empty($publisher)) {
                try {
                    // Appeler la méthode create du modèle Game
                    Game::create($this->pdo, $name, $urlPicture, $urlSite, $description, $releaseDate, $publisher);

                    // Rediriger avec un message de succès
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