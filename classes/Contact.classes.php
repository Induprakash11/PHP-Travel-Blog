<?php require_once __DIR__ . '/../controllers/load.php';

class Contact extends Database {

    public static function createContact($id, $name, $email, $mobile, $message) {
        $sql = "INSERT INTO contacts (user_id,name, email, mobile, message) VALUES (?, ?, ?, ?, ?)";
        $stmt = self::query($sql, [$id, $name, $email, $mobile, $message]);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function readAll() {
        $sql = "SELECT * FROM contacts ORDER BY created_at DESC";
        $stmt = self::query($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $contacts = array();
        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }

        return $contacts;
    }

    public static function deleteContactById($id) {
        $sql = "DELETE FROM contacts WHERE id = ?";
        $stmt = self::query($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function updatecontact($id, $name, $email, $mobile, $message) {
        $sql = "UPDATE contacts SET name = ?, email = ?, mobile = ?, message = ? WHERE id = ?";
        $stmt = self::query($sql);
        $stmt->bind_param("ssssi", $name, $email, $mobile, $message, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getContactById($id) {
        $sql = "SELECT * FROM contacts WHERE id = ?";
        $stmt = self::query($sql);
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