<?php require_once __DIR__ . '/../controllers/load.php';

class User extends Database {
    
    // method to register a new user
    public static function register($name, $email, $password) {
        // check if the email is already registered
        if (self::isEmailRegistered($email)) {
            return false; // email already exists
        }
        // hash the password before storing it
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        return self::query($sql, [$name, $email, $passwordHash]);
    }

    // method to check empty fields
    public static function checkEmptyFields($fields) {
        foreach ($fields as $field) {
            if (empty($field)) {
                return $field . "is Required"; // return the first empty field found
            }
        }
        return false; // no empty fields found
    }

    // method to check if the password is strong
    public static function isStrongPassword($password) {
        if (strlen($password) < 8) {
            return false; // password is too short
        }
        if (!preg_match('/[A-Z]/', $password)) {
            return false; // password does not contain an uppercase letter
        }
        if (!preg_match('/[a-z]/', $password)) {
            return false; // password does not contain a lowercase letter
        }
        if (!preg_match('/[0-9]/', $password)) {
            return false; // password does not contain a number
        }
        return true; // password is strong
    }

    // method to login the user
    public static function login($email, $password) {
        $user = self::fetchOne("SELECT id, password FROM users WHERE email = ?", [$email]);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
        return false;
    }

    // method to set user session
    public static function setUserSession($id, $name, $email) {
        session_regenerate_id(true);
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['created_at'] = date("Y-m-d H:i:s");
    }

    
    // method to get user Details from session
    public static function getUserSession() {
        return [
            'id' => $_SESSION['id'],
            'name' => $_SESSION['name'],
            'email' => $_SESSION['email'],
            'created_at' => $_SESSION['created_at']
        ];
    }

    // method to get user details
    public static function getUserDetails($userId) {
        return self::fetchOne("SELECT id, name, email FROM users WHERE id = ?", [$userId]);
    }

    // method to update user details
    public static function updateUser($userId, $name, $email) {
        $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        return self::query($sql, [$name, $email, $userId]);
    }

    // method to delete user account
    public static function deleteUser($userId) {
        $sql = "DELETE FROM users WHERE id = ?";
        return self::query($sql, [$userId]);
    }

    // method to check if the email is already registered
    public static function isEmailRegistered($email) {
        $user = self::fetchOne("SELECT id FROM users WHERE email = ?", [$email]);
        return !empty($user);
    }

    // method to check if the user is logged in
    public static function isAuthenticated() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login.php");
            exit();
        }
        return true; // user is authenticated
    }

    // method to logout the user
    public static function logout() {
        session::destroy();
        unset($_SESSION['user_id']);
    }
}

?>
