<?php
class User
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create($username, $name, $email, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, name, email, password) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $name, $email, $hash]);
    }

    public function update($user_id, $bio = [], $profile_picture = [])
    {
        if (!empty($profile_picture)) {
            $stmt = $this->db->prepare("UPDATE users SET bio = ?, profile_picture = ? WHERE ID = ?");
            return $stmt->execute([$bio, $profile_picture, $user_id]);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET bio = ? WHERE ID = ?");
            return $stmt->execute([$bio, $user_id]);
        }
    }

    public function getUserProfilePicture($user_id) 
    {
        $stmt = $this->db->prepare("SELECT profile_picture FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }
    
    public function deleteUserProfilePicture($user_id)
    {
        $stmt = $this->db->prepare("UPDATE users SET profile_picture=NULL WHERE id = ?");
        return $stmt->execute([$user_id]);
        
    }

    public function getRecentlyAddedByUser($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM games WHERE user_id = ? ORDER BY id DESC LIMIT 1");
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }
}
