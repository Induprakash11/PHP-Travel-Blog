<?php require_once __DIR__ . '/../controllers/load.php'; 

Session::start();

//get otp
// Check if OTP form is submitted and verify the OTP
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify_otp'])) {
    $entered_otp = Utils::sanitize($_POST['otp'] ?? '');
    $session_otp = Session::get('otp');
    // Verify OTP
    if ($entered_otp === $session_otp) {
        // Register the user (example logic, replace with actual registration process)
        $name = Session::get('user_name') ?? '';
        $email = Session::get('user_email') ?? '';
        $password = Session::get('user_password') ?? '';
        $role = Session::get('user_role') ?? '';
        
        if (!empty($email) && !empty($name) && !empty($password)) {
            
            // Register a User
            User::register($name, $email, $password, $role);
            
            // Fetch the newly registered user details
            $user = User::getUserByEmail($email);
            // Set user session to keep the user logged in
            User::setUserSession($user);
            
            // Clear OTP from session
            Session::remove('otp');
                
            // Redirect to home page after successful registration
            Utils::setFlash('register success', "Registration successful. Welcome! $name");
            Utils::redirect('home');
            
        } else {
            Utils::setFlash('otp field error', 'User details are missing. Please try again.');
            Utils::redirect('otp');
            
        }
    } else {
        Utils::setFlash('otp_error', 'Invalid OTP. Please try again.');
        Utils::redirect('otp');
    }
}

// Handle resend OTP request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resend_otp'])) {

    // Generate new OTP
    $otp = User::generateOtp();

    // Update OTP and generation time in session
    Session::set('otp', $otp);
    
    // Get user details from session
    $email = Session::get('user_email') ?? '';
    $name = Session::get('user_name') ?? '';

    // Ensure email and name are available
    if (empty($email) || empty($name)) {
        Utils::setFlash('email_error', 'User details are missing. Please try again.');
        Utils::redirect('otp');
        
    }

    // Send OTP email
    if (User::sendOtpEmail($email, $otp, $name)) {
        Utils::setFlash('otp resend success', 'OTP resent successfully. Please check your email.');
        Utils::redirect('otp');      
    } else {
        Utils::setFlash('otp resend error', 'Failed to resend OTP. Please try again.');
        Utils::redirect('otp');
        
    }
}
?>
