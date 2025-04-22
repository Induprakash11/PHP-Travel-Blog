<?php require_once __DIR__.'/../../controllers/load.php';

$users = User::getAllUsers();
$blogs = Blogs::getAllBlogs();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addBlog'])) {
    $title = Utils::sanitize($_POST['title']);
    $content = Utils::sanitize($_POST['content']);
    $user = Utils::sanitize($_POST['user']);
    $user_id = User::getUserId($user);
    $status = Utils::sanitize($_POST['status']);
    $image = isset($_FILES['file']) ? $_FILES['file'] : null;

    if (User::checkEmptyFields([$title, $content, $user, $user_id, $status, $image])) {
        Utils::setFlash('Fill all fields', 'Please fill in all fields');
    } elseif ($image && $image['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($image['type'], $allowedTypes)) {
            Utils::setFlash('File type error', 'Invalid file type. Only JPG, PNG, and GIF are allowed.');
        } elseif ($image['size'] > $maxFileSize) {
            Utils::setFlash('File size error', 'File size exceeds the 5MB limit.');
        } else {
            Blogs::addBlog($title, $content, $user, $user_id, $status, $image);
            Utils::setFlash('Blog added', 'Blog added successfully!');
            Utils::redirect('blogs');        
        }
    } else {
        Utils::setFlash('Upload error', 'Please upload a file.');
    }
}

?>