<?php 
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['name'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE name='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user;

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: ../dashboard/index.php");
        }
    } else {
        $error = "Invalid login!";
    }
}
?>

<form method="POST">
  Username: <input type="text" name="name" required><br>
  Password: <input type="password" name="password" required><br>
  <button type="submit">Login</button>
</form>
