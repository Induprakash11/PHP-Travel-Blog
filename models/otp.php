<?php require_once __DIR__ . '/../controllers/load.php'; 

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