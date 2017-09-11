<?php
class Session
{
    
    private static $_instance;
 
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new Session();
        }
        return self::$_instance;
    }
 
    private function __construct()
    {
        session_start();
    }

    public static function read($key)
    {
        return $_SESSION[$key];
    }
 
    public static function write($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
        $_SESSION[$key] = null;
    }
    public static function destroy()
    {
        session_unset();
        session_destroy();
    }
 
    public static function login($user)
    {
        $_SESSION['authentication_ip'] = $_SERVER['REMOTE_ADDR'];
        foreach ($user as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }
 
    public static function logout()
    {
        self::destroy();
    }
 
    public static function isLogged()
    {
        return (isset($_SESSION['id']) && isset($_SESSION['authentication_ip']) && $_SESSION['authentication_ip'] == $_SERVER['REMOTE_ADDR']);
    }
    public static function isAdmin()
    {
        return (isset($_SESSION['group']) && $_SESSION['group'] == 3 && isset($_SESSION['authentication_ip']) && $_SESSION['authentication_ip'] == $_SERVER['REMOTE_ADDR']);
    }
    public static function isWriter()
    {
        return (isset($_SESSION['group']) && $_SESSION['group'] == 2 && isset($_SESSION['authentication_ip']) && $_SESSION['authentication_ip'] == $_SERVER['REMOTE_ADDR']);
    }
}
