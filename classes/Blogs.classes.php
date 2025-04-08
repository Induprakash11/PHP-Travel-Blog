<?php require_once __DIR__ . '/../controllers/load.php';

class Blogs {
    public static $bid;
    public static $title;
    public static $content;
    public static $blog_image;

    public static function checkDB() {
        $db = Database::connection();
        if ($db->connect_error) {
            throw new Exception("Connection failed: " . $db->connect_error);
        }
        return $db;
    }

    public static function addBlog($data) {
        $sql = "INSERT INTO blogs (title, content, author, date) VALUES (?, ?, ?, ?)";
        $stmt = self::checkDB()->prepare($sql);
        $stmt->bind_param("ssss", $data['title'], $data['content'], $data['author'], $data['date']);
        return $stmt->execute();
    }

    public static function getBlogById($id) {
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

    public static function getBlogByTitle($title) {
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
    

    public static function updateBlog($id, $data) {
        $sql = "UPDATE blogs SET title = ?, content = ?, author = ?, date = ? WHERE id = ?";
        $stmt = self::checkDB()->prepare($sql);
        $stmt->bind_param("ssssi", $data['title'], $data['content'], $data['author'], $data['date'], $id);
        return $stmt->execute();
    }

    public static function deleteBlog($id) {
        $sql = "DELETE FROM blogs WHERE id = ?";
        $stmt = self::checkDB()->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function getAllBlogs() {
        return Database::fetchAll("SELECT * FROM blogs");
    }
}

?>