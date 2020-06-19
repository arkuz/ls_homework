<?php

namespace App\Models;

use Exception;
use PDO;

require_once __DIR__ . "/../../config.php";

class Base
{
    protected $pdo;

    public function __construct()
    {
        if (empty(DB_HOST) || empty(DB_NAME) || empty(DB_USER)) {
            throw new Exception('Configuration parameters are not filled');
        }
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';';
        $this->pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    }
}

