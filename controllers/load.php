<?php
require_once __DIR__.'/../classes/ConfigLoader.php';
require_once __DIR__.'/../classes/Database.classes.php';
require_once __DIR__.'/../classes/User.classes.php';
require_once __DIR__.'/../classes/Session.classes.php';
require_once __DIR__.'/../classes/Blogs.classes.php';
require_once __DIR__.'/../classes/Contact.classes.php';
require_once __DIR__.'/../classes/Utils.classes.php';
require_once __DIR__.'/../models/register.php';
require_once __DIR__.'/../models/login.php';
require_once __DIR__.'/../models/blogs.php';
require_once __DIR__.'/../models/contact.php';
// Load the configuration file
class ViewTemp {
    public static function view($name){
        include $_SERVER['DOCUMENT_ROOT'] . "/Travel Blog/views/" . $name . ".php";
    }
    
    // public static function loadRequiredClasses() {
    // $classes = [
    //     '/../classes/ConfigLoader.php',
    //         '/../classes/Database.classes.php',
    //         '/../classes/User.classes.php',
    //         '/../classes/Session.classes.php',
    //         '/../classes/Blogs.classes.php',
    //         '/../classes/Contact.classes.php',
    //         '/../classes/Utils.classes.php',
    //         '/../models/register.php',
    //         '/../models/login.php',
    //         '/../models/blogs.php',
    //         '/../models/contact.php'
    //     ];
    
    //     foreach ($classes as $class) {
    //         require_once __DIR__ . $class;
    //     }
    // }
}

?>