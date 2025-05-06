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

        
        
        
            if (empty($entered_otp)) {
        Utils::setFlash('otp_error', 'Please enter the OTP.');
        Utils::redirect('otp');
        exit;
    } else {
        // Check if OTP matches
        if (isset($_SESSION['otp']) && $entered_otp == $_SESSION['otp']) {
            // OTP is correct, proceed with user verification
            $email = $_SESSION['user_email'] ?? '';
            $name = $_SESSION['user_name'] ?? '';
            $created_at = $_SESSION['user_created'] ?? date('Y-m-d H:i:s');

            // Check if user exists
            $user = class_exists('User') ? User::getUserByEmail($email) : null;

            if (!$user) {
                // Create a new user if not exists
                $password = Session::get('user_password') ?? '';
                $user_id = User::register($name, $email, $password);
                if (!$user_id) {
                    Utils::setFlash('otpUser_error', 'Failed to create user account.');
                    Utils::redirect('otp');
                    exit;
                }
                $user = User::getUserByEmail($email);
            }

            if ($user) {
                // Set user session
                User::setUserSession($user);

                // Clear OTP session variables
                Session::remove('otp');
                Session::remove('otp_generated_time');

                // Set OTP verified flag in session
                Session::set('otp_verified', true);

                // Redirect to home page
                Utils::redirect('home');
                exit;
            } else {
                Utils::setFlash('otpUser_error', 'User not found.');
                Utils::redirect('otp');
                exit;
            }
        } else {
            Utils::setFlash('Invalid_otp', 'Invalid OTP. Please try again.');
            Utils::redirect('otp');
            exit;
        }
    }