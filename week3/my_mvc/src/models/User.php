<?php

namespace App\Models;

use App\Models\BaseModel;
use PDO;

class User extends BaseModel
{
    public function get(string $email)
    {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'email' => $email,
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($name, $email, $password)
    {
        $sql = 'INSERT INTO users (`name`, email, password) VALUES (:username, :email, :password)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'username' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }
}
