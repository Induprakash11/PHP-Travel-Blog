<?php require_once __DIR__.'/../../controllers/load.php';
use Carbon\Carbon;

$users = User::getAllUsers();
$blogs = Blogs::getAllBlogs();

?>