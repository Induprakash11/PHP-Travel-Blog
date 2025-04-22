<?php require_once __DIR__.'/../controllers/load.php';

Database::connection();
User::onlyAdmin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Blog - Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Chart.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include "inc/sidebar.php"; ?>

        <!-- Page Content -->
        <div id="content">
            <!-- Top Navbar -->
            <?php include "inc/navbar.php"; ?>

            <!-- Main Content Area -->
            <div class="container-fluid">

                <!-- Blog Management Section -->
                <?php include "inc/blog.php" ?>
 
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap Bundle  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- Custom JS -->
    <script id="app-script">
        <?php include "inc/script.php" ?>
    </script>
</body>

</html>