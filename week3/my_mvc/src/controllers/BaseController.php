<?php

namespace App\Controllers;

use App\Auth\Auth;

class BaseController
{
    protected $auth;
    protected $view;

    public function __construct()
    {
        $this->auth = new Auth();
    }

    /**
     * Метод редиректа
     * @param $location
     */
    public function redirect($location)
    {
        header("Location: $location");
        exit();
    }
}

