<?php
namespace App\Controllers;

use App\Auth\Auth;
use App\Models\User;
use App\Models\Post;

class FrontController extends BaseController
{
    public function index()
    {
        if (self::isUserLogin()) {
            header('Location: /posts');
            return 0;
        }

        $this->render('front\index', []);
    }

    public function dieIfNotLogin()
    {
        if (! self::isUserLogin()) {
            echo "Данная страница доступна только зарегистрированным пользователям";
            die;
        }
    }

    public function login()
    {
        if (self::isUserLogin()) {
            header('Location: /posts');
            return 0;
        }

        $model = new User();
        $user = $model->getUserInfo($_POST['email'], $_POST['password']);
        if ($user === false) {
            $error[] =  "The user with this email / password was not found" ;
            $this->render('front\index', ['error' => $error]);
            return 0;
        }
        self::setLogin($user);
        header('Location: /posts');
    }

    public function logout()
    {
        $this->dieIfNotLogin();
        self::setLogout();
        header('Location: /');
    }

    public function register()
    {
        if (Auth::isUserLogin()) {
            header('Location: /posts');
            return 0;
        }

        $error = $this->validationRegisterForm($_POST);
        if ($error) {
            $this->render('front\index', ['error' => $error]);
            return 0;
        }

        $model = new User();
        $userID = $model->addNewUser($_POST['name'], $_POST['email'], $_POST['password']);
        if ($userID === false) {
            $error[] =  "User with email '{$_POST['email']}' alredy exist" ;
            $this->render('front\index', ['error' => $error]);
            return 0;
        }
        $this->login();
    }

    public function posts()
    {
        $this->dieIfNotLogin();

        $model = new Post();
        $posts = $model->getAllPosts();
        $this->render('front\posts', ['posts' => $posts]);
    }

    public function sendPost()
    {
        $this->dieIfNotLogin();

        $userID = Auth::getUser()['id'];
        $model = new Post();
        $message = $_POST['message'];
        $message = htmlspecialchars($message);
        $postID = $model->addNewPost($userID, $message);
        if ($postID === false) {
            $error[] =  "Post is not added" ;
            $this->render('front\posts', ['error' => $error]);
            return 0;
        }
        header('Location: /posts');
    }


    private function validationRegisterForm(array $post)
    {
        $result = [];
        if (empty($post['name'])) {
            $result[] = 'name is empty';
        }
        if (empty($post['email'])) {
            $result[] = 'email is empty';
        }
        if (empty($post['password'])) {
            $result[] = 'password is empty';
        }
        if (mb_strlen($post['password']) < 4) {
            $result[] = 'password must be more than 4 characters';
        }
        if ($post['password'] !== $post['password2']) {
            $result[] = 'passwords don\'t match';
        }
        return $result;
    }

}