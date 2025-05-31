<?php
require_once 'core/Database.php';

if (!isset($_SESSION)) {
    session_start();
}

function dd(...$dump) //função de teste
{
    echo '<pre>';
    var_dump($dump);
    echo '</pre>';

    die();
}

class Router
{
    public static function route()
    {
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
            case 'profile':
                require_once 'protected.php';
                require_once 'controllers/AuthController.php';
                (new AuthController($pdo))->getProfile();
                break;
            case 'edit_profile':
                require_once 'protected.php';
                require_once 'controllers/AuthController.php';
                (new AuthController($pdo))->editProfile();
            case 'delete_profile_picture':
                require_once 'protected.php';
                require_once 'controllers/AuthController.php';
                (new AuthController($pdo))->deleteProfilePicture();
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
            case 'edit_game':
                require_once 'protected.php';
                require_once 'controllers/GameController.php';
                (new GameController($pdo))->editGame();
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
