<?php
require_once 'config/Database.php';

class Platform {
    private $id_platform;
    private $name;

    public function __construct($id_platform = null, $name = null) {
        $this->id_platform = $id_platform;
        $this->name = $name;
    }

    // Récupérer toutes les plateformes
    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM Platform");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
