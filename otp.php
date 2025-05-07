<?php require_once __DIR__ . '/controllers/load.php';

// ensure only show after creating an otp
if (!isset($_SESSION['otp'])) {
    Utils::redirect("register");
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

    <!-- Hero Content -->
    <?= ViewTemp::view("_otp") ?>

    <!-- Footer -->
    <?= ViewTemp::view("_footer") ?>

    <!-- custom JS -->
    <script src="/Travel Blog/assets/Js/otp.js"></script>
    
</body>

</html>