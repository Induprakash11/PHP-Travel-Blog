<?php require_once __DIR__ . '/../controllers/load.php';

// Validate and sanitize 'title' from URL
if (empty($_GET['title'])) {
    die("Blog title not provided");
} else {
    $title = urldecode($_GET['title']);
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
}

// Fetch blog details by title
$blog = Blogs::getBlogByTitle($title);

if (!$blog) {
    die("Blog not found");
}

// Extract blog details
$blog_title = $blog['title'];
$blog_image = $blog['blog_image'];
$content = $blog['content'];

?>

<div class="container my-5">
    <!-- Heading -->
    <h1 class="text-center display-4 fw-bold text-danger mb-4">
        <?= htmlspecialchars($blog_title) ?>
    </h1>

    <!-- Image -->
    <div class="text-center mb-4">
        <img src="<?= htmlspecialchars($blog_image) ?>" 
             alt="<?= htmlspecialchars($blog_title) ?>" 
             class="img-fluid rounded shadow category-image">
    </div>

    <!-- Content -->
    <div class="blog-content">
        <p class="fs-5 lh-lg text-muted"><?= nl2br(htmlspecialchars($content)) ?></p>
    </div>
</div>
