<?php require_once __DIR__ . '/../controllers/load.php';

// contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];

    if (empty($name) || empty($email) || empty($mobile) || empty($message)) {
        Utils::setFlash('error', 'All fields are required.');
    } else {
        $id = Session::get('user_id');

        if ($id === null) {
            Utils::setFlash('error', 'User not logged in.');
        }

        if (Contact::createContact($id, $name, $email, $mobile, $message)) {
            Utils::setFlash('success', 'Your message has been sent successfully.');
            Utils::redirect('contact');
        } else {
            Utils::setFlash('error', 'There was a problem sending your message.');
        }
    }
}

?>