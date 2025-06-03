<?php
require_once 'models/Game.php';
require_once 'models/User.php';

class SearchController
{
    private $gameModel;
    private $userModel;

    public function __construct($pdo)
    {
        $this->gameModel = new Game($pdo);
        $this->userModel = new User($pdo);
    }

    public function search()
    {
        $query = trim($_GET['q'] ?? '');
        $filter = $_GET['filter'] ?? 'all';

        $games = $filter === 'games' || $filter === 'all' ? $this->gameModel->searchGame($query) : [];
        $users = $filter === 'users' || $filter === 'all' ? $this->userModel->searchByEmailOrLikeUsername($query) : [];

        include 'views/search/search_results.php';
    }
}