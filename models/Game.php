<?php
require_once 'config/Database.php';

class Game {
    private $id_game;
    private $name;
    private $url_picture;
    private $url_site;
    private $description;
    private $release_date;
    private $publisher;

    public function __construct($id_game = null, $name = null, $url_picture = null, $url_site = null, $description = null, $release_date = null, $publisher = null) {
        $this->id_game = $id_game;
        $this->name = $name;
        $this->url_picture = $url_picture;
        $this->url_site = $url_site;
        $this->description = $description;
        $this->release_date = $release_date;
        $this->publisher = $publisher;
    }

    // Ajouter un jeu
    public static function create($pdo, $name, $url_picture, $url_site, $description, $release_date, $publisher) {
        $stmt = $pdo->prepare("INSERT INTO Game (Name_game, Url_picture, Url_site, Desc_game, Date_game ,Publisher_game) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $url_picture, $url_site, $description, $release_date, $publisher]);
    }

    // Récupérer les jeux d'un utilisateur
//    public static function getByUser($pdo, $id_user) {
//        $stmt = $pdo->prepare("SELECT * FROM Game WHERE Id_user = ?");
//        $stmt->execute([$id_user]);
//        return $stmt->fetchAll(PDO::FETCH_ASSOC);
//    }

    // Supprimer un jeu
    public static function delete($pdo, $id_game) {
        $stmt = $pdo->prepare("DELETE FROM Game WHERE Id_game = ?");
        $stmt->execute([$id_game]);
    }
}
