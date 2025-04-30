<?php require_once __DIR__ . '/controllers/load.php';
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
</body>
</html>