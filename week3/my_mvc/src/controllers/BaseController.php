<?php

namespace App\Controllers;

use App\Auth\Auth;

class BaseController
{
    protected $auth;

    public function __construct()
    {
        $this->auth = new Auth();
    }

    protected function render($template, $data)
    {
        extract($data);
        include __DIR__ . '\..\views\\' . $template . '.php';
    }

    protected function renderJSON($data)
    {
        echo json_encode($data);
    }
}

