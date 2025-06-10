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
                require_once 'controllers/UserController.php';
                (new UserController($pdo))->login();
                break;
            case 'register':
                require_once 'controllers/UserController.php';
                (new UserController($pdo))->register();
                break;
            case 'logout':
                require_once 'controllers/UserController.php';
                (new UserController($pdo))->logout();
                break;
            case 'profile':
                require_once 'protected.php';
                require_once 'controllers/UserController.php';
                (new UserController($pdo))->getProfile();
                break;
            case 'edit_profile':
                require_once 'protected.php';
                require_once 'controllers/UserController.php';
                (new UserController($pdo))->editProfile();
                break;
            case 'delete_profile_picture':
                require_once 'protected.php';
                require_once 'controllers/UserController.php';
                (new UserController($pdo))->deleteProfilePicture();
                break;
            case 'follow':
                require_once 'protected.php';
                require_once 'controllers/UserController.php';
                (new UserController($pdo))->follow();
                break;
            case 'unfollow':
                require_once 'protected.php';
                require_once 'controllers/UserController.php';
                (new UserController($pdo))->unfollow();
                break;
            case 'show_followers':
                require_once 'protected.php';
                require_once 'controllers/UserController.php';
                (new UserController($pdo))->showFollowers();
                break;
            case 'show_following':
                require_once 'protected.php';
                require_once 'controllers/UserController.php';
                (new UserController($pdo))->showFollowing();
                break;
            // -------------------------------------------------------------------------------------
            case 'search':
                require_once 'controllers/SearchController.php';
                (new SearchController(($pdo))->search());
                break;
            // -------------------------------------------------------------------------------------
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
            case 'view_game':
                require_once 'controllers/GameController.php';
                (new GameController($pdo))->viewGame();
                break;
            case 'add_comment':
                require_once 'protected.php';
                require_once 'controllers/GameController.php';
                (new GameController($pdo))->addComment();
                break;
            case 'delete_comment':
                // require_once 'views\errors\503.php';
                require_once 'protected.php';
                require_once 'controllers/GameController.php';
                (new GameController($pdo))->deleteComment();
                break;
            default:
                require_once 'views\errors\404.php';
                break;
        }
    }
}
