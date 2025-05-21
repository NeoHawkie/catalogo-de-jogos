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
                } else {
                    die('Formato de arquivo inválido!');
                }
            } else {
                $cover = "defaultCover.jpg";
            }

            $this->gameModel->create($_SESSION['user_id'], $_POST['title'], $cover, $_POST['platform'], $_POST['exe_path'], $_POST['description']);
            header('Location: index.php?action=dashboard');
            exit;
        }
        require 'views/games/add.php';
    }

    public function editGame()
    {

        $gameModel = $this->gameModel;
        $game = $gameModel->getGameById($_REQUEST['id']);

        if ($game['user_id'] !== $_SESSION['user_id']) {
            die('Acesso negado');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $updateCounter = 0;
            $updates = [];
            $params = [];

            if (!empty($_POST['title']) && $_POST['title'] !== $game['title']) {
                $updates[] = 'title = :title';
                $params[':title'] = $_POST['title'];
                // $updateCounter++;
            }
            if (!empty($_POST['description']) && $_POST['description'] !== $game['description']) {
                $updates[] = 'description = :description';
                $params[':description'] = $_POST['description'];
                // $updateCounter++;
            }
            if (!empty($_POST['platform']) && $_POST['platform'] !== $game['platform']) {
                $updates[] = 'platform = :platform';
                $params[':platform'] = $_POST['platform'];
                // $updateCounter++;
            }

            // dd(isset($_FILES['cover']['name']));
            if (isset($_FILES['cover']['name'])  && strlen($_FILES['cover']['name']) > 0) {
                $name = $_FILES['cover']['name'];
                $tmp_name = $_FILES['cover']['tmp_name'];
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $cover = uniqid() . '.' . $extension;

                if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {
                    move_uploaded_file($tmp_name, 'uploads/gameCovers/' . $cover);
                } else {
                    die('Formato de arquivo inválido!');
                }
                $updates[] = 'cover = :cover';
                $params[':cover'] = $cover;
                // $updateCounter++;
            }
            if (!empty($updates) && !empty($params)) {
                $gameModel->update($updates, $params, $game);
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                header('Location: index.php?action=dashboard');
                exit;
            }
        }
        require 'views/games/edit.php';
    }

    public function deleteGame()
    {
        if (isset($_GET['id'])) {
            $this->gameModel->delete($_GET['id'], $_SESSION['user_id']);
            header('Location: index.php?action=dashboard');
        }
    }
}
