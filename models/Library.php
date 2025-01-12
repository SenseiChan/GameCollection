<?php
require_once 'config/Database.php';

class Library {
    private $pdo;
    private $id_user;
    private $id_game;
    private $time_played;

    public function __construct($pdo,$id_user = null, $id_game = null, $time_played = null) {
        $this->pdo = $pdo;
        $this->id_user = $id_user;
        $this->id_game = $id_game;
        $this->time_played = $time_played;
    }

    // Récupérer tous les jeux disponibles
    public function getAllGames() {
        $query = "
            SELECT 
                Game.Id_game,
                Game.Name_game,
                Game.Url_picture,
                Game.Desc_game,
                Game.Date_game,
                Game.Publisher_game,
                GROUP_CONCAT(Platform.Name_platform SEPARATOR ', ') AS platforms
            FROM Game
            LEFT JOIN Available ON Game.Id_game = Available.Id_game
            LEFT JOIN Platform ON Available.Id_platform = Platform.Id_platform
            GROUP BY Game.Id_game, Game.Name_game, Game.Url_picture, Game.Desc_game, Game.Date_game, Game.Publisher_game
        ";
        $stmt = $this->pdo->query($query);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Rechercher des jeux par nom
    public function searchGames($search) {
        $query = "SELECT * FROM Game WHERE name LIKE :search";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['search' => "%$search%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a game to an user
    public static function addGame($pdo, $id_user, $id_game, $time_played) {
        $stmt = $pdo->prepare("INSERT INTO Library (Id_user, Id_game, Time_played) VALUES (?, ?, ?)");
        $stmt->execute([$id_user, $id_game, $time_played]);
    }

    // Get all games of an user
    public static function getGamesByUser($pdo, $id_user) {
        $stmt = $pdo->prepare("SELECT Game.Name_game, Library.Time_played, Game.url_picture, GROUP_CONCAT(Platform.Name_platform SEPARATOR ', ') AS platforms FROM Library INNER JOIN Game ON Library.Id_game = Game.Id_game LEFT JOIN Available ON Game.Id_game = Available.Id_game LEFT JOIN Platform ON Available.Id_platform = Platform.Id_platform WHERE Library.Id_user = ? GROUP BY Game.Id_game, Library.Time_played, Game.url_picture;");
        $stmt->execute([$id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update the time played of a game by an user
    public static function updateTimePlayed($pdo, $id_user, $id_game, $time_played) {
        $stmt = $pdo->prepare("UPDATE Library SET Time_played = ? WHERE Id_user = ? AND Id_game = ?");
        $stmt->execute([$time_played, $id_user, $id_game]);
    }

    // Delete a game from an user
    public static function deleteGame($pdo, $id_user, $id_game) {
        $stmt = $pdo->prepare("DELETE FROM Library WHERE Id_user = ? AND Id_game = ?");
        $stmt->execute([$id_user, $id_game]);
    }

    // Get the leaderboard of time played (LIMIT 20)
    public static function getLeaderBoard($pdo) {
        $stmt = $pdo->prepare("
    SELECT 
        CONCAT(User.FirstName_user, ' ', User.LastName_user) AS user, 
        SUM(Library.Time_played) AS total_time_played,
        (SELECT Game.Name_game 
         FROM Library AS L2 
         INNER JOIN Game ON L2.Id_game = Game.Id_game 
         WHERE L2.Id_user = Library.Id_user 
         ORDER BY L2.Time_played DESC 
         LIMIT 1) AS most_played_game
    FROM 
        Library 
    INNER JOIN 
        User ON Library.Id_user = User.Id_user 
    GROUP BY 
        Library.Id_user 
    ORDER BY 
        total_time_played DESC
    LIMIT 20
");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




}

?>
