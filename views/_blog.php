<section id="blogs" class="container my-5" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" data-aos="fade-left" data-aos-duration="1500">
        <ol class="breadcrumb p-3 rounded d-flex justify-content-" style="background: linear-gradient(to right, var(--red), var(--secondary-color));">
            <li class="breadcrumb-item">
                <a href="/Travel Blog/home">Home</a>
            </li>
            <li class="breadcrumb-item <?= str_contains($_SERVER['REQUEST_URI'], '/Travel Blog/blog') ? 'active' : '' ?>" aria-current="page">
                <a href="/Travel Blog/blog">Blogs</a>
            </li>
        </ol>
    </nav>

    <h2 class="text-center mb-4">Latest Travel Blogs</h2>
    <p class="text-center mb-4">Explore our latest travel blogs and get inspired for your next adventure!</p>

    <div class="displayflash" data-aos="zoom-out">
        <?php Utils::displayFlash('Blog added', 'success'); ?>
        <?php Utils::displayFlash('File size error', 'danger'); ?>
        <?php Utils::displayFlash('File type error', 'danger'); ?>
        <?php Utils::displayFlash('Fill all fields', 'danger'); ?>
        <?php Utils::displayFlash('Upload error', 'danger'); ?>
        <?php Utils::displayFlash('Blog updated', 'success'); ?>
        <?php Utils::displayFlash('Blog deleted', 'success'); ?>
        <?php Utils::displayFlash('Blog not found', 'danger'); ?>
        <?php Utils::displayFlash('Upload error', 'danger'); ?>
    </div>

    <div class="row align-items-center">
        <div class="col-lg-6 col-sm-12 mb-2 mb-lg-0 d-flex justify-content-lg-start justify-content-center">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                <i class="fa fa-plus fa-sm me-2"></i> New Post
            </button>
        </div>
        <div class="col-lg-6 col-sm-12 d-flex justify-content-lg-end justify-content-center">
            <form method="get" class="w-100" style="max-width: 400px;">
                <div class="input-group">
                    <input type="text" class="form-control border-danger" name="blogSearch" placeholder="Search blogs..." value="<?= htmlspecialchars($_GET['blogSearch'] ?? '') ?>">
                    <button class="btn btn-outline-danger" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <?php
        $currentUserId = $_SESSION['user_id'] ?? null;

        // Fetch blogs based on search
        $searchTerm = $_GET['blogSearch'] ?? '';
        if (!empty($searchTerm)) {
            $blogs = Blogs::searchBlogs($searchTerm);
        } else {
            $blogs = Blogs::getAllBlogs();
        }

        // fetch users
        $users = User::getAllUsers();

        if (!empty($blogs)) {
            // Loop through each blog and display it
            foreach ($blogs as $row) {
                if ($row['status'] === "published") {
                    $likeCount = Blogs::getLikesCount($row['id']);
                    $userLiked = $currentUserId ? Blogs::checkUserLike($row['id'], $currentUserId) : false;
        ?>
                    <div class="col-md-4 mt-5 p-4">
                        <div class="card" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="<?= 1000 + ($loopIndex * 200) ?>">
                            <!-- Display blog image -->
                            <img src="admin1/assets/uploads/<?= $row['blog_image'] ?>"
                                class="card-img-top"
                                alt="<?= htmlspecialchars($row['title']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars(mb_strimwidth($row['content'], 0, 35, "...")) ?></p>
                                <a href="blog-details/<?= ($row['title']); ?>" class="btn btn-danger text-light">Read More</a>
                                <label class="checkbox3" style="position: absolute; top: 290px; right: 40px;">
                                <input type="checkbox" class="like-checkbox" data-blog-id="<?= $row['id'] ?>" data-user-id="<?= $currentUserId ?>" <?= $userLiked ? 'checked' : '' ?> />
                                <div class="svgContainer">
                                        <svg viewBox="0 0 16 16" class="bi bi-heart-fill" height="25" width="25" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" fill-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </label>
                                <span class="like-count" style="position: absolute; top: 292px; right: 25px; font-weight: bold; color: #b10c0c;"><?= $likeCount ?></span>
                                <button id="shareBtn" class="btn btn-primary me-2" type="button"><i class="fa fa-share"></i></button>
                            </div>
                        </div>
                    </div>
        <?php
                }
            }
        } else { ?>
            <!-- Display message if no blogs are found -->
            <div class="text-center my-5" data-aos="fade-up" data-aos-duration="1500">
                <h3 class="text-muted">No Blogs Found</h3>
                <p class="text-muted">It seems there are no blogs available at the moment. Check back later or create a new blog post!</p>
                <button class="btn btn-red mt-3" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                    <i class="fa fa-plus fa-sm me-2"></i> Create New Blog
                </button>
            </div>
        <?php }; ?>
    </div>

</section>

<!-- Add Blog Post Modal -->
<div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="addBlogModalLabel">Create New Blog</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="postTitle" class="form-label fw-semibold">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter blog title" required>
                    </div>
                    <div class="mb-4">
                        <label for="postContent" class="form-label fw-semibold">Content</label>
                        <textarea class="form-control" name="content" rows="6" placeholder="Write your blog content here..." required></textarea>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="postUser" class="form-label fw-semibold">User</label>
                            <select class="form-select" name="userId" required>
                                <option value="">Select User</option>
                                <?php if (!empty($users)) {
                                    foreach ($users as $user) { ?>
                                        <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="postStatus" class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="">Select Status</option>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="featuredImage" class="form-label fw-semibold">Upload Image</label>
                        <input class="form-control" type="file" name="file" required>
                    </div>
                    <div class="d-flex justify-content-end gap-3">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="addBlog" class="btn btn-danger">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

