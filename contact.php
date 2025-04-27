<?php require_once __DIR__ . '/controllers/load.php';

// start the session
Session::start();

// check if the user is authenticated
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

    <!-- Contact Content -->
    <?= ViewTemp::view("_contact") ?>

    <!-- Footer -->
    <?= ViewTemp::view("_footer") ?>

</body>
</html>