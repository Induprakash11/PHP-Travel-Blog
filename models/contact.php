<?php require_once __DIR__ . '/../controllers/load.php';

$contact = new Contact();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = Utils::sanitize($_POST['name']);
    $email = Utils::sanitize($_POST['email']);
    $subject = Utils::sanitize($_POST['mobile']);
    $message = Utils::sanitize($_POST['message']);

// create a new contact instance
$contact = Contact::create($name, $email, $subject, $message);
if ($contact) {
    echo "<script>alert('Contact created successfully!');</script>";
} else {
    echo "<script>alert('Failed to create contact.');</script>";
}

}

?>