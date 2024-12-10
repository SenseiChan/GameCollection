<?php
require_once '../config/Database.php';

class Available {
    private $id_game;
    private $id_platform;

    public function __construct($id_game = null, $id_platform = null) {
        $this->id_game = $id_game;
        $this->id_platform = $id_platform;
    }

    // Ajouter une association entre un jeu et une plateforme
    public static function add($pdo, $id_game, $id_platform) {
        $stmt = $pdo->prepare("INSERT INTO Avaible (Id_game, Id_platform) VALUES (?, ?)");
        $stmt->execute([$id_game, $id_platform]);
    }

    // Récupérer les plateformes d'un jeu
    public static function getPlatformsByGame($pdo, $id_game) {
        $stmt = $pdo->prepare("SELECT Platform.Name_platform FROM Avaible INNER JOIN Platform ON Avaible.Id_platform = Platform.Id_platform WHERE Avaible.Id_game = ?");
        $stmt->execute([$id_game]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
