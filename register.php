<?php require_once __DIR__ . '/controllers/load.php';

// start the session
Session::start();

// Check if the user is already logged in
User::isNotAuthenticated();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--  Head Content  -->
    <?= ViewTemp::view("_head") ?>
</head>
<body>
    <!-- Navbar -->
    <?= ViewTemp::view("_navbar") ?>

    <!-- Register Content -->
    <?= ViewTemp::view("_register") ?>

    <!-- Footer -->
    <?= ViewTemp::view("_footer") ?>

</body>
</html>