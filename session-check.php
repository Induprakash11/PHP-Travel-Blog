<?php require_once __DIR__ . '/controllers/load.php';

// Check if the user is logged in
if (Session::has('user_id')) {
    echo "logged_in";
} 
?>

<!-- <script>
        // This function is used to check if the user is logged in or not to Redirect to home.php
function checkLoginStatus() {
    fetch("session-check.php")
        .then(response => response.text())
        .then(data => {
            if (data === "logged_in") {
                window.location.href = "home"; // Redirect to home.php
            }
        });
    }
    
    checkLoginStatus([],1); // Run on page ViewTemp::view    
</script> -->