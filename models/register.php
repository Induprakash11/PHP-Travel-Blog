<?php 
require_once __DIR__ . '/../controllers/load.php';
require_once __DIR__. '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Sanitize user input
    $name = Utils::sanitize($_POST['username'] ?? '');
    $email = Utils::sanitize($_POST['email'] ?? '');
    $password = Utils::sanitize($_POST['password'] ?? '');

    // Validate user input
    if (User::checkEmptyFields([$name, $email, $password])) {
        Utils::setFlash('field error', 'All fields are required.');
        
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Utils::setFlash('email invalid error', 'Invalid email format.');
        
    }

    // Check if the email is already registered
    if (User::isEmailRegistered($email)) {
        Utils::setFlash('email error', 'Email already registered.');
        
    }

    // Check password strength
    if (!User::isStrongPassword($password)) {
        Utils::setFlash('password error', 'Password must be at least 8 characters long and contain at least one number and one special character.');
        
    }

    // Register the user
if (User::register($name, $email, $password)) {
    // Generate OTP
    $otp = rand(100000, 999999);

    // Start session
    Session::start();

    // Fetch user details by email
    $user = User::getUserByEmail($email);

    // Set OTP in session
    Session::set('otp', $otp);

    // Set user session variables using helper function
    User::setUserSession($user);

    // Send OTP email
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'prakashindu212@gmail.com'; // SMTP username
        $mail->Password = 'dwxi ense cepp msjv'; // SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('TravelBlog@example.com', 'Travel Blog');
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'OTP Code';
        $mail->Body    = "Your OTP code is: <b>$otp</b>";

        $mail->send();
    } catch (Exception $e) {
        Utils::setFlash('email error', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        Utils::redirect('register');
        exit;
    }

    Utils::redirect('otp');
} else {
    Utils::setFlash('register error', 'An error occurred during registration. Please try again.');
}
}
?>