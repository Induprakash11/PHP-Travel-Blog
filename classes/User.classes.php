<?php require_once __DIR__ . '/../controllers/load.php';

class User extends Database {
    
    // method to register a new user
    public static function register($name, $email, $password, $role = 'user') {
        // check if the email is already registered
        if (self::isEmailRegistered($email)) {
            return false; // email already exists
        }
        // hash the password before storing it
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        return self::query($sql, [$name, $email, $passwordHash, $role]);
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

    
    // // method to get user Details from session
    // public static function getUserSession() {
    //     return [
    //         'id' => $_SESSION['id'],
    //         'name' => $_SESSION['name'],
    //         'email' => $_SESSION['email'],
    //         'created_at' => $_SESSION['created_at']
    //     ];
    // }

    // method to get user details
    public static function getUserDetails($userId) {
        return self::fetchOne("SELECT id, name, email FROM users WHERE id = ?", [$userId]);
    }

    // method to get user id
    public static function getUserId($userName) {
        $user = self::fetchOne("SELECT id FROM users WHERE name = ?", [$userName]);
        return $user ? $user['id'] : null;
    }

    // method to add user
    public static function addUser($name, $email, $password, $role) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        return self::query($sql, [$name, $email, $passwordHash, $role]);
    }

    // method to update user details
    public static function editUser($userId, $username, $email, $password, $role) {
        // hash the password before storing it
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET name = ?, email = ?, password = ?, role = ? WHERE id = ?";
        return self::query($sql, [$username, $email, $passwordHash, $role, $userId]);
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
        if (!Session::has('user_id')) {
            header("Location: /Travel Blog/login");
            exit();
        }
        return true; // user is authenticated
    }

    public static function isNotAuthenticated() {
        if (isset($_SESSION['user_id'])) {
            header("Location: home");
            exit();
        }
        return true; // user is not authenticated
    }

    public static function onlyAdmin() {
        if (Session::get('user_role') !== 'admin') {
            header("Location: /Travel Blog/home");
            exit();
        }
    }

    // method to logout the user
    public static function logout() {
        session::destroy();
        unset($_SESSION['user_id']);

    }

    // method to get all users
    public static function getAllUsers() {
        return self::fetchAll("SELECT * FROM users");
    }

    public static function searchUsers($searchTerm)
    {
        $db = self::connection();
        $searchTerm = "%{$searchTerm}%";
        $sql = "SELECT * 
                FROM users 
                WHERE name LIKE ? OR email LIKE ? OR id LIKE ?
                ORDER BY created_at DESC";
        $stmt = $db->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed: " . $db->error);
            return [];
        }
        $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // method to get user by email
    public static function getUserByEmail($email) {
        return self::fetchOne("SELECT id, name, email, role, created_at FROM users WHERE email = ?", [$email]);
    }

    // New helper method to set user session variables consistently
    public static function setUserSession($user) {
        if (!$user) {
            return;
        }
        Session::set('user_id', $user['id']);
        Session::set('user_name', $user['name']);
        Session::set('user_email', $user['email']);
        Session::set('user_role', $user['role'] ?? 'user');
        Session::set('user_created', $user['created_at'] ?? date('Y-m-d H:i:s'));
    }
}

?>
