<?php
class SessionUser
{
    public static function getId()
    {
        return self::isAuthenticated() ? $_SESSION['user']['id'] : null;
    }

    public static function getUserName()
    {
        return self::isAuthenticated() ? $_SESSION['user']['username'] : null;
    }

    public static function getEmail()
    {
        return self::isAuthenticated() ? $_SESSION['user']['email'] : null;
    }

    public static function getRole()
    {
        return self::isAuthenticated() ? $_SESSION['user']['role'] : null;
    }

    public static function isAuthenticated()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['authenticated'] === true;
    }
}
