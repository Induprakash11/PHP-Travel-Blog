<?php 
require_once __DIR__ . '/../controllers/load.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input
    $name = Utils::sanitize($_POST['username'] ?? '');
    $email = Utils::sanitize($_POST['email'] ?? '');
    $password = Utils::sanitize($_POST['password'] ?? '');

    // Validate user input
    if (User::checkEmptyFields([$name, $email, $password])) {
        Utils::setFlash('error', 'All fields are required.');
        
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Utils::setFlash('error', 'Invalid email format.');
        
    }

    // Check if the email is already registered
    if (User::isEmailRegistered($email)) {
        Utils::setFlash('error', 'Email already registered.');
        
    }

    // Check password strength
    if (!User::isStrongPassword($password)) {
        Utils::setFlash('error', 'Password must be at least 8 characters long and contain at least one number and one special character.');
        
    }

    // Register the user
    if (User::register($name, $email, $password)) {
        Utils::setFlash('success', 'Registration successful. You can now log in.');
        Utils::redirect('login');
        
    } else {
        Utils::setFlash('error', 'An error occurred during registration. Please try again.');
        
    }
}