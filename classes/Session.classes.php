<?php require_once __DIR__ . '/../controllers/load.php';

class Session
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        self::start();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function has($key)
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove($key)
    {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy()
    {
        self::start();
        session_destroy();
        $_SESSION = [];
    }

    public static function regenerateId($deleteOldSession = true)
    {
        self::start();
        session_regenerate_id($deleteOldSession);
    }

    public static function clear()
    {
        self::start();
        $_SESSION = [];
    }
}
?>
