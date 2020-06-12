<?php

namespace App\Models;

use App\Models\BaseModel;
use PDO;

class Post extends BaseModel
{

    public function getAllPosts()
    {
        $queryStr = 'SELECT users.name, posts.message, posts.datetime, posts.id FROM posts JOIN users ON users.id = posts.user_id';
        $stmt = $this->pdo->prepare($queryStr);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($res)) {
            return false;
        }
        return $res;
    }

    function addNewPost($user_id, $message)
    {
        $queryStr = 'INSERT INTO posts (user_id, message) VALUES (:user_id, :message)';
        $stmt = $this->pdo->prepare($queryStr);
        $stmt->execute([
            'user_id' => $user_id,
            'message' => $message,
        ]);

        return $this->pdo->lastInsertId();
    }

    public function getPost($id)
    {
        $queryStr = 'SELECT * FROM posts WHERE id = :id';
        $stmt = $this->pdo->prepare($queryStr);
        $stmt->execute([
            'id' => $id,
        ]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($res)) {
            return false;
        }
        return $res[0];
    }


    public function deletePost($id)
    {
        $queryStr = 'DELETE FROM posts WHERE id = :id';
        $stmt = $this->pdo->prepare($queryStr);
        $stmt->execute([
            'id' => $id,
        ]);
    }

}
