<?php require_once __DIR__ . '/controllers/load.php';

// start the session
Session::start();

// Check if the user is already logged in
User::isAuthenticated();

?>

<!DOCTYPE html>
<html>
<head>
    <!-- Head -->
    <?= ViewTemp::view("_head") ?>
    
</head>
<body>
    <!-- Navbar -->
    <?= ViewTemp::view("_navbar") ?>

    <!-- Dashboard -->
    <?= ViewTemp::view("_dashboard") ?>

    <!-- Footer -->
    <?= ViewTemp::view("_footer")?>

</body>
</html>
