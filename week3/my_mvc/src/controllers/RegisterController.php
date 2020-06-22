<?php

namespace App\Controllers;

use App\Models\User;

class RegisterController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->auth->guest()) {
            $this->redirect('/posts');
        }
    }


    /**
     * Метод отрисовки страницы регистрации.
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
     * * Добавление пользователя (регистрация).
     * @param array $data
     * @throws \Exception
     */
    public function add(array $data)
    {
        $error = $this->validationRegisterForm($data);
        $email = htmlspecialchars(trim($data['email']));
        $model = new User();
        $user = $model->get($email);

        if (!empty($user)) {
            $error[] = 6;
        }

        // если есть ошибки, то выполняем редирект и передаем ошибки в GET
        if (!empty($error)) {
            $error_list = implode(',', $error);
            $this->redirect("/user/register?error=$error_list");
        }

        // добавляем пользователя
        $model = new User();
        $email = htmlspecialchars(trim($data['email']));
        $name = htmlspecialchars(trim($data['name']));
        $passwordHash = password_hash(trim($data['password']), PASSWORD_DEFAULT);
        $model->add($name, $email, $passwordHash);

        // выполняем авторизацию сразу после регистрации
        $user = $model->get($email);
        $this->auth->login($user);
        $this->redirect('/posts');
    }


    /**
     * Валидация формы регистрации. Возвращает массив с кодами ошибок.
     * @param array $post
     * @return array
     */
    private function validationRegisterForm(array $post)
    {
        $result = [];
        if (empty($post['name'])) {
            $result[] = 1;
        }
        if (empty($post['email'])) {
            $result[] = 2;
        }
        if (empty($post['password'])) {
            $result[] = 3;
        }
        if (mb_strlen($post['password']) < 4) {
            $result[] = 4;
        }
        if ($post['password'] !== $post['password2']) {
            $result[] = 5;
        }
        return $result;
    }
}