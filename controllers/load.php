<?php
require_once __DIR__.'/../classes/ConfigLoader.php';
require_once __DIR__.'/../classes/Database.classes.php';
require_once __DIR__.'/../classes/User.classes.php';
require_once __DIR__.'/../classes/Session.classes.php';
require_once __DIR__.'/../classes/Blogs.classes.php';
require_once __DIR__.'/../classes/Contact.classes.php';
require_once __DIR__.'/../classes/Utils.classes.php';
require_once __DIR__.'/../classes/Reviews.classes.php';
require_once __DIR__.'/../models/register.php';
require_once __DIR__.'/../models/login.php';
require_once __DIR__.'/../models/blogs.php';
require_once __DIR__.'/../models/contact.php';
require_once __DIR__.'/../models/otp.php';
require_once __DIR__.'/../models/dashboard.php';

// Load the configuration file
class ViewTemp {
    public static function view($name){
        include $_SERVER['DOCUMENT_ROOT'] . "/Travel Blog/views/" . $name . ".php";
    }
}

?>