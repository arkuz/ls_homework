<?php

namespace App\Controllers;

use App\Auth\Auth;

class BaseController extends Auth
{
    protected function render($template, $data)
    {
        extract($data);
        include __DIR__ . '\..\views\\' . $template . '.php';
    }
}

