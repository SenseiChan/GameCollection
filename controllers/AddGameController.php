<?php
class AddGameController {
    public function __construct($pdo) {
    }

    public function display() {
        require 'views/games/AddGame.php';
    }
}
?>