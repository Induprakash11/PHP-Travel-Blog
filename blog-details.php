<?php require_once __DIR__ . '/controllers/load.php';

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
    <!-- Navbar -->
    <?= ViewTemp::view("_navbar") ?>

    <!-- Blog Details -->
    <?= ViewTemp::view("_blog_details") ?>

    <!-- Footer -->
    <?= ViewTemp::view("_footer") ?>
</body>
</html>