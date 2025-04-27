<?php
require_once __DIR__ . '/../controllers/load.php';

// Check if user is admin
User::onlyAdmin();
  
// Get user ID from query parameter
if (!isset($_GET['id']) || empty($_GET['id'])) {
    Utils::setFlash('UserID error', 'User ID is missing.');
    Utils::redirect('users');
}

$userId = intval($_GET['id']);

// Delete blogs by user ID
$blogsDeleted = Blogs::deleteBlogsByUserId($userId);

// Delete user
$userDeleted = User::deleteUser($userId);

if ($userDeleted) {
    Utils::setFlash('User deleted', 'User and associated blogs deleted successfully.');
} else {
    Utils::setFlash('User error', 'Failed to delete user.');
}

Utils::redirect('users');
?>
