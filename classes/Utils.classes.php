<?php require_once __DIR__ . '/../controllers/load.php';

class Utils {

    // method to sanitize user input
    public static function sanitize($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }

    // method to redirect to a different page
    public static function redirect($page) {
        header("Location: $page");
        exit();
    }

    // method to set a flash message
    public static function setFlash($name, $message) {
        Session::start();
        $_SESSION[$name] = $message;
    }

    // method to display a flash message
    public static function displayFlash($name, $type) {
        if (isset($_SESSION[$name])) {
            echo "<div class='alert alert-$type'>".$_SESSION[$name]."</div>";
            unset($_SESSION[$name]);
        }
    }
}