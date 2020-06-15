<?php

namespace App\Controllers;

use App\Models\Post;

class AdminController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if ($this->auth->guest() || !$this->auth->getUser()['is_admin']) {
            header('Location: /');
            exit();
        }
    }

    public function index()
    {
        $model = new Post();
        $posts = $model->getAll();
        return $this->render('front\admin', ['posts' => $posts]);
    }

    public function deletePost()
    {
        $postID = intval($_GET['post_id']);
        $model = new Post();
        $post = $model->get($postID);
        if (!empty($post)) {
            $model->delete($postID);
        }
        header('Location: /admin/posts');
        exit();
    }

}
