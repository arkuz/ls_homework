<?php

namespace App\Auth;

/**
 * Class Auth
 * @package App\Service
 */
class Auth
{
    const SESSION_INDEX_USER = 'user';

    public static function getUser()
    {
        return $_SESSION[self::SESSION_INDEX_USER];
    }

    public static function isUserLogin()
    {
        return !empty($_SESSION[self::SESSION_INDEX_USER]);
    }

    public static function setLogin(array $user)
    {
        $_SESSION[self::SESSION_INDEX_USER] = $user;
    }

    public static function setLogout()
    {
        $_SESSION[self::SESSION_INDEX_USER] = null;
    }
}