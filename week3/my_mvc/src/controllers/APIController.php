<?php

namespace App\Controllers;

use App\Models\Post;
use App\View\ViewJSON;

class APIController extends BaseController
{
    public function __construct()
    {
        $this->view = new ViewJSON();
        parent::__construct();
        if ($this->auth->guest()) {
            $this->redirect('/');
        }
    }

    /**
     * Посты пользователя с указанием лимита отображения в GET.
     * Если не указан user_id отображаются посты всех пользователей
     * @param array $data
     * @throws \Exception
     */
    public function getAllByUserID(array $data)
    {
        $model = new Post();
        if (isset($data['user_id']) && $data['user_id'] > 0) {
            $limit = 20;
            if (isset($data['limit'])) {
                $limit = (int)$data['limit'];
            }
            $userID = $data['user_id'];
            $posts = $model->getAllByUserID($userID, $limit);
        } else {
            $posts = $model->getAll();
        }
        return $this->view->render('', ['posts' => $posts]);
    }
}