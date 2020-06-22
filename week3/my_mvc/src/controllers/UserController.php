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
     * Метод отрисовки страницы логина.
     * @param array $data
     */
    public function view(array $data)
    {
        $renderParams = [];
        if (isset($data['error'])) {
            $error = explode(',', $data['error']);
            $renderParams = ['error' => $error];
        }
        return $this->view->render('front\index', $renderParams);
    }

    /**
     * Логин.
     * @param array $data
     * @throws \Exception
     */
    public function login(array $data)
    {
        $error = $this->validationLoginForm($data);
        $email = htmlspecialchars(trim($data['email']));
        $password = trim($data['password']);
        $model = new User();
        $user = $model->get($email);
        if (empty($user) || !password_verify($password, $user['password'])) {
            $error[] = 9;
        }

        // если есть ошибки, то выполняем редирект и передаем ошибки в GET
        if (!empty($error)) {
            $error_list = implode(',', $error);
            $this->redirect("/user/login?error=$error_list");
        }

        // если пароль совпал, то логинимся
        if (password_verify($password, $user['password'])) {
            $this->auth->login($user);
            $this->redirect('/posts');
        }
    }

    /**
     * Валидация формы логина. Возвращает массив с кодами ошибок.
     * @param array $data
     * @return array
     */
    private function validationLoginForm(array $data)
    {
        $result = [];
        if (empty($data['email'])) {
            $result[] = 7;
        }
        if (empty($data['password'])) {
            $result[] = 8;
        }
        return $result;
    }
}