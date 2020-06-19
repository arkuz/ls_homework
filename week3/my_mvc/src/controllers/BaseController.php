<?php

namespace App\Controllers;

use App\Services\Auth;
use App\Services\ViewNative;
use App\Services\ViewTwig;

require_once __DIR__ . "/../../config.php";


class BaseController
{
    protected $auth;
    protected $view;

    public function __construct()
    {
        $this->auth = new Auth();
        /**
         * Устанавливаем view в базовом контроллере.
         * Настройка устанавливается в конфиге
         */
        $this->view = new ViewNative();
        if (!empty(TEMPLATE) && TEMPLATE == 'twig') {
            $this->view = new ViewTwig();
        }
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

