<?php
require_once 'models/Game.php';

class GameController
{
    private $gameModel;

    public function __construct($pdo)
    {
        $this->gameModel = new Game($pdo);
    }

    public function dashboard()
    {
        if (isset($_GET['searchGame'])) {
            $games = $this->gameModel->searchByTitleOrPlatform($_SESSION['user_id'], $_GET['searchGame']);
        } else {
            $games = $this->gameModel->getAllByUser($_SESSION['user_id']);
        }
        require 'views/games/dashboard.php';
    }

    public function addGame()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (strlen($_FILES['cover']['name'] > 0)) {
                $name = $_FILES['cover']['name'];
                $tmp_name = $_FILES['cover']['tmp_name'];
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $cover = uniqid() . '.' . $extension;

                if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {
                    move_uploaded_file($tmp_name, 'uploads/gameCovers/' . $cover);
                }else{
                    die('Formato de arquivo inválido!');
                }
            }else{
                $cover = "defaultCover.jpg";
            }

            $this->gameModel->create($_SESSION['user_id'], $_POST['title'], $cover, $_POST['platform'], $_POST['exe_path'], $_POST['description']);
            header('Location: index.php?action=dashboard');
            exit;
        }
        require 'views/games/add.php';
    }

    public function deleteGame()
    {
        if (isset($_GET['id'])) {
            $this->gameModel->delete($_GET['id'], $_SESSION['user_id']);
            header('Location: index.php?action=dashboard');
        }
    }
}
