<?php require_once __DIR__.'/../../controllers/load.php';
use Carbon\Carbon;

$searchTerm = $_GET['blogSearch'] ?? '';

if (!empty($searchTerm)) {
    $blogs = Blogs::searchBlogs($searchTerm);
} else {
    $blogs = Blogs::getAllBlogs();
}

$searchTerm = $_GET['userSearch'] ?? '';

if (!empty($searchTerm)) {
    $users = User::searchUsers($searchTerm);
} else {
    $users = User::getAllUsers();
}
?>