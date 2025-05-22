<?php
require_once 'models/User.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->findByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: index.php?action=dashboard');
                exit;
            }
        }
        require 'views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->userModel->findByUsername($_POST['username'])) {
                die('ERRO: Nome de usuário já está em uso!');
            }
            if ($this->userModel->findByEmail($_POST['email'])) {
                die('ERRO: Email já cadastrado!');
            }
            if ($_POST['password'] != $_POST['passwordConfirmation']) {
                die('ERRO: Senhas diferentes!');
            }
            $username = $_POST['username'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            if ($this->userModel->create($username, $name, $email, $password)) {
                header('Location: index.php?action=login');
                exit;
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