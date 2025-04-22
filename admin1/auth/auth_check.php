
<?php
session_start();
if (!$_SESSION['user_id']['role'] === 'admin') {
    header('Location: auth/login');
    exit();
}
?>
