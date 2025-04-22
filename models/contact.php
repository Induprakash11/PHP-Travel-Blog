<?php require_once __DIR__ . '/../controllers/load.php';
      require_once __DIR__. '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sendMail'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];

    if (empty($name) || empty($email) || empty($mobile) || empty($message)) {
        Utils::setFlash('field empty error', 'All fields are required.');
    } else {
        $Username = Session::get('user_name');

         if ($Username === null) {
             Utils::setFlash('user found error', 'User not logged in.');
         }

        $mail = new PHPMailer();
    
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'prakashindu212@gmail.com';
        $mail->Password = 'dwxi ense cepp msjv';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
    
        $mail->setFrom('example@gmail.com', 'Travel Blog');
        $mail->addAddress('prakashindu212@gmail.com', 'prakash');
    
        $mail->isHTML(true);
        $mail->Subject = 'Contact Details';

$mail->Body = '
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f7f7f7;
                padding: 20px;
                color: #333;
            }
            .email-container {
                background-color: #fff;
                border: 1px solid #ddd;
                padding: 20px;
                border-radius: 8px;
            }
            .email-container h2 {
                margin-top: 0;
                color: #4a90e2;
            }
            .email-container p {
                line-height: 1.6;
            }
            .label {
                font-weight: bolder;
                font-size: 18px;
                color:rgb(253, 83, 83);
            }
            .email-container p {
                color:rgb(25, 101, 151);
                font-size: 15px;
                font-weight: 500;
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <h2>Contact Details</h2>
            <p><span class="label">Username:</span> ' . htmlspecialchars($Username) . '</p>
            <p><span class="label">Name:</span> ' . htmlspecialchars($name) . '</p>
            <p><span class="label">Email:</span> ' . htmlspecialchars($email) . '</p>
            <p><span class="label">Mobile:</span> ' . htmlspecialchars($mobile) . '</p>
            <p><span class="label">Message:</span><br>' . nl2br(htmlspecialchars($message)) . '</p>
        </div>
    </body>
    </html>';

    
        if (!$mail->send()) {
            Utils::setFlash('mail send error','Message could not be sent.');
        } else {
            Utils::setFlash('mail send success','Message Send Successfully');
            Utils::redirect('home');
        }

    }
}
?>