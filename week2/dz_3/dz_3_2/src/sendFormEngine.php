<?php

function connection()
{
    if (empty(DB_HOST) || empty(DB_NAME) || empty(DB_USER)) {
        throw new Exception('Configuration parameters are not filled');
    }
    global $pdo;
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';';
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
}

function validationForm(array $post)
{
    $result = [];
    if (empty($post['name'])) {
        $result[] = 'name is empty';
    }
    if (empty($post['email'])) {
        $result[] = 'email is empty';
    }
    if (empty($post['phone'])) {
        $result[] = 'phone is empty';
    }
    return $result;
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

function isUserExist(string $email): bool
{
    global $pdo;
    $queryStr = 'SELECT COUNT(id) FROM users WHERE email = ?';
    $stmt = $pdo->prepare($queryStr);
    $stmt->execute([$email]);
    $res = $stmt->fetchAll(PDO::FETCH_COLUMN);
    return $res[0];
}

function getUserIdByEmail(string $email)
{
    global $pdo;
    $queryStr = 'SELECT id FROM users WHERE email = ?';
    $stmt = $pdo->prepare($queryStr);
    $stmt->execute([$email]);
    $res = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (empty($res)) {
        return false;
    }
    return $res[0];
}

function addNewUser(string $name, string $email): int
{
    global $pdo;
    $queryStr = 'INSERT INTO users (`name`, email) VALUES (:username, :email)';
    $stmt = $pdo->prepare($queryStr);
    $stmt->execute([
        'username' => $name,
        'email' => $email
    ]);
    return $pdo->lastInsertId();
}

function addNewOrder(array $post, int $addedUserId): int
{
    global $pdo;
    $address = prepareAddressString($post);
    $queryStr = 'INSERT INTO orders (user_id, address) VALUES (:user_id, :address)';
    $stmt = $pdo->prepare($queryStr);
    $stmt->execute([
        'user_id' => $addedUserId,
        'address' => $address
    ]);
    return $pdo->lastInsertId();
}

function getOrdersCountByUserId(int $id): int
{
    global $pdo;
    $queryStr = 'SELECT COUNT(*) FROM orders, users WHERE users.id = ? AND users.id = orders.user_id';
    $stmt = $pdo->prepare($queryStr);
    $stmt->execute([$id]);
    $res = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (empty($res)) {
        return 0;
    }
    return $res[0];
}

function runEngine(array $post)
{
    if (!isUserExist($post['email'])) {
        $addedUserId = addNewUser($post['name'], $post['email']);
    } else {
        $addedUserId = getUserIdByEmail($post['email']);
    }

    $orderNum = addNewOrder($post, $addedUserId);
    $address = prepareAddressString($post);
    $ordersCount = getOrdersCountByUserId($addedUserId);

    $resStr = "Спасибо, ваш заказ будет доставлен по адресу: $address <br>" .
        "Номер вашего заказа: #$orderNum <br>" .
        "Это ваш $ordersCount-й заказ! <br>";

    return $resStr;
}

function main($data)
{
    $errors = validationForm($data);
    if (!empty($errors)) {
        return ['error' => $errors];
    }
    global $pdo;
    connection();
    return ['result' => runEngine($data)];
}
