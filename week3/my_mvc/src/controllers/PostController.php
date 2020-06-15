<?php

namespace App\Controllers;

use App\Models\Post;

class PostController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if ($this->auth->guest()) {
            header('Location: /');
            exit();
        }
    }

    public function index()
    {
        $model = new Post();
        $posts = $model->getAll();
        return $this->render('front\posts', ['posts' => $posts]);
    }

    public function add()
    {
        $img = $this->addImage($_FILES);
        $user = $this->auth->getUser();
        $model = new Post();
        $message = htmlspecialchars($_POST['message']);
        $model->add($user['id'], $message, $img);
        header('Location: /posts');
        exit();
    }

    public function getAllByUserID()
    {
        $userID = intval($_GET['user_id']);
        $model = new Post();
        $posts = ['posts' => $model->getAllByUserID($userID)];
        $this->renderJSON($posts);
    }

    private function addImage($files)
    {
        if (!isset($files)) {
            return '';
        }

        $path = getcwd() . '\img\\';
        $ext = explode('.', $files['userfile']['name']);
        $ext = array_pop($ext);
        $types = array('image/gif', 'image/png', 'image/jpeg');
        if (!in_array($_FILES['userfile']['type'], $types)) {
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