<?php require_once __DIR__ . '/controllers/load.php';

//start the session
Session::start();

// Check if the user is already logged in
$redirect = $_GET['redirect'] ?? null;

if(isset($_SESSION['user_id'])) {
    // Redirect to the originally requested page if redirect parameter exists
    if ($redirect) {
        header("Location: " . $redirect);
    } else {
        header("Location: home");
    }
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
    <!-- Loading Bar -->
    <div id="loading-bar"></div>

    <!-- Navbar -->
    <?= ViewTemp::view("_navbar") ?>

    <!-- Login Content -->
    <?= ViewTemp::view("_login") ?>

    <!-- Footer -->
    <?= ViewTemp::view("_footer") ?>

</body>

</html>