<?php

namespace App\Services;

/**
 * Class Auth
 * @package App\Auth
 */
class Auth
{
    const SESSION_INDEX_USER = 'user';

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $_SESSION[self::SESSION_INDEX_USER];
    }

    /**
     * @return bool
     */
    public function guest()
    {
        return empty($_SESSION[self::SESSION_INDEX_USER]);
    }

    /**
     * @param array $user
     */
    public function login(array $user)
    {
        $_SESSION[self::SESSION_INDEX_USER] = $user;
    }


    public function logout()
    {
        $_SESSION[self::SESSION_INDEX_USER] = null;
    }
}