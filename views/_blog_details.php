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

if (!$blog) { ?>
    <!-- Display message if no blogs are found -->
    <div class="text-center my-5" data-aos="fade-up" data-aos-duration="1500">
        <h3 class="text-muted">No Blogs Found</h3>
        <p class="text-muted">It seems there are no blogs available at the moment. Check back later or create a new blog post!</p>
        <button class="btn btn-red mt-3" data-bs-toggle="modal" data-bs-target="#addBlogModal">
            <i class="fa fa-plus fa-sm me-2"></i> Create New Blog
        </button>
    </div>
<?php } ?>

<?php
// Extract blog details
$blog_title = $blog['title'];
$content = $blog['content'];
$blog_image = $blog['blog_image'];
$status = $blog['status'];

$currentUserId = Session::get('user_id') ?? null;
$likeCount = Blogs::getLikesCount($blog['id']);
$userLiked = $currentUserId ? Blogs::checkUserLike($blog['id'], $currentUserId) : false;
?>

<div class="container my-5" style="max-width: 800px; margin: auto;">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" data-aos="fade-left" data-aos-duration="1500">
        <ol class="breadcrumb p-3 rounded d-flex justify-content-" style="background: linear-gradient(to right, var(--red), var(--secondary-color));">
            <li class="breadcrumb-item">
                <a href="/Travel Blog/home">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/Travel Blog/blog">Blogs</a>
            </li>
            <li class="breadcrumb-item <?= str_contains($_SERVER['REQUEST_URI'], '/Travel Blog/blog') ? 'active' : '' ?>" aria-current="page">
                <a style="color: lightgrey;"><?= $blog_title ?> Description</a>
            </li>
        </ol>
    </nav>

    <!-- Heading -->
    <div data-aos="fade-right" data-aos-duration="1500">
        <h1 class="text-center display-4 fw-bold text-danger mb-4" style="font-size: 2.5rem; text-transform: uppercase;">
            <?= htmlspecialchars($blog_title) ?>
        </h1>
    </div>

    <!-- Image -->
    <div class="text-center mt-3" data-aos="zoom-in-down" data-aos-duration="1500">
        <img src="/Travel Blog/admin1/assets/uploads/<?= $blog_image ?>"
            alt="<?= htmlspecialchars($blog_title) ?>"
            class="img-fluid rounded shadow category-image blog-img">
    <label class="checkbox3" style="position:absolute; bottom: 7px; right: 180px;">
    <input type="checkbox" class="like-checkbox" data-blog-id="<?= $blog['id'] ?>" data-user-id="<?= $currentUserId ?>" <?= $userLiked ? 'checked' : '' ?> />
        <div class="svgContainer">
            <svg viewBox="0 0 16 16" class="bi bi-heart-fill" height="25" width="25" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" fill-rule="evenodd"></path>
            </svg>
        </div>
    </label>
    <span class="like-count" style="position: absolute; bottom: 8px; right: 165px; font-weight: bold; color: #b10c0c;"><?= $likeCount ?></span>
    <h4 style="position: absolute; bottom: 1px;font-size:15px; left: 150px; background: #b10c0c; color:white;" class="p-1 rounded"><?= htmlspecialchars($status) ?></h4>
  </div>
    <!-- Content -->
    <div class="blog-content" data-aos="fade-up" data-aos-duration="1500">
        <p class="fs-5 lh-lg text-muted" style="font-size: 1.1rem; line-height: 1.8; color: #555;"><?= nl2br(htmlspecialchars($content)) ?></p>
    </div>
</div>