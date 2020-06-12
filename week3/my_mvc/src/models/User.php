<?php

namespace App\Models;

use App\Models\BaseModel;
use PDO;

class User extends BaseModel
{
    public function isUserExist(string $email): bool
    {
        $queryStr = 'SELECT COUNT(id) FROM users WHERE email = ?';
        $stmt = $this->pdo->prepare($queryStr);
        $stmt->execute([$email]);
        $res = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $res[0];
    }

    public function getUserInfo(string $email, string $password)
    {
        $queryStr = 'SELECT * FROM users WHERE email = :email AND password = :password';
        $stmt = $this->pdo->prepare($queryStr);
        $stmt->execute([
            'email' => $email,
            'password' => $this->getPasswordHash($password),
        ]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($res)) {
            return false;
        }
        return $res[0];
    }

    public function getUserIdByEmail(string $email)
    {
        $queryStr = 'SELECT id FROM users WHERE email = ?';
        $stmt = $this->pdo->prepare($queryStr);
        $stmt->execute([$email]);
        $res = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (empty($res)) {
            return false;
        }
        return $res[0];
    }

    function addNewUser($name, $email, $password)
    {
        if ($this->isUserExist($email)) {
            return false;
        }
        $passwHash = $this->getPasswordHash($password);
        $queryStr = 'INSERT INTO users (`name`, email, password) VALUES (:username, :email, :password)';
        $stmt = $this->pdo->prepare($queryStr);
        $stmt->execute([
            'username' => $name,
            'email' => $email,
            'password' => $passwHash,
        ]);

        return $this->pdo->lastInsertId();
    }


    private function getPasswordHash($password)
    {
        return sha1($password . '!@#$%^&*()_+MGR*G{G*');
    }

}
