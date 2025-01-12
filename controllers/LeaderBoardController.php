<?php
class LeaderBoardController {
    public function __construct($pdo) {
    }

    public function display() {
        require 'views/others/LeaderBoard.php';
    }
}
?>