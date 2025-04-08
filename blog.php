<?php require_once __DIR__ . '/controllers/load.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ViewTemp::view head content -->
    <?= ViewTemp::view("_head") ?>
</head>
<body>
    <!-- ViewTemp::view navbar -->
    <?= ViewTemp::view("_navbar") ?>

    <!-- ViewTemp::view blog content -->
    <?= ViewTemp::view("_blog") ?>

    <!-- ViewTemp::view footer -->
    <?= ViewTemp::view("_footer") ?>
</body>
</html>