<?php

const DB_HOST = 'localhost';
const DB_NAME = 'week2_dz3_2';
const CONNECTION_STRING = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';';
const DB_USER = 'root';
const DB_PASSWORD = 'root';

function connection(string $dsn, string $username, string $password): PDO
{
    try {
        return new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
        die;
    }
}

function validationForm(array $post)
{
    $errStr = '';

    if (empty($post['name'])) {
        $errStr = 'name is empty';
    }

    if (empty($post['email'])) {
        $errStr = 'email is empty';
    }

    if (empty($post['phone'])) {
        $errStr = 'phone is empty';
    }

    if (!empty($errStr)) {
        echo json_encode(['error' => $errStr]);
        die();
    }

}

function prepareAddressString(array $post): string
{
    $resStr = '';
    if (!empty($post['street'])) {
        $resStr .= 'ул. ' . $post['street'] . ', ';
    }
    if (!empty($post['home'])) {
        $resStr .= 'дом ' . $post['home'] . ', ';
    }
    if (!empty($post['part'])) {
        $resStr .= 'кор. ' . $post['part'] . ', ';
    }
    if (!empty($post['appt'])) {
        $resStr .= 'кв. ' . $post['appt'] . ', ';
    }
    if (!empty($post['floor'])) {
        $resStr .= 'этаж ' . $post['floor'] . ', ';
    }
    $resStr .= 'тел. ' . $post['phone'];

    return $resStr;
}

function isUserExist(PDO $pdo, string $email): bool
{
    $queryStr = 'SELECT COUNT(id) FROM users WHERE email = ?';
    $stmt = $pdo->prepare($queryStr);
    $stmt->execute([$email]);
    $res = $stmt->fetchAll(PDO::FETCH_COLUMN);
    return $res[0];
}

function getUserIdByEmail(PDO $pdo, string $email)
{
    $queryStr = 'SELECT id FROM users WHERE email = ?';
    $stmt = $pdo->prepare($queryStr);
    $stmt->execute([$email]);
    $res = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (empty($res)) {
        return false;
    }
    return $res[0];
}

function addNewUser(PDO $pdo, string $name, string $email): int
{
    $queryStr = 'INSERT INTO users (`name`, email) VALUES (:username, :email)';
    $stmt = $pdo->prepare($queryStr);
    $stmt->execute([
        'username' => $name,
        'email' => $email
    ]);
    return $pdo->lastInsertId();
}

function addNewOrder(PDO $pdo, array $post, int $addedUserId): int
{
    $address = prepareAddressString($post);
    $queryStr = 'INSERT INTO orders (user_id, address) VALUES (:user_id, :address)';
    $stmt = $pdo->prepare($queryStr);
    $stmt->execute([
        'user_id' => $addedUserId,
        'address' => $address
    ]);
    return $pdo->lastInsertId();
}

function getOrdersCountByUserId(PDO $pdo, int $id): int
{
    $queryStr = 'SELECT COUNT(*) FROM orders, users WHERE users.id = ? AND users.id = orders.user_id';
    $stmt = $pdo->prepare($queryStr);
    $stmt->execute([$id]);
    $res = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (empty($res)) {
        return 0;
    }
    return $res[0];
}

function runEngine(PDO $pdo, array $post)
{
    if (!isUserExist($pdo, $post['email'])) {
        $addedUserId = addNewUser($pdo, $post['name'], $post['email']);
    } else {
        $addedUserId = getUserIdByEmail($pdo, $post['email']);
    }

    $orderNum = addNewOrder($pdo, $post, $addedUserId);
    $address = prepareAddressString($post);
    $ordersCount = getOrdersCountByUserId($pdo, $addedUserId);

    $resStr = "Спасибо, ваш заказ будет доставлен по адресу: $address <br>" .
        "Номер вашего заказа: #$orderNum <br>" .
        "Это ваш $ordersCount-й заказ! <br>";

    return ['info' => $resStr];
}

validationForm($_POST);
$pdo = connection(CONNECTION_STRING, DB_USER, DB_PASSWORD);
$res = json_encode(runEngine($pdo, $_POST));
echo $res;
