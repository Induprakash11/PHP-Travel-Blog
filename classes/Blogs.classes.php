<?php require_once __DIR__ . '/../controllers/load.php';

class Blogs
{
    public static $bid;
    public static $title;
    public static $content;
    public static $blog_image;

    public static function checkDB()
    {
        $db = Database::checkconnection();
        if ($db->connect_error) {
            throw new Exception("Connection failed: " . $db->connect_error);
        }
        return $db;
    }

    //method to addBlog
    public static function addBlog($title, $content, $user, $user_id, $status, $image) {
        $conn = self::checkDB();

        // Define the upload directory
        $uploadDir = __DIR__ . '/../admin1/assets/uploads/';
        $imagePath = $uploadDir . basename($image['name']);

        // Check if the file already exists and delete it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
        } elseif (file_exists($imagePath)) {
            unlink($imagePath); // Delete the existing file
        }

        // Move the uploaded file to the uploads directory
        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            error_log("Failed to upload image.");
            return false;
        }

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO blogs (title, content, user_name, user_id, status, blog_image) VALUES (?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return false;
        }

        $stmt->bind_param("sssiss", $title, $content, $user, $user_id, $status, $image['name']);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }
    }
    
    
    public static function getBlogById($id)
    {
        $sql = "SELECT * FROM blogs WHERE id = ?";
        $stmt = self::checkDB()->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . self::checkDB()->error);
        }

        $stmt->bind_param("i", $id); // "i" for integer
        $stmt->execute();

        $result = $stmt->get_result();
        $blog = $result->fetch_assoc();

        if ($blog) {
            return $blog;
        }

        return null;
    }

    // Fetch blog by user_id
    public static function getBlogByUserId($user_id)
    {
        $sql = "SELECT * FROM blogs WHERE user_id = ?";
        $stmt = self::checkDB()->prepare($sql);
        $stmt->bind_param("i", $user_id); // "i" for integer
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getBlogByTitle($title)
    {
        $sql = "SELECT * FROM blogs WHERE title = ?";
        $stmt = self::checkDB()->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . self::checkDB()->error);
        }

        $stmt->bind_param("s", $title); // "s" for string
        $stmt->execute();

        $result = $stmt->get_result();
        $blog = $result->fetch_assoc();

        if ($blog) {
            return $blog;
        }

        return null;
    }


    public static function updateBlog($id, $data)
    {
        $sql = "UPDATE blogs SET title = ?, content = ?, author = ?, date = ? WHERE id = ?";
        $stmt = self::checkDB()->prepare($sql);
        $stmt->bind_param("ssssi", $data['title'], $data['content'], $data['author'], $data['date'], $id);
        return $stmt->execute();
    }

    public static function deleteBlog($id)
    {
        $sql = "DELETE FROM blogs WHERE id = ?";
        $stmt = self::checkDB()->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function getAllBlogs()
    {
        return Database::fetchAll("SELECT * FROM blogs ORDER BY created_at DESC");
    }
}
