<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{
    public function __construct($logout = false)
    {
        parent::__construct();

        if ($logout) {
            $this->logout();
        }

        if (!$this->auth->guest()) {
            header('Location: /posts');
            exit();
        }
    }

    public function login()
    {
        $error = $this->validationLoginForm($_POST);
        $email = htmlspecialchars(trim($_POST['email']));
        $password = trim($_POST['password']);

        $model = new User();
        $user = $model->get($email);

        if (empty($user)) {
            $error[] = "User with this username / password was not found";
        }

        if (!empty($error)) {
            return $this->render('front\index', ['error' => $error]);
        }

        // если пароль совпал, то логинимся
        if (password_verify($password, $user['password'])) {
            $this->auth->login($user);
            header('Location: /posts');
            exit();
        }
    }

    public function logout()
    {
        $this->auth->logout();
        header('Location: /');
        exit();
    }

    private function validationLoginForm(array $post)
    {
        $result = [];
        if (empty($post['email'])) {
            $result[] = 'email is empty';
        }
        if (empty($post['password'])) {
            $result[] = 'password is empty';
        }
        return $result;
    }
}