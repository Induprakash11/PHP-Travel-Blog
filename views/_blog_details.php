<?php

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
<?php 
    return; 
} ?>

<?php
// Extract blog details
$blog_title = $blog['title'];
$content = $blog['content'];
$blog_image = $blog['blog_image'];
$status = $blog['status'];

$currentUserId = Session::get('user_id');
$likeCount = Blogs::getLikesCount($blog['id']);
$userLiked = $currentUserId ? Blogs::checkUserLike($blog['id'], $currentUserId) : false;
?>

<div class="container my-5" style=" margin: auto;">
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
        <h1 class="display-4 fw-bold text-danger mb-4" style="font-size: 2rem; text-transform: uppercase;">
            <?= htmlspecialchars($blog_title) ?>
        </h1>
    </div>

    <!-- Image -->
<div class="row">
    <div class="mt-3 col-lg-6" data-aos="zoom-in-down" data-aos-duration="1500">
        <img src="/Travel Blog/admin1/assets/uploads/<?= $blog_image ?>"
            alt="<?= htmlspecialchars($blog_title) ?>"
            class="img-fluid rounded shadow category-image blog-img">
    <label class="checkbox3" style="position:absolute; bottom: 7px; right: 90px;">
    <input type="checkbox" class="like-checkbox" data-blog-id="<?= $blog['id'] ?>" data-user-id="<?= $currentUserId ?>" <?= $userLiked ? 'checked' : '' ?> />
        <div class="svgContainer">
            <svg viewBox="0 0 16 16" class="bi bi-heart-fill" height="25" width="25" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" fill-rule="evenodd"></path>
            </svg>
        </div>
    </label>
    <span class="like-count" style="position: absolute; bottom: 6px; right: 80px; font-weight: bold; color: #b10c0c;"><?= $likeCount ?></span>
    <h4 style="position: absolute; bottom: 1px;font-size:15px; left: 30px; background: #b10c0c; color:white;" class="p-1 rounded"><?= htmlspecialchars($status) ?></h4>
  </div>
    <!-- Content -->
    <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1500" style="max-width: 400px;">
        <p class="fs-5 lh-lg text-muted" style="font-size: 1.1rem; line-height: 1.8; color: #555;"><?= nl2br(htmlspecialchars($content)) ?></p>
    </div>
    </div>

    <?php
    // Fetch reviews for this blog
    $reviews = Reviews::getReviewsByBlogId($blog['id']);
    $postUserId = $blog['user_id'];
    ?>

    <div class="reviews-section container my-5" style="margin: auto;">
        <h3 class="mb-4">Blog Reviews</h3>

        <?php if ($currentUserId): ?>
        <form id="reviewForm" method="POST" action="/Travel Blog/models/review_submit.php" class="mb-4">
            <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">
            <input type="hidden" name="user_id" value="<?= $currentUserId ?>">
            <textarea name="review_text" class="form-control mb-2" rows="2" placeholder="Write your review here..." required></textarea>
            <button name="submit_review" class="btn btn-red">Submit Review</button>
        </form>
        <?php else: ?>
        <p>Please <a href="/Travel Blog/login.php">login</a> to write a review.</p>
        <?php endif; ?>

        <!-- Display Reviews -->
        <?php foreach ($reviews as $review): ?>
            <h3>Reviews</h3>
            <div class="review mb-3 p-3 border rounded" data-review-id="<?= $review['id'] ?>">
                <img src="/../Travel Blog/assets/images/favicon.png" alt="logo" class="rounded-circle me-2" width="30" height="30">
                <strong><?= htmlspecialchars($review['user_name']) ?></strong> <small class="text-muted d-flex justify-content-end"><?= $review['review_date'] ?></small>
                <p><?= nl2br(htmlspecialchars($review['review_text'])) ?></p>

        <!-- Replies -->
        <?php if (!empty($review['reply_text'])): ?>
            <div class="reply ms-4 p-1 border rounded mb-2">
                <img src="/../Travel Blog/assets/images/favicon.png" alt="logo" class="rounded-circle me-2" width="20" height="20">
                <strong><?= htmlspecialchars($review['replier_name'] ?? 'Admin') ?></strong> <small class="text-muted"><?= $review['reply_date'] ?></small>
                <p><?= nl2br(htmlspecialchars($review['reply_text'])) ?></p>
            </div>
        <?php endif; ?>

                <!-- Reply Form (only visible to post's user) -->
                <?php if ($currentUserId === $postUserId): ?>
                <div class="reply-toggle ms-4 mt-2">
                    <a href="javascript:void(0);" class="text-danger text-decoration-none reply-link" data-review-id="<?= $review['id'] ?>">Reply</a>
                </div>
                <form method="POST" action="/Travel Blog/models/review_submit.php" class="reply-form ms-4 mt-2 d-none" data-review-id="<?= $review['id'] ?>">
                    <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">
                    <input type="hidden" name="user_id" value="<?= $currentUserId ?>">
                    <input type="hidden" name="review_id" value="<?= $review['id'] ?>">
                    <textarea name="reply_text" class="form-control mb-2" rows="2" placeholder="Write a reply..." required></textarea>
                    <button name="submit_reply" class="btn btn-secondary btn-sm">Send</button>
                </form>
                <script>
                    document.querySelectorAll('.reply-link').forEach(link => {
                        link.addEventListener('click', function() {
                            const reviewId = this.getAttribute('data-review-id');
                            const form = document.querySelector(`.reply-form[data-review-id="${reviewId}"]`);
                            form.classList.toggle('d-none');
                        });
                    });
                </script>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Share Component -->
    <div class="share-component text-center mt-4" data-aos="fade-up" data-aos-duration="1500">
        <h5 class="mb-3">Share this blog</h5>
        <button id="shareBtn" class="btn btn-red me-2" type="button"><i class="fa fa-share"></i></button>
        <button id="copyUrlBtn" class="btn btn-outline-secondary" type="button" title="Copy URL to clipboard"><i class="fa fa-copy"></i></button>
        <p id="copyMessage" class="text-success mt-2" style="display:none;">URL copied to clipboard!</p>
    </div>
</div>
