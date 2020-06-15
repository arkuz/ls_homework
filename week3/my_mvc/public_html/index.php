<?php

session_start();

include __DIR__ . "\..\src\models\BaseModel.php";
include __DIR__ . "\..\src\models\User.php";
include __DIR__ . "\..\src\models\Post.php";
include __DIR__ . "\..\src\Auth.php";
include __DIR__ . "\..\src\controllers\BaseController.php";
include __DIR__ . "\..\src\controllers\AdminController.php";
include __DIR__ . "\..\src\controllers\UserController.php";
include __DIR__ . "\..\src\controllers\RegisterController.php";
include __DIR__ . "\..\src\controllers\PostController.php";

$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, '/user/register') !== false) {
    $controller = new \App\Controllers\RegisterController();
    $controller->add();
    return 0;
}

if (strpos($requestURI, '/user/login') !== false) {
    $controller = new \App\Controllers\UserController();
    $controller->login();
    return 0;
}

if (strpos($requestURI, '/user/logout') !== false) {
    $controller = new \App\Controllers\UserController(true);
    return 0;
}

if (strpos($requestURI, '/posts/send') !== false) {
    $controller = new \App\Controllers\PostController();
    $controller->add();
    return 0;
}

if (strpos($requestURI, '/admin/posts/delete') !== false) {
    $controller = new \App\Controllers\AdminController();
    $controller->deletePost();
    return 0;
}

if (strpos($requestURI, '/admin') !== false) {
    $controller = new \App\Controllers\AdminController();
    $controller->index();
    return 0;
}

if (strpos($requestURI, '/posts/user') !== false) {
    $controller = new \App\Controllers\PostController();
    $controller->getAllByUserID();
    return 0;
}

if (strpos($requestURI, '/posts') !== false) {
    $controller = new \App\Controllers\PostController();
    $controller->index();
    return 0;
}

$controller = new \App\Controllers\RegisterController();
$controller->index();
