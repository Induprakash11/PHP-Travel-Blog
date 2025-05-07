<?php
require_once __DIR__ . '/../controllers/load.php';

Session::start();

if (!Session::has('user_id')) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// Check if the user is logged in
$user_id = $_SESSION['user_id'];
$blog_id = $_POST['blog_id'] ?? null;
$liked = isset($_POST['liked']) ? (int)$_POST['liked'] : 0;

// Validate the blog ID
if (!$blog_id) {
    echo json_encode(['success' => false, 'message' => 'Invalid blog ID']);
    exit;
}

// check if liked is 1 or 0
if ($liked === 1) {
    $result = Blogs::addLike($blog_id, $user_id);
} else {
    $result = Blogs::removeLike($blog_id, $user_id);
}

// Check if the like status was updated successfully
if ($result) {
    $likeCount = Blogs::getLikesCount($blog_id);
    echo json_encode(['success' => true, 'likeCount' => $likeCount]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update like status']);
}
?>
