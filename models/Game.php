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

    public function getGameById($game_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM games WHERE id = ?");
        $stmt->execute([$game_id]);
        return $stmt->fetch();
    }

    public function getUsernameById($userId)
    {
        $stmt = $this->db->prepare("SELECT username FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    public function getGameCoverById($game_id)
    {
        $stmt = $this->db->prepare("SELECT cover FROM games WHERE id = ?");
        $stmt->execute([$game_id]);
        return $stmt->fetch();
    }

    public function searchGame($search)
    {
        $stmt = $this->db->prepare("SELECT * FROM games WHERE title LIKE :search ORDER BY id DESC");
        $stmt->execute([
            'search' => '%' . $search . '%'
        ]);
        return $stmt->fetchAll();
    }

    public function searchUserGamesByTitle($userId, $title)
    {
        $stmt = $this->db->prepare("SELECT * FROM games WHERE user_id = :user_id AND title LIKE :title");
        $stmt->execute([
            'user_id' => $userId,
            'title' => "%$title%"
        ]);
        return $stmt->fetchAll();
    }

    public function create($user_id, $title, $cover, $platform, $exe_path, $description)
    {
        $stmt = $this->db->prepare("INSERT INTO games (user_id, title, cover, platform, exe_path, description) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$user_id, $title, $cover, $platform, $exe_path, $description]);
    }

    public function update($updates, $params, $game)
    {

        $params[':id'] = $game['id'];
        $stmt = $this->db->prepare('UPDATE games SET ' . implode(', ', $updates) . ' WHERE id = :id');
        return $stmt->execute($params);
    }

    public function delete($id, $user_id)
    {
        $game = $this->getGameCoverById($id);
        if ($game['cover'] != "defaultCover.jpg") {
            unlink('uploads/gameCovers/' . $game['cover']);
        }

        $stmt = $this->db->prepare("DELETE FROM games WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $user_id]);
    }

    public function getReviewsById($gameId)
    {
        $stmt = $this->db->prepare("SELECT * FROM game_ratings WHERE game_id = ?");
        $stmt->execute([$gameId]);
        return $stmt->fetchAll();
    }

    public function getReviewsCountById($gameId)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM game_ratings WHERE game_id = ?");
        $stmt->execute([$gameId]);
        return $stmt->fetch();
    }

    public function getCommentsById($gameId)
    {
        $stmt = $this->db->prepare("SELECT * FROM game_comments WHERE game_id = ?");
        $stmt->execute([$gameId]);
        return $stmt->fetchAll();
    }
}
