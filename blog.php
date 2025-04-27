<?php require_once __DIR__ . '/controllers/load.php';

// Start the session
Session::start();

// Check if the user is already logged in
User::isAuthenticated();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ViewTemp::view head content -->
    <?= ViewTemp::view("_head") ?>
</head>
<body>
    <!-- Loading Bar -->
    <div id="loading-bar"></div>
    
    <!-- ViewTemp::view navbar -->
    <?= ViewTemp::view("_navbar") ?>

    <!-- ViewTemp::view blog content -->
    <?= ViewTemp::view("_blog") ?>

    <!-- ViewTemp::view footer -->
    <?= ViewTemp::view("_footer") ?>
</body>
</html>