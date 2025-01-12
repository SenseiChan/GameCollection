<?php

require_once 'models/Library.php';

class LeaderBoardController {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function display() {
        $leaderboard = Library::getLeaderBoard($this->pdo);

        require 'views/others/LeaderBoard.php';
    }
}
?>