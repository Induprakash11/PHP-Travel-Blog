<?php require_once __DIR__.'/../../controllers/load.php';

$users = User::getAllUsers();
$blogs = Blogs::getAllBlogs();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {
    $username = Utils::sanitize($_POST['username']);
    $email = Utils::sanitize($_POST['email']);
    $password = Utils::sanitize($_POST['password']);
    $confirmPassword = $_POST['confirmPassword'];
    $role = Utils::sanitize($_POST['role']);

    // Debugging line removed to allow the script to proceed

    if (User::checkEmptyFields([$username, $email, $password, $confirmPassword, $role])) {
        Utils::setFlash('Please fill in all fields', 'danger');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Utils::setFlash('Invalid email format.', 'danger');
    } elseif ($password !== $confirmPassword) {
        Utils::setFlash('Passwords do not match.', 'danger');
    } elseif (User::addUser($username, $email, $password, $role)) {
        Utils::setFlash('User added', 'User added successfully');
        header('Location: users');
        exit();
    } else {
        Utils::setFlash('User not added', 'danger');
    }
}

?>