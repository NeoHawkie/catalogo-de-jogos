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

    public function getGameCoverById($game_id)
    {
        $stmt = $this->db->prepare("SELECT cover FROM games WHERE id = ?");
        $stmt->execute([$game_id]);
        return $stmt->fetch();
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
}
