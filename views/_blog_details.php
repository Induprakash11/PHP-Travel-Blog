<?php require_once __DIR__ . '/../controllers/load.php';

if (empty($_GET['title'])) {
    die("title name not provided");
} else {
    $title = $_GET['title'];    
}

$blog_image = 'assets/images/blog/' . $title . '.jpg';

// Fetch blog details by title
$blog = Blogs::getBlogByTitle($title);
if ($blog) {
    $content = $blog['content']; // Assuming 'content' is a key in the blog data
} else {
    die("Blog not found");
}
?>
<div class="container my-5">
    <!-- Heading -->
    <h1 class="text-center display-4 fw-bold text-danger mb-4"><?= htmlspecialchars($title) ?></h1>

    <!-- Image -->
    <div class="text-center mb-4">
        <img src="<?= $blog_image ?>" 
             alt="<?= htmlspecialchars($title) ?>" 
             class="img-fluid rounded shadow category-image">
    </div>

    <!-- Content -->
    <div class="blog-content">
        <p class="fs-5 lh-lg text-muted"><?= nl2br(htmlspecialchars($content)) ?></p>
    </div>
</div>
