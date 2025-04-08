<?php require_once __DIR__ . '/../controllers/load.php';
// Start the session
Session::start();

// Check if the user is already logged in
User::isAuthenticated();