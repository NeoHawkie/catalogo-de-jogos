<?php
require_once 'models/Game.php';

class GameController {
    private $gameModel;

    public function __construct($pdo) {
        $this->gameModel = new Game($pdo);
    }

    public function dashboard() {
        if (isset($_GET['searchGame'])) {
            $games = $this->gameModel->searchByTitleOrPlatform($_SESSION['user_id'], $_GET['searchGame']);
        }else{
            $games = $this->gameModel->getAllByUser($_SESSION['user_id']);
        }
        require 'views/games/dashboard.php';
    }

    public function addGame() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->gameModel->create($_SESSION['user_id'], $_POST['title'], $_POST['platform'], $_POST['exe_path'], $_POST['description']);
            header('Location: index.php?action=dashboard');
            exit;
        }
        require 'views/games/add.php';
    }

    public function deleteGame() {
        if (isset($_GET['id'])) {
            $this->gameModel->delete($_GET['id'], $_SESSION['user_id']);
            header('Location: index.php?action=dashboard');
        }
    }
}
?>