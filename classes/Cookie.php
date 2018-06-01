<?php

class Cookie
{
    public static function set($name, $value, $expiry = 3600)
    {
        // Set expiry time, 24 hours by default.
        $expiry = time() + $expiry;

        // Set Cookie
        setcookie($name, $value, $expiry);
        $_COOKIE[$name] = $value;
    }

    public static function exists($name)
    {
        if (isset($_COOKIE[$name])) {
            return true;
        }

        return false;
    }

    public static function get($name)
    {
        return $_COOKIE[$name];
    }

    public static function delete($name)
    {
        if(self::exists($name)) {
            setcookie($name, "", time() - 3600);
        }
    }
}