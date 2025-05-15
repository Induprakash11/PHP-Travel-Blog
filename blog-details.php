<?php require_once __DIR__ . '/controllers/load.php';

// Start the session
Session::start();

// Check if the user is already logged in
User::isAuthenticated();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head Content -->
    <?= ViewTemp::view("_head") ?>
</head>
<body>
    <!-- Loading Bar -->
    <div id="loading-bar"></div>
    
    <!-- Navbar -->
    <?= ViewTemp::view("_navbar") ?>

    <!-- Blog Details -->
    <?= ViewTemp::view("_blog_details") ?>

    <!-- Footer -->
    <?= ViewTemp::view("_footer") ?>

    <script src="/Travel Blog/assets/Js/like.js"></script>
    <script src="/Travel Blog/assets/Js/share.js"></script>
</body>
</html>
