<?php
class Game
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAllByUser($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM games WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public function searchByTitleOrPlatform($user_id, $searchGame)
    {
        $stmt = $this->db->prepare("SELECT * FROM games
                                    WHERE user_id = :user_id AND (title LIKE :searchGame OR platform LIKE :searchGame)");
        $stmt->execute([
            'user_id' => $user_id,
            'searchGame' => '%' . $searchGame . '%'
        ]);
        return $stmt->fetchAll();
    }

    public function create($user_id, $title, $platform, $exe_path, $description)
    {
        $stmt = $this->db->prepare("INSERT INTO games (user_id, title, platform, exe_path, description) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$user_id, $title, $platform, $exe_path, $description]);
    }

    public function delete($id, $user_id)
    {
        $stmt = $this->db->prepare("DELETE FROM games WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $user_id]);
    }
}
