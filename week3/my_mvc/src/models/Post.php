<?php

namespace App\Models;

use PDO;

class Post extends Base
{
    public function getAll()
    {
        $sql = 'SELECT users.name, posts.message, posts.datetime, posts.id, posts.img
                FROM posts 
                JOIN users ON users.id = posts.user_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllByUserID($user_id, $limit = 20)
    {
        $sql = 'SELECT users.name, posts.message, posts.datetime, posts.id, posts.img
                FROM posts 
                JOIN users ON users.id = posts.user_id
                WHERE users.id = :user_id
                LIMIT ' . $limit;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $user_id,
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($id)
    {
        $sql = 'SELECT * FROM posts WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($user_id, $message, $img)
    {
        $sql = 'INSERT INTO posts (user_id, message, img) VALUES (:user_id, :message, :img)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'user_id' => $user_id,
            'message' => $message,
            'img' => $img,
        ]);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM posts WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $id,
        ]);
    }
}
