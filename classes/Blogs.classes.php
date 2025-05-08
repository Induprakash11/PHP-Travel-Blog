<?php require_once __DIR__ . '/../controllers/load.php';

/*
This `Blogs` class provides a set of static methods to manage blog-related operations, 
such as adding, editing, deleting, and retrieving blog posts. It interacts with a database 
and handles file uploads for blog images.

Properties:
- `$bid`, `$title`, `$content`, `$blog_image`: Static properties (not used in the current implementation).

Methods:
1. `checkDB()`: 
   - Ensures a database connection is established using the `Database::checkconnection()` method.
   - Throws an exception if the connection fails.

2. `addBlog($title, $content, $user, $user_id, $status, $image)`:
   - Adds a new blog post to the database.
   - Handles image upload by saving the file to a specific directory.
   - Prepares and executes an SQL `INSERT` statement to store blog details.

3. `uploadImage($image)`:
   - Handles the upload of an image file.
   - Saves the file to a specific directory and returns the file name.

4. `getBlogById($id)`:
   - Retrieves a single blog post by its ID.
   - Executes an SQL `SELECT` query and returns the blog details as an associative array.

5. `getBlogByUserId($user_id)`:
   - Retrieves all blog posts created by a specific user.
   - Executes an SQL `SELECT` query and returns the results as an array of associative arrays.

6. `getBlogByTitle($title)`:
   - Retrieves a single blog post by its title.
   - Executes an SQL `SELECT` query and returns the blog details as an associative array.

7. `editBlog($blog_id, $title, $content, $user, $status, $image)`:
   - Updates an existing blog post in the database.
   - Handles image upload by saving the file to a specific directory.
   - Prepares and executes an SQL `UPDATE` statement to modify blog details.

8. `deleteBlog($id)`:
   - Deletes a blog post from the database by its ID.
   - Executes an SQL `DELETE` query.

9. `getAllBlogs()`:
   - Retrieves all blog posts along with the associated user details.
   - Executes an SQL `SELECT` query with a `JOIN` to fetch user names and orders the results by creation date.

Key Notes:
- The class uses prepared statements to prevent SQL injection.
- Image uploads are handled by saving files to a specific directory and ensuring no duplicate files exist.
- Error handling is implemented using `error_log()` for logging and `die()` for critical failures.
*/

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
    public static function addBlog($title, $content, $userId, $status, $image)
    {
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
        $stmt = $conn->prepare("INSERT INTO blogs (title, content, user_id, status, blog_image) VALUES (?, ?, ?, ?, ?)");

        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return false;
        }

        $stmt->bind_param("sssiss", $title, $content, $userId, $status, $image['name']);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }
    }

    //method to addblog in main site
    public static function addBlogMain($title, $content, $userId, $status, $image)
    {
        $conn = self::checkDB();

        // Define the upload directory
        $uploadDir = __DIR__ . '/../assets/uploads/';
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
        $stmt = $conn->prepare("INSERT INTO blogs (title, content, user_id, status, blog_image) VALUES (?, ?, ?, ?, ?)");

        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return false;
        }

        $stmt->bind_param("sssiss", $title, $content, $userId, $status, $image['name']);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }
    }

    //method to uploadfile($files)
    public static function uploadImage($image)
    {
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

        return $image['name'];
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

    //method to editBlog using uploadImage method
    public static function editBlog($blog_id, $title, $content, $userId, $status, $image = null)
    {
        $conn = self::checkDB();

        // Define the upload directory
        $uploadDir = __DIR__ . '/../admin1/assets/uploads/';

        $imageName = null;

        if ($image && isset($image['tmp_name']) && is_uploaded_file($image['tmp_name'])) {
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
            $imageName = $image['name'];
        }

        if ($imageName) {
            // Prepare the SQL statement with image update
            $stmt = $conn->prepare("UPDATE blogs SET user_id = ?, title = ?, content = ?, status = ?, blog_image = ? WHERE id = ?");
            if (!$stmt) {
                error_log("Prepare failed: " . $conn->error);
                return false;
            }
            $stmt->bind_param("issssi", $userId, $title, $content, $status, $imageName, $blog_id);
        } else {
            // Prepare the SQL statement without image update
            $stmt = $conn->prepare("UPDATE blogs SET user_id = ?, title = ?, content = ?, status = ? WHERE id = ?");
            if (!$stmt) {
                error_log("Prepare failed: " . $conn->error);
                return false;
            }
            $stmt->bind_param("isssi", $userId, $title, $content, $status, $blog_id);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }
    }


    // Delete all blogs by user_id and then delete associated images
    public static function deleteBlogsByUserId($user_id)
    {
        // Get all blogs by user_id to get image filenames
        $blogs = self::getBlogByUserId($user_id);

        // Delete blog records from database
        $sql = "DELETE FROM blogs WHERE user_id = ?";
        $stmt = self::checkDB()->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $result = $stmt->execute();

        // Delete associated image files after deleting records
        if (is_array($blogs) && !empty($blogs)) {
            $uploadDir = __DIR__ . '/../admin1/assets/uploads/';
            foreach ($blogs as $blog) {
                $imagePath = $uploadDir . $blog['blog_image'];
                if (file_exists($imagePath) && is_file($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        return $result;
    }


    // Fetch all blogs details
    public static function getAllBlogs()
    {
        return Database::fetchAll("SELECT blogs.*, users.name AS user_name 
        FROM blogs 
        JOIN users ON blogs.user_id = users.id
        ORDER BY blogs.created_at DESC");
    }

    // Search blogs by title or content
    public static function searchBlogs($searchTerm)
    {
        $db = self::checkDB();
        $searchTerm = "%{$searchTerm}%";
        $sql = "SELECT blogs.*, users.name AS user_name 
                FROM blogs 
                JOIN users ON blogs.user_id = users.id
                WHERE blogs.title LIKE ? OR users.name LIKE ?
                ORDER BY blogs.created_at DESC";
        $stmt = $db->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed: " . $db->error);
            return [];
        }
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Add a like for a blog by a user
    public static function addLike($blog_id, $user_id)
    {
        $conn = self::checkDB();
        $sql = "INSERT INTO likes (blog_id, user_id, liked) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE liked = 1, created_at = CURRENT_TIMESTAMP";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed in addLike: " . $conn->error);
            return false;
        }
        $stmt->bind_param("ii", $blog_id, $user_id);
        return $stmt->execute();
    }

    // Remove a like (dislike) for a blog by a user
    public static function removeLike($blog_id, $user_id)
    {
        $conn = self::checkDB();
        $sql = "UPDATE likes SET liked = 0 WHERE blog_id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed in removeLike: " . $conn->error);
            return false;
        }
        $stmt->bind_param("ii", $blog_id, $user_id);
        return $stmt->execute();
    }

    // Get total number of likes for a blog
    public static function getLikesCount($blog_id)
    {
        $conn = self::checkDB();
        $sql = "SELECT COUNT(*) as total_likes FROM likes WHERE blog_id = ? AND liked = 1";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed in getLikesCount: " . $conn->error);
            return 0;
        }
        $stmt->bind_param("i", $blog_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? (int)$row['total_likes'] : 0;
    }

    // Check if a user has liked a blog
    public static function checkUserLike($blog_id, $user_id)
    {
        $conn = self::checkDB();
        $sql = "SELECT liked FROM likes WHERE blog_id = ? AND user_id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed in checkUserLike: " . $conn->error);
            return false;
        }
        $stmt->bind_param("ii", $blog_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row && $row['liked'] == 1;
    }

    //method to check total likes in all blogs
    public static function getTotalLikesCount()
    {
        $conn = self::checkDB();
        $sql = "SELECT COUNT(*) as total_likes FROM likes WHERE liked = 1";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed in getTotalLikesCount: " . $conn->error);
            return 0;
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? (int)$row['total_likes'] : 0;
    }
}
