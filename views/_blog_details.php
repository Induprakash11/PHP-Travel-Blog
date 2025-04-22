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
$content = $blog['content'];
$blog_image = $blog['blog_image'];
$status = $blog['status'];
?>

<div class="container my-5" style="max-width: 800px; margin: auto;">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" class="">
        <ol class="breadcrumb p-3 rounded d-flex justify-content-" style="background-color:#eeeef0;">
            <li class="breadcrumb-item">
                <a href="/Travel Blog/home" style="text-decoration: none;">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/Travel Blog/blog" style="text-decoration: none;">Blogs</a>
            </li>
            <li class="breadcrumb-item <?= str_contains($_SERVER['REQUEST_URI'], '/Travel Blog/blog') ? 'active' : '' ?>" aria-current="page">
                <a>Blog Details</a>
            </li>
        </ol>
    </nav>
    
    <!-- Heading -->
    <h1 class="text-center display-4 fw-bold text-danger mb-4" style="font-size: 2.5rem; text-transform: uppercase;">
        <?= htmlspecialchars($blog_title) ?>
    </h1>

    <!-- Image -->
    <div class="text-center mb-4">
        <img src="/Travel Blog/admin1/assets/uploads/<?= $blog_image ?>" 
             alt="<?= htmlspecialchars($blog_title) ?>" 
             class="img-fluid rounded shadow category-image" 
             style="max-width: 100%; height: auto; border: 2px solid #ddd; padding: 5px;">
        <h4 style="margin-top: 10px; color: #6c757d;"><?= htmlspecialchars($status) ?></h4>
    </div>

    <!-- Content -->
    <div class="blog-content" style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <p class="fs-5 lh-lg text-muted" style="font-size: 1.1rem; line-height: 1.8; color: #555;"><?= nl2br(htmlspecialchars($content)) ?></p>
    </div>
</div>
