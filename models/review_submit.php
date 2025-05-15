<?php
require_once __DIR__ . '/../controllers/load.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle review submission
    if (isset($_POST['submit_review'])) {
        $blog_id = isset($_POST['blog_id']) ? intval($_POST['blog_id']) : 0;
        $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
        $review_text = isset($_POST['review_text']) ? trim($_POST['review_text']) : '';

        if ($blog_id <= 0 || $user_id <= 0 || empty($review_text)) {
            $_SESSION['error'] = "Invalid input data.";
            Utils::redirect("/Travel Blog/blog-details.php?title=" . urlencode($_POST['title'] ?? ''));
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] !== $user_id) {
            $_SESSION['error'] = "Unauthorized action.";
            Utils::redirect("/Travel Blog/blog-details.php?title=" . urlencode($_POST['title'] ?? ''));
        }

        $success = Reviews::addReview($blog_id, $user_id, $review_text);

        if ($success) {
            $_SESSION['success'] = "Review submitted successfully.";
        } else {
            $_SESSION['error'] = "Failed to submit review.";
        }

        $blog = Blogs::getBlogById($blog_id);
        $title = $blog ? $blog['title'] : '';
        Utils::redirect("/Travel Blog/blog-details.php?title=" . urlencode($title));
    }

    // Handle reply submission
    if (isset($_POST['submit_reply'])) {
        $blog_id = isset($_POST['blog_id']) ? intval($_POST['blog_id']) : 0;
        $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
        $review_id = isset($_POST['review_id']) ? intval($_POST['review_id']) : 0;
        $reply_text = isset($_POST['reply_text']) ? trim($_POST['reply_text']) : '';

        if ($blog_id <= 0 || $user_id <= 0 || $review_id <= 0 || empty($reply_text)) {
            $_SESSION['error'] = "Invalid input data.";
            Utils::redirect("/Travel Blog/blog-details.php?title=" . urlencode($_POST['title'] ?? ''));
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] !== $user_id) {
            $_SESSION['error'] = "Unauthorized action.";
            Utils::redirect("/Travel Blog/blog-details.php?title=" . urlencode($_POST['title'] ?? ''));
        }

        $blog = Blogs::getBlogById($blog_id);
        if (!$blog || $blog['user_id'] !== $user_id) {
            $_SESSION['error'] = "Only the post's user can reply to reviews.";
            Utils::redirect("/Travel Blog/blog-details.php?title=" . urlencode($_POST['title'] ?? ''));
        }

        $success = Reviews::updateReply($review_id, $reply_text, $user_id);

        if ($success) {
            $_SESSION['success'] = "Reply submitted successfully.";
        } else {
            $_SESSION['error'] = "Failed to submit reply.";
        }

        $title = $blog ? $blog['title'] : '';
        Utils::redirect("/Travel Blog/blog-details.php?title=" . urlencode($title));
    }

    // If neither submit_review nor submit_reply is set
    Utils::redirect("/Travel Blog/home");
} else {
    Utils::redirect("/Travel Blog/home");
}
?>