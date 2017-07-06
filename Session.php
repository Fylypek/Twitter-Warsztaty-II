<?php
/*
 * klasa sesji i jej osbłuda 
 * 
 */
class Session 
{

    public static function init()
    {
        session_start();

    }
    
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
    public static function get($key)
    {
        return isset($_SESSION[$key])? $_SESSION[$key]: null;
    }    

    public static function destroy()
    {
        session_destroy();
    }    
}

