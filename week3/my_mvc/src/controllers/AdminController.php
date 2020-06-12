<?php

namespace App\Controllers;

use App\Models\Post;

class AdminController extends BaseController
{
    public function index()
    {
        if (self::getUser()['is_admin']) {
            $model = new Post();
            $posts = $model->getAllPosts();
            $this->render('front\admin', ['posts' => $posts]);
            return 0;
        }
        echo 'Только для админа';
    }

    public function deletePosts()
    {
        var_dump('удаление постов админа');
    }

}
