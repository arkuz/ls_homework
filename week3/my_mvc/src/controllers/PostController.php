<?php

namespace App\Controllers;

use App\Models\Post;
use App\View\ViewNative;

class PostController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if ($this->auth->guest()) {
            $this->redirect('/');
        }
    }

    /**
     * Главная страница отображения всех постов.
     * @throws \Exception
     */
    public function index()
    {
        $model = new Post();
        $posts = $model->getAll();
        return $this->view->render('\front\posts', ['posts' => $posts]);
    }

    /**
     * Добавление поста.
     * @throws \Exception
     */
    public function add($data, $files)
    {
        $img = $this->addImage($files);
        $user = $this->auth->getUser();
        $model = new Post();
        if (isset($data['message'])) {
            $message = $data['message'];
        } else {
            $message = '';
        }
        $message = htmlspecialchars($message);
        $model->add($user['id'], $message, $img);
        $this->redirect('/posts');
    }

    /**
     * Добавить изображение к посту.
     * @param $files
     * @return string
     */
    private function addImage($files)
    {
        if (!isset($files)) {
            return '';
        }

        $path = getcwd() . '\img\\';
        $ext = explode('.', $files['userfile']['name']);
        $ext = array_pop($ext);
        $types = array('image/gif', 'image/png', 'image/jpeg');
        if (!in_array($files['userfile']['type'], $types)) {
            return '';
        }

        $new_name = time() . '.' . $ext;
        $full_path = $path . $new_name;

        if ($files['userfile']['error'] == 0) {
            if (move_uploaded_file($files['userfile']['tmp_name'], $full_path)) {
                return $new_name;
            }
        }
        return '';
    }
}