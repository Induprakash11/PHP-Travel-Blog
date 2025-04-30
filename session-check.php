<!-- < ?php require_once __DIR__ . '/controllers/load.php';

// Check if the user is logged in
if (Session::has('user_id')) {
    echo "logged_in";
} 
?> -->

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


            // Form validation for adding user
            $('#addUserModal form').on('submit', function(e) {
                e.preventDefault();
            
                // Validation logic
                const username = $('#username').val().trim();
                const email = $('#email').val().trim();
                const password = $('#password').val().trim();
            
                if (!username) {
                    alert('Username is required.');
                    return;
                }
            
                if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    alert('A valid email is required.');
                    return;
                }
            
                if (!password || password.length < 6) {
                    alert('Password must be at least 6 characters long.');
                    return;
                }
            
                // Show success message
                alert('User added successfully!');
            
                // Close modal
                $('#addUserModal').modal('hide');
            });

            // Form validation for editing user
            $('#editUserModal form').on('submit', function(e) {
                e.preventDefault();

                // Validation logic would go here

                // Show success message
                alert('User updated successfully!');

                // Close modal
                $('#editUserModal').modal('hide');
            });

            // Form validation for adding blog post
            $('#addBlogModal form').on('submit', function(e) {
                e.preventDefault();

                // Validation logic would go here

                // Show success message
                alert('Blog post created successfully!');

                // Close modal
                $('#addBlogModal').modal('hide');
            });

            // Form validation for editing blog post
            $('#editBlogModal form').on('submit', function(e) {
                e.preventDefault();

                // Validation logic would go here

                // Show success message
                alert('Blog post updated successfully!');

                // Close modal
                $('#editBlogModal').modal('hide');
            });

            // Form validation for adding category
            $('#addCategoryModal form').on('submit', function(e) {
                e.preventDefault();

                // Validation logic would go here

                // Show success message
                alert('Category added successfully!');

                // Close modal
                $('#addCategoryModal').modal('hide');
            });

            // Auto-generate slug from category name
            $('#categoryName').on('input', function() {
                const name = $(this).val();
                const slug = name.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                $('#categorySlug').val(slug);
            });

            // Toggle maintenance mode switch label
            $('#maintenanceMode').on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).next().text('Disable Maintenance Mode');
                } else {
                    $(this).next().text('Enable Maintenance Mode');
                }
            });

            // Test email settings button
            $('.btn-info').on('click', function() {
                alert('This is a prototype. Connection to mail server will be added in the final version.');
            });


<?php
require_once __DIR__ . '/controllers/load.php';

// Start session
if (class_exists('Session')) {
    Session::start();
} else {
    die('Session class not found.');
    $entered_otp = class_exists('Utils') ? Utils::sanitize($_POST['otp'] ?? '') : ($_POST['otp'] ?? '');
    }
// Check if OTP form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify_otp'])) {
    $entered_otp = Utils::sanitize($_POST['otp'] ?? '');

    if (empty($entered_otp)) {
        Utils::setFlash('otp_error', 'Please enter the OTP.');
    } else {
        // Check if OTP matches
        if (isset($_SESSION['otp']) && $entered_otp == $_SESSION['otp']) {
            // OTP is correct, log the user in by setting session user_id
            $email = $_SESSION['user_email'] ?? '';
            $name = $_SESSION['user_name'] ?? '';
            $user = class_exists('User') ? User::getUserByEmail($email) : null;
            $created_at = $_SESSION['user_created'] ?? date('Y-m-d H:i:s');

            // Fetch user id from database using email
            $user = User::getUserByEmail($email);
            if ($user) {
                // Use Session::set() and set all user session variables consistently
                User::setUserSession($user);

                // Clear OTP session variable
                Session::remove('otp');

                // Redirect to home page
                Utils::redirect('home');
                exit;
            } else {
                Utils::setFlash('otp_error', 'User not found.');
            }
        } else {
            Utils::setFlash('otp_error', 'Invalid OTP. Please try again.');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Travel Blog</title>
    <link rel="stylesheet" href="assets/style/styles.css" />
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card my-5 shadow">
                    <div class="card-header">
                        <h2>Enter OTP</h2>
                    </div>
                    <div class="card-body">
                        <?php echo Utils::displayFlash('otp_error', 'danger'); ?>
                        <form method="POST" class="card-body p-4">
                            <div class="mb-3">
                                <label for="otp" class="form-label">OTP Code</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="otp"
                                    name="otp"
                                    placeholder="Enter the OTP sent to your email"
                                    required
                                />
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="verify_otp" class="btn btn-block">Verify OTP</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>