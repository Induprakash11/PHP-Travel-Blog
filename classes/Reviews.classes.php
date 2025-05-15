<?php
require_once __DIR__ . '/../controllers/load.php';

class Reviews
{
    public static function checkDB()
    {
        $db = Database::checkconnection();
        if ($db->connect_error) {
            throw new Exception("Connection failed: " . $db->connect_error);
        }
        return $db;
    }

    // Add a new review
    public static function addReview($blog_id, $reviewer_id, $review_text)
    {
        $conn = self::checkDB();
        $sql = "INSERT INTO reviews (blog_id, reviewer_id, review_text, review_date) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed in addReview: " . $conn->error);
            return false;
        }
        $stmt->bind_param("iis", $blog_id, $reviewer_id, $review_text);
        return $stmt->execute();
    }

    // Update reply for a review
    public static function updateReply($review_id, $reply_text, $replied_by)
    {
        $conn = self::checkDB();
        $sql = "UPDATE reviews SET reply_text = ?, reply_date = NOW(), replied_by = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed in updateReply: " . $conn->error);
            return false;
        }
        $stmt->bind_param("sii", $reply_text, $replied_by, $review_id);
        return $stmt->execute();
    }

    // Get all reviews for a blog including replies
    public static function getReviewsByBlogId($blog_id)
    {
        $conn = self::checkDB();
        $sql = "SELECT r.*, u.name AS user_name, ru.name AS replier_name FROM reviews r 
                JOIN users u ON r.reviewer_id = u.id 
                LEFT JOIN users ru ON r.replied_by = ru.id 
                WHERE r.blog_id = ? ORDER BY r.review_date DESC";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed in getReviewsByBlogId: " . $conn->error);
            return [];
        }
        $stmt->bind_param("i", $blog_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
