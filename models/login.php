<?php require_once __DIR__ . '/../controllers/load.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input
    $email = Utils::sanitize($_POST['email'] ?? '');
    $password = Utils::sanitize($_POST['password'] ?? '');

    // Validate user input
    if (User::checkEmptyFields([$email, $password])) {
        Utils::setFlash('field error', 'All fields are required.');
        // die('error');
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Utils::setFlash('Invalid email error', 'Invalid email format.');
    }

    // Login the user
    if (User::login($email, $password)) {
        // Set session keys
        $user = User::fetchOne("SELECT * FROM users WHERE email = ?", [$email]);
        if ($user['role'] === 'user') {
            Session::set('user_id', $user['id']);
            Session::set('user_name', $user['name']);
            Session::set('user_email', $user['email']);
            Session::set('user_created', $user['created_at']);
            Utils::setFlash('login success', 'Login successful.');
            Utils::redirect('home');
        } else if ($user['role'] === 'admin') {
            Session::set('user_id', $user['id']);
            Session::set('user_name', $user['name']);
            Session::set('user_email', $user['email']);
            Session::set('user_created', $user['created_at']);
            Session::set('role', $user['role']);
            Utils::setFlash('login success', 'Login successful.');
            Utils::redirect('admin1/home');
        } else {
            Utils::setFlash('login error', 'Login failed.');
        }
    } else {
        Utils::setFlash('invalid login error', 'Invalid email or password.');
    }
}
?>