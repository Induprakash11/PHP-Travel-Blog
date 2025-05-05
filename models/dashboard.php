<?php require_once __DIR__ . '/../controllers/load.php';

// Handle delete user account POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUser'])) {
    $userId = intval($_POST['deleteUser']);
    if ($userId === intval($_SESSION['user_id'])) {
        $deleted = User::deleteUser($userId);
        if ($deleted) {
            // Destroy session and redirect to home or goodbye page
            Session::destroy();
            Utils::setFlash('delete_success', 'Your account has been deleted successfully.');
           Utils::redirect('home');
        } else {
            Utils::setFlash('delete_error', 'Failed to delete your account. Please try again.');
            Utils::redirect('dashboard');
        }
    } else {
        Utils::setFlash('delete_error', 'Invalid user ID.');
    }
}
?>