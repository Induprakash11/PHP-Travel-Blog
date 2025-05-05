<?php 
require_once __DIR__ . '/../controllers/load.php';
require_once __DIR__. '/../vendor/autoload.php';


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Sanitize user input
    $name = Utils::sanitize($_POST['username'] ?? '');
    $email = Utils::sanitize($_POST['email'] ?? '');
    $password = Utils::sanitize($_POST['password'] ?? '');
    $confirmPassword = Utils::sanitize($_POST['confirmPassword'] ?? '');
    $role = Utils::sanitize('user');
    

    // Check if passwords match
    if ($password !== $confirmPassword) {
        Utils::setFlash('password match error', 'Passwords do not match.');
        Utils::redirect('register');
    }
    
    // Validate user input
    if (User::checkEmptyFields([$name, $email, $password])) {
        Utils::setFlash('register field error', 'All fields are required.');
        Utils::redirect('register');
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Utils::setFlash('register email error', 'Invalid email format.');
        Utils::redirect('register');
    }

    // Check if the email is already registered
    if (User::isEmailRegistered($email)) {
        Utils::setFlash('register already error', 'Email already registered.');
        Utils::redirect('register');
    }

    // Check password strength
    if (!User::isStrongPassword($password)) {
        Utils::setFlash('register password error', 'Password must be at least 8 characters long and contain at least one number and one special character.');
        Utils::redirect('register');
    }

    // hash the password before storing it
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Generate OTP
    $otp = User::generateOtp();

    // If OTP is generated and email is sent successfully
    if (!empty($otp) && User::sendOtpEmail($email, $otp, $name)) {

        Session::start();
        //set session 
        Session::set('otp', $otp);
        Session::set('user_id', null); 
        Session::set('user_name', $name);
        Session::set('user_email', $email);
        Session::set('user_password', $passwordHash);
        Session::set('user_role', $role);
   
        // send Otp via Email
        Utils::setFlash('register otp verification', 'OTP Send. Please Check your Email');
        Utils::redirect('otp');
    } else {
        Utils::setFlash('register sendotp error', 'Failed to send OTP email. Please try again.');
        Utils::redirect('register');
    }
}
?>
