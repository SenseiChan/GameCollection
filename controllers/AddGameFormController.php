<?php
class AddGameFormController {
    public function __construct($pdo) {
    }

    public function display() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        require 'views/games/AddGameForm.php';
    }
}
?>