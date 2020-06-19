<?php

session_start();

include __DIR__ . "\..\src\models\Base.php";
include __DIR__ . "\..\src\models\User.php";
include __DIR__ . "\..\src\models\Post.php";
include __DIR__ . "\..\src\Auth.php";
include __DIR__ . "\..\src\controllers\BaseController.php";
include __DIR__ . "\..\src\controllers\AdminController.php";
include __DIR__ . "\..\src\controllers\UserController.php";
include __DIR__ . "\..\src\controllers\RegisterController.php";
include __DIR__ . "\..\src\controllers\PostController.php";
include __DIR__ . "\..\src\controllers\LogoutController.php";
include __DIR__ . "\..\src\controllers\APIController.php";
include __DIR__ . "\..\src\\services\ViewInterface.php";
include __DIR__ . "\..\src\\views\ViewJSON.php";
include __DIR__ . "\..\src\\views\ViewNative.php";

$requestURI = $_SERVER['REQUEST_URI'];


/**
 * Проверка POST при регистрации.
 */
if (!empty($_POST) && strpos($requestURI, '/user/register') !== false) {
    $controller = new \App\Controllers\RegisterController();
    $controller->checkAdd($_POST);
    // ничего не возвращаем, чтобы не прерывать выполнение и продолжать проверки
}

/**
 * Регистрация.
 */
if (strpos($requestURI, '/user/register') !== false) {
    $controller = new \App\Controllers\RegisterController();
    $controller->add($_POST);
    return 0;
}

/**
 * Проверка POST при логине.
 */
if (!empty($_POST) && strpos($requestURI, '/user/login') !== false) {
    $controller = new \App\Controllers\UserController();
    $controller->checkLogin($_POST);
    //return 0;
}

/**
 * Логин.
 */
if (strpos($requestURI, '/user/login') !== false) {
    $controller = new \App\Controllers\UserController();
    $controller->login($_POST);
    return 0;
}

/**
 * Логаут.
 */
if (strpos($requestURI, '/user/logout') !== false) {
    $controller = new \App\Controllers\LogoutController();
    $controller->logout();
    return 0;
}

/**
 * Добавление поста.
 */
if (strpos($requestURI, '/posts/send') !== false) {
    $controller = new \App\Controllers\PostController();
    $controller->add($_POST, $_FILES);
    return 0;
}

/**
 * Удаление поста в админке.
 */
if (strpos($requestURI, '/admin/posts/delete') !== false) {
    $controller = new \App\Controllers\AdminController();
    $controller->deletePost($_GET);
    return 0;
}

/**
 * Админка.
 */
if (strpos($requestURI, '/admin') !== false) {
    $controller = new \App\Controllers\AdminController();
    $controller->index();
    return 0;
}

/**
 * Все посты пользователя по ID.
 */
if (strpos($requestURI, '/posts/user') !== false) {
    $controller = new \App\Controllers\APIController();
    $controller->getAllByUserID($_GET);
    return 0;
}

/**
 * Список всех постов пользователей.
 */
if (strpos($requestURI, '/posts') !== false) {
    $controller = new \App\Controllers\PostController();
    $controller->index();
    return 0;
}

/**
 * Главная.
 */
$controller = new \App\Controllers\RegisterController();
$controller->index();
