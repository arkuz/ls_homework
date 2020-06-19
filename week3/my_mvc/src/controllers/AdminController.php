<?php

namespace App\Controllers;

use App\Models\Post;
use App\View\ViewNative;

class AdminController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->view = new ViewNative();
        if ($this->auth->guest() || !$this->auth->getUser()['is_admin']) {
            $this->redirect('/');
        }
    }

    /**
     * Главная страница админки.
     * @throws \Exception
     */
    public function index()
    {
        $model = new Post();
        $posts = $model->getAll();
        return $this->view->render('front\admin', ['posts' => $posts]);
    }

    /**
     * Удалить пост пользователя.
     * @param array $data
     * @throws \Exception
     */
    public function deletePost(array $data)
    {
        if (isset($data['post_id']) && $data['post_id'] > 0) {
            $model = new Post();
            $post = $model->get($data['post_id']);
            if (!empty($post)) {
                $model->delete($post['id']);
            }
        }
        $this->redirect('/admin/posts');
    }

}
