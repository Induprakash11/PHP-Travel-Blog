<?php require_once __DIR__.'/../controllers/load.php';

Database::connection();
User::onlyAdmin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "inc/head.php"; ?>
</head>

<body>
    <!-- Preloader -->
    <div id="loading-bar"></div>
    
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <!-- Bootstrap Bundle  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- Custom JS -->
    <script id="app-script">
        <?php include "inc/script.php" ?>
    </script>

    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>