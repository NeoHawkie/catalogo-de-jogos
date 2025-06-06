<?php
require_once 'models/User.php';

class UserController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->findByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: index.php?action=dashboard');
                exit;
            }
        }
        require 'views/auth/login.php';
    }

    public function register()
    {
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

    public function logout()
    {
        session_destroy();
        header('Location: index.php?action=login');
    }

    public function getProfile()
    {
        $username = $_GET['user'] ?? null;

        if (!$username) {
            echo "Usuário não especificado.";
            return;
        }

        $profile = $this->userModel->findByUsername($username);
        unset($profile['password'], $profile[2]);
        if (!$profile) {
            echo "Usuário não encontrado.";
            return;
        }

        $loggedUser = $_SESSION['user_id'];
        $followerCount = ($this->userModel->getFollowersCountByUsername($username))['COUNT(*)'];
        $followingCount = ($this->userModel->getFollowingCountByUsername($username))['COUNT(*)'];
        $isFollowing = $this->userModel->isFollowing($loggedUser, $profile['id']);
        $isOwner = isset($_SESSION['username']) && $_SESSION['username'] === $profile['username'];
        $recentGame = $this->userModel->getRecentlyAddedByUser($profile['id']);
        include 'views/users/profile.php';
    }


    public function editProfile()
    {
        // dd($_SERVER);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bio = trim($_POST['bio'] ?? '');
            // dd($_FILES);
            if (strlen($_FILES['profile_picture']['name']) > 0) {
                $name = $_FILES['profile_picture']['name'];
                $tmp_name = $_FILES['profile_picture']['tmp_name'];
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $pp = uniqid() . '.' . $extension;

                if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {
                    move_uploaded_file($tmp_name, 'uploads/profilePictures/' . $pp);
                } else {
                    die('Formato de arquivo inválido!');
                }
                $this->userModel->update($_SESSION['user_id'], $bio, $pp);
            } else {
                $this->userModel->update($_SESSION['user_id'], $bio);
            }
            header("Location: index.php?action=profile&user=" . $_SESSION['username']);
            exit;
        }
    }

    public function deleteProfilePicture()
    {
        $userProfilePicture = $this->userModel->getUserProfilePicture($_SESSION['user_id']);
        unlink('uploads/profilePictures/' . $userProfilePicture["profile_picture"]);
        $this->userModel->deleteUserProfilePicture($_SESSION['user_id']);
        header("Location: index.php?action=profile&user=" . $_SESSION['username']);
        exit;
    }

    public function follow()
    {
        $followerId = $_SESSION['user_id'];
        $followingId = $_GET['id'] ?? null;

        if ($followingId && $followingId != $followerId) {
            $this->userModel->followUser($followerId, $followingId);
        }

        header("Location: index.php?action=profile&user=" . $_GET['username']);
        exit;
    }

    public function unfollow()
    {
        $followerId = $_SESSION['user_id'];
        $followingId = $_GET['id'] ?? null;

        $this->userModel->unfollowUser($followerId, $followingId);

        header("Location: index.php?action=profile&user=" . $_GET['username']);
        exit;
    }

    public function showFollowing()
    {
        $username = $_GET['username'];
        $followingId = $this->userModel->getFollowingByUsername($username);
        $profiles = [];
        foreach ($followingId as $profile) {
            $profiles[] = $this->userModel->getUserById($profile['following_id']);
        }

        include 'views/users/following.php';
        exit;
    }

    public function showFollowers()
    {
        $username = $_GET['username'];
        $followerId = $this->userModel->getFollowersByUsername($username);
        // dd($followerId);
        $profiles = [];
        foreach ($followerId as $profile) {
            $profiles[] = $this->userModel->getUserById($profile['follower_id']);
        }

        include 'views/users/following.php';
        exit;
    }
}
