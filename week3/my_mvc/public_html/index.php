<?php

session_start();

include __DIR__ . "\..\src\models\BaseModel.php";
include __DIR__ . "\..\src\models\User.php";
include __DIR__ . "\..\src\models\Post.php";
include __DIR__ . "\..\src\Auth.php";
include __DIR__ . "\..\src\controllers\BaseController.php";
include __DIR__ . "\..\src\controllers\FrontController.php";
include __DIR__ . "\..\src\controllers\AdminController.php";

$requestURI = $_SERVER['REQUEST_URI'];


if (strpos($requestURI,'/user/register') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->register();
    return 0;
}

if (strpos($requestURI,'/user/login') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->login();
    return 0;
}

if (strpos($requestURI,'/user/logout') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->logout();
    return 0;
}

if (strpos($requestURI,'/posts/send') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->sendPost();
    return 0;
}

if (strpos($requestURI,'/admin/posts/delete') !== false) {
    $controller = new \App\Controllers\AdminController();
    $controller->deletePosts();
    return 0;
}

if (strpos($requestURI,'/admin') !== false) {
    $controller = new \App\Controllers\AdminController();
    $controller->index();
    return 0;
}



if (strpos($requestURI,'/posts') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->posts();
    return 0;
}



$controller = new \App\Controllers\FrontController();
$controller->index();