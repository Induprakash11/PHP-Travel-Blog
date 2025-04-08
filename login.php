<?php require_once __DIR__ . '/controllers/load.php';

//start the session
Session::start();

// Check if the user is already logged in
if(isset($_SESSION['user_id'])) {
    // Redirect to the dashboard if the user is already logged in
    header("Location: home");
    exit();
}

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

    <!-- Login Content -->
    <?= ViewTemp::view("_login") ?>

    <!-- Footer -->
    <?= ViewTemp::view("_footer") ?>

</body>

</html>