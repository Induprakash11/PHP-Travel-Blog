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
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resend_otp'])) {
//     // Rate limiting: allow resend only if 60 seconds have passed since last OTP generation
//     $last_otp_time = Session::get('otp_generated_time') ?? 0;
//     $current_time = time();
//     if ($current_time - $last_otp_time < 60) {
//         Utils::setFlash('otp_error', 'Please wait before requesting a new OTP.');
//         Utils::redirect('otp');
        
//     }

//     // Generate new OTP
//     $otp = rand(100000, 999999);

//     // Update OTP and generation time in session
//     Session::set('otp', $otp);
//     Session::set('otp_generated_time', $current_time);

//     // Get user details from session
//     $email = $_SESSION['user_email'] ?? '';
//     $name = $_SESSION['user_name'] ?? '';

//     // Ensure email and name are available
//     if (empty($email) || empty($name)) {
//         Utils::setFlash('email_error', 'User details are missing. Please try again.');
//         Utils::redirect('otp');
        
//     }

//     // Send OTP email
//     $mail = new PHPMailer\PHPMailer\PHPMailer(true);
//     try {
//         // Server settings
//         $mail->isSMTP();
//         $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
//         $mail->SMTPAuth = true;
//         $mail->Username = 'prakashindu212@gmail.com'; // SMTP username
//         $mail->Password = 'dwxi ense cepp msjv'; // SMTP password
//         $mail->SMTPSecure = 'tls';
//         $mail->Port = 587;

//         // Recipients
//         $mail->setFrom('TravelBlog@example.com', 'Travel Blog');
//         $mail->addAddress($email, $name);

//         // Content
//         $mail->isHTML(true);
//         $mail->Subject = 'OTP Code - Resend';
//         $mail->Body = "
//         <html>
//         <head>
//             <style>
//             .otp-email {
//                 font-family: Arial, sans-serif;
//                 line-height: 1.6;
//                 color: #333;
//             }
//             .otp-header {
//                 background-color: #4CAF50;
//                 color: white;
//                 padding: 10px;
//                 text-align: center;
//                 font-size: 24px;
//             }
//             .otp-body {
//                 padding: 20px;
//                 text-align: center;
//             }
//             .otp-code {
//                 font-size: 32px;
//                 font-weight: bold;
//                 color: #4CAF50;
//                 margin: 20px 0;
//             }
//             .otp-footer {
//                 margin-top: 20px;
//                 font-size: 14px;
//                 color: #777;
//             }
//             </style>
//         </head>
//         <body>
//             <div class='otp-email'>
//             <div class='otp-header'>Travel Blog - OTP Verification</div>
//             <div class='otp-body'>
//                 <p>Dear $name,</p>
//                 <p>Your OTP has been resent. Please use the following OTP to verify your email address:</p>
//                 <div class='otp-code'>$otp</div>
//                 <p>This OTP is valid for 10 minutes. If you did not request this, please ignore this email.</p>
//             </div>
//             <div class='otp-footer'>
//                 <p>Best regards,<br>Travel Blog Team</p>
//             </div>  
//             </div>
//         </body>
//         </html>";

//         $mail->send();

//         Utils::setFlash('otp_success', 'OTP has been resent successfully.');
//         Utils::redirect('otp');
        
//     } catch (Exception $e) {
//         Utils::setFlash('email_error', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
//         Utils::redirect('otp');
        
//     }
// }
?>
