<?php

class Contact {
    public static $db;
    public static $table = 'contacts';
    public function __construct() {
        // Assuming Database::connection() returns a mysqli connection
        self::$db = Database::connection();
    }

    public static function create($name, $email, $mobile, $message) {
        $sql = "INSERT INTO " . self::$table . " (name, email, mobile, message) VALUES (?, ?, ?, ?)";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $mobile, $message);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function read() {
        $sql = "SELECT * FROM " . self::$table;
        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $contacts = array();
        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }

        return $contacts;
    }

    public static function delete($id) {
        $sql = "DELETE FROM " . self::$table . " WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function update($id, $name, $email, $mobile, $message) {
        $sql = "UPDATE " . self::$table . " SET name = ?, email = ?, mobile = ?, message = ? WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param("ssssi", $name, $email, $mobile, $message, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getContactById($id) {
        $sql = "SELECT * FROM " . self::$table . " WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    // Send email logic here
    public static function sendEmail($name, $email, $mobile, $message) {
        $to = "admin@example.com"; // Replace with the recipient's email address
        $subject = "New Contact Message from $name";
        $body = "You have received a new message:\n\n";
        $body .= "Name: $name\n";
        $body .= "Email: $email\n";
        $body .= "Mobile: $mobile\n";
        $body .= "Message:\n$message\n";

        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        if (mail($to, $subject, $body, $headers)) {
            return true;
        } else {
            return false;
        }
    }


}