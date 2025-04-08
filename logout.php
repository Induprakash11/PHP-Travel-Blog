<?php require_once __DIR__ . '/controllers/load.php';
User::logout();
Utils::redirect('login');
?>
