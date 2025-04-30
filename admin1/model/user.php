<?php require_once __DIR__.'/../../controllers/load.php';
use Carbon\Carbon;

$blogs = Blogs::getAllBlogs();

$searchTerm = $_GET['userSearch'] ?? '';

if (!empty($searchTerm)) {
    $users = User::searchUsers($searchTerm);
} else {
    $users = User::getAllUsers();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {
    $username = Utils::sanitize($_POST['username']);
    $email = Utils::sanitize($_POST['email']);
    $password = Utils::sanitize($_POST['password']);
    $confirmPassword = $_POST['confirmPassword'];
    $role = Utils::sanitize($_POST['role']);

    // Debugging line removed to allow the script to proceed

    if (User::checkEmptyFields([$username, $email, $password, $confirmPassword, $role])) {
        Utils::setFlash('Fields error', 'Please fill in all fields');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Utils::setFlash('Email error', 'Invalid email format.');
    } elseif ($password !== $confirmPassword) {
        Utils::setFlash('Password error', 'Passwords do not match.');
    } elseif (!User::isStrongPassword($password)) {
        Utils::setFlash('Password input error', 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.');
    } elseif (User::isEmailRegistered($email)) {
        Utils::setFlash('Email error', 'Email already registered');
    } elseif (User::addUser($username, $email, $password, $role)) {
        Utils::setFlash('User added', 'User added successfully');
        header('Location: users');
        exit();
    } else {
        Utils::setFlash('User error', 'User Not Found');
    }
}

// Edit user Modal 
if (isset($_POST['editUser']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = Utils::sanitize($_POST['editId']);
    $username = Utils::sanitize($_POST['editName']);
    $email = Utils::sanitize($_POST['editEmail']);
    $password = Utils::sanitize($_POST['editPassword']);
    $role = Utils::sanitize($_POST['editRole']);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Utils::setFlash('Email error', 'Invalid email format.');
    } elseif (User::editUser($userId, $username, $email, $password, $role)) {
        Utils::setFlash('User Updated', 'User updated successfully');
        Utils::redirect('users');
    } else {
        Utils::setFlash('User error', 'User Not Found');
    }
}

?>