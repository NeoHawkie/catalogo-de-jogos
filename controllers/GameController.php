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
        $userId = $_SESSION['user_id'];
        $filter = $_GET['filter'] ?? null;

        if ($filter) {
            $games = $this->gameModel->searchUserGamesByTitle($userId, $filter);
        } else {
            $games = $this->gameModel->getAllByUser($userId);
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
            $updates = [];
            $params = [];

            if (!empty($_POST['title']) && $_POST['title'] !== $game['title']) {
                $updates[] = 'title = :title';
                $params[':title'] = $_POST['title'];
            }
            if (!empty($_POST['description']) && $_POST['description'] !== $game['description']) {
                $updates[] = 'description = :description';
                $params[':description'] = $_POST['description'];
            }
            if (!empty($_POST['platform']) && $_POST['platform'] !== $game['platform']) {
                $updates[] = 'platform = :platform';
                $params[':platform'] = $_POST['platform'];
            }

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

    public function viewGame()
    {
        $gameId = $_GET['id'];
        $game = $this->gameModel->getGameById($gameId);

        $userId = $game['user_id'];
        $addedBy = $this->gameModel->getUsernameById($userId)['username'];

        $reviews = $this->gameModel->getReviewsById($gameId);
        $reviewsCount = $this->gameModel->getReviewsCountById($gameId)['COUNT(*)'];
        $comments = $this->gameModel->getCommentsBygameId($gameId);

        require 'views/games/game.php';
    }

    public function rateGame() {}

    public function addComment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $gameId = $_POST['gameId'];
            $username = $_POST['username'];
            $content = $_POST['content'];
            $this->gameModel->createComment($gameId, $username, $content);
            header('Location: index.php?action=view_game&id=' . $gameId);
        }
    }

    public function deleteComment()
    {
        if (isset($_GET['id']) && isset($_GET['gameId'])) {
            $commentId = $_GET['id'];
            $gameId = $_GET['gameId'];
            
            $this->gameModel->deleteComment($commentId);
            header('Location: index.php?action=view_game&id='.$gameId);
        }
    }
}
