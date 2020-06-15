<?php

namespace App\Controllers;

use App\Models\User;

class RegisterController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->auth->guest()) {
            header('Location: /posts');
            exit();
        }
    }

    /**
     * Форма регистрации и авторизации.
     */
    public function index()
    {
        return $this->render('front\index', []);
    }

    /**
     * Обработка POST данных и добавление пользователя.
     */
    public function add()
    {
        $error = $this->validationRegisterForm($_POST);
        $email = htmlspecialchars(trim($_POST['email']));

        $model = new User();
        $user = $model->get($email);

        if (!empty($user)) {
            $error[] = "User with email '$email' alredy exist";
        }

        if (!empty($error)) {
            return $this->render('front\index', ['error' => $error]);
        }

        // добавляем пользователя
        $name = htmlspecialchars(trim($_POST['name']));
        $passwordHash = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
        $model->add($name, $email, $passwordHash);

        // выполняем авторизацию сразу после добавления
        $user = $model->get($email);
        $this->auth->login($user);
        header('Location: /posts');
        exit();
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