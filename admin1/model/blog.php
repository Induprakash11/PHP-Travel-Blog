<?php require_once __DIR__.'/../../controllers/load.php';
// Removed unused Carbon import

$users = User::getAllUsers();

$searchTerm = $_GET['blogSearch'] ?? '';

if (!empty($searchTerm)) {
    $blogs = Blogs::searchBlogs($searchTerm);
} else {
    $blogs = Blogs::getAllBlogs();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addBlog'])) {
    $title = Utils::sanitize($_POST['title']);
    $content = Utils::sanitize($_POST['content']);
    $userId = Utils::sanitize($_POST['userId']);
    $status = Utils::sanitize($_POST['status']);
    $image = isset($_FILES['file']) ? $_FILES['file'] : null;

    if (User::checkEmptyFields([$title, $content, $userId, $status, $image])) {
        Utils::setFlash('Fill all fields', 'Please fill in all fields');
    } elseif ($image && $image['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($image['type'], $allowedTypes)) {
            Utils::setFlash('File type error', 'Invalid file type. Only JPG, PNG, and GIF are allowed.');
        } elseif ($image['size'] > $maxFileSize) {
            Utils::setFlash('File size error', 'File size exceeds the 5MB limit.');
        } else {
            Blogs::addBlog($title, $content, $userId, $status, $image);
            Utils::setFlash('Blog added', 'Blog added successfully!');
            Utils::redirect('blogs');        
        }
    } else {
        Utils::setFlash('Upload error', 'Please upload a file.');
    }
}

// method to Edit Blog
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editBlog'])) {
    $blog_id = isset($_POST['editId']) ? Utils::sanitize($_POST['editId']) : null;
    $title = Utils::sanitize($_POST['editTitle']);
    $content = Utils::sanitize($_POST['editContent']);
    $userId = Utils::sanitize($_POST['editUser']);
    $status = Utils::sanitize($_POST['editStatus']);
    $image = isset($_FILES['file']) ? $_FILES['file'] : null;

    if (User::checkEmptyFields([$blog_id, $title, $content, $userId, $status])) {
        Utils::setFlash('Fill all fields', 'Please fill in all fields');
    } else {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            if (!in_array($image['type'], $allowedTypes)) {
                Utils::setFlash('File type error', 'Invalid file type. Only JPG, PNG, and GIF are allowed.');
            } elseif ($image['size'] > $maxFileSize) {
                Utils::setFlash('File size error', 'File size exceeds the 5MB limit.');
            } else {
                Blogs::editBlog($blog_id, $title, $content, $userId, $status, $image);
                Utils::setFlash('Blog updated', 'Blog updated successfully!');
                Utils::redirect('blogs');
            }
        } else {
            // No new image uploaded, update without image
            Blogs::editBlog($blog_id, $title, $content, $userId, $status, null);
            Utils::setFlash('Blog updated', 'Blog updated successfully!');
            Utils::redirect('blogs');
        }
    }
}
?>