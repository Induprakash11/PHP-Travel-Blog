<?php require_once __DIR__.'/../../controllers/load.php';

$users = User::getAllUsers();
$blogs = Blogs::getAllBlogs();

?>