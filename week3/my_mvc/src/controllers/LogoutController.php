<?php

namespace App\Controllers;


class LogoutController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if ($this->auth->guest()) {
            $this->redirect('/');
        }
    }

    /**
     * Логаут.
     */
    public function logout()
    {
        $this->auth->logout();
        $this->redirect('/');
    }
}