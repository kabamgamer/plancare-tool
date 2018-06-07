<?php

class Cookie
{
    /**
     * Set a cookie
     *
     * @param string $name  = Cookie name
     * @param mixed $value  = Cookie value
     * @param int $expiry   = Optional: Cookie expiry|24 hours by default
     */
    public static function set($name, $value, $expiry = 3600)
    {
        // Set expiry time, 24 hours by default.
        $expiry = time() + $expiry;

        // Set Cookie
        setcookie($name, $value, $expiry);
        $_COOKIE[$name] = $value;
    }

    /**
     * Check if cookie exists
     *
     * @param string $name  = Cookie name
     * @return bool
     */
    public static function exists($name)
    {
        if (isset($_COOKIE[$name])) {
            return true;
        }

        return false;
    }

    /**
     * Get a cookie value
     *
     * @param string $name  = Cookie name
     * @return mixed
     */
    public static function get($name)
    {
        return $_COOKIE[$name];
    }

    /**
     * Delete a Cookie
     *
     * @param string $name  = Cookie name
     */
    public static function delete($name)
    {
        if(self::exists($name)) {
            setcookie($name, "", time() - 3600);
        }
    }
}