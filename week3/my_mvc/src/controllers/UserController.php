<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->auth->guest()) {
            $this->redirect('/posts');
        }
    }

    /**
     * Метод проверки POST перед логином.
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function checkLogin(array $data)
    {
        $error = $this->validationLoginForm($data);
        $email = htmlspecialchars(trim($data['email']));

        $model = new User();
        $user = $model->get($email);

        if (empty($user)) {
            $error[] = 9;
        }
        if (!empty($error)) {
            return $this->render('front\index', ['error' => $error]);
        }
    }

    /**
     * Логин.
     * @param array $data
     * @throws \Exception
     */
    public function login(array $data)
    {
        $email = htmlspecialchars(trim($data['email']));
        $password = trim($data['password']);

        $model = new User();
        $user = $model->get($email);

        // если пароль совпал, то логинимся
        if (password_verify($password, $user['password'])) {
            $this->auth->login($user);
            $this->redirect('/posts');
        }
    }

    /**
     * Валидация формы логина. Возвращает массив с кодами ошибок.
     * @param array $post
     * @return array
     */
    private function validationLoginForm(array $post)
    {
        $result = [];
        if (empty($post['email'])) {
            $result[] = 7;
        }
        if (empty($post['password'])) {
            $result[] = 8;
        }
        return $result;
    }
}