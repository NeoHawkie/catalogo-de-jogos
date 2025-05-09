<?php
require_once 'core/Database.php';
if (!isset($_SESSION)) {
    session_start();
}

function dd(...$dump){
    echo '<pre>';
    var_dump($dump);
    echo '</pre>';

    die();
}

//$rout = str_replace('/', '', parse_url($_SERVER['REQUEST_URI'])['path']);

class Router {
    public static function route() {
        $pdo = Database::connect();
        $action = $_GET['action'] ?? 'login';

        switch ($action) {
            case 'login':
                require_once 'controllers/AuthController.php';
                (new AuthController($pdo))->login();
                break;
            case 'register':
                require_once 'controllers/AuthController.php';
                (new AuthController($pdo))->register();
                break;
            case 'logout':
                require_once 'controllers/AuthController.php';
                (new AuthController($pdo))->logout();
                break;
            case 'dashboard':
                require_once 'protected.php';
                require_once 'controllers/GameController.php';
                (new GameController($pdo))->dashboard();
                break;
            case 'add_game':
                require_once 'protected.php';
                require_once 'controllers/GameController.php';
                (new GameController($pdo))->addGame();
                break;
            case 'delete_game':
                require_once 'protected.php';
                require_once 'controllers/GameController.php';
                (new GameController($pdo))->deleteGame();
                break;
            default:
                echo "404 - Página não encontrada.";
        }
    }
}
?>