<?php

require_once 'models/User.php';
require_once 'models/Game.php';
require_once 'models/Library.php';

class HomeController {
    private $pdo;
    private $userId;
    private $userFirstName;
    private $games;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $this->userFirstName = User::getFirstName($this->pdo, $this->userId);
        $this->games = Library::getGamesByUser($this->pdo, $this->userId);
    }

    public function display() {
        require 'views/users/Home.php';
    }

//    public function handle() {
//        if (empty($this->userFirstName)) {
//            echo "User name not found.";
//            return;
//        }
//
//        if (empty($this->games)) {
//            echo "No games found.";
//            return;
//        }
//    }
}
?>