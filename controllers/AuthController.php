<?php
require_once 'models/User.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->findByUsername($username);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                $error = "Usuário ou senha inválidos.";
            }
        }
        require 'views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->userModel->create($username, $password)) {
                header('Location: index.php?action=login');
                exit;
            } else {
                $error = "Erro ao cadastrar.";
            }
        }
        require 'views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
    }
}
?>