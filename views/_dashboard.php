<div class="container" id="dashboard">
    <div class="div1" data-aos="fade-right" data-aos-duration="1000">
        <div class="profile-card">
            <h3>Welcome to Travel Blog</h3>
            <p><strong><i class="fa fa-user"></i> Name :</strong> <?php echo Utils::sanitize($_SESSION['user_name']); ?></p>
            <p><strong><i class="fa fa-envelope"></i> Email :</strong> <?php echo Utils::sanitize($_SESSION['user_email']); ?></p>
            <p><strong><i class="fa fa-calendar"></i> Member Since :</strong> <?php echo Utils::sanitize($_SESSION['user_created']); ?></p>
            <div class="d-flex justify-content-between align-items-center flex-row">
            <a href="logout" class="btn btn-danger">Logout</a>
            <form method="post" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');" style="margin-top: 10px;">
                <button type="submit" name="deleteUser" value="<?php echo $_SESSION['user_id']; ?>" class="btn btn-danger">Delete My Account</button>
            </form>
            </div>
        </div>
        <?php Utils::displayFlash('delete_success', 'success'); ?>
        <?php Utils::displayFlash('delete_error', 'danger'); ?>
    </div>
    <div class="div2">
    <div class="row align-items-center">
        <div class="col-lg-6 col-sm-12 mb-2 mb-lg-0 d-flex justify-content-lg-start justify-content-center">
            <h3>My Posts</h3>
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
        <?php
        // Fetch all blogs
        // Fetch blogs based on search
        $searchTerm = $_GET['blogSearch'] ?? '';
        if (!empty($searchTerm)) {
            $blogs = Blogs::searchBlogs($searchTerm);
        } else {
            $id = $_SESSION['user_id'];
            $blogs = Blogs::getBlogByUserId($id);
        }

        if (isset($blogs)) {
            // Loop through each blog and display it
            foreach ($blogs as $row) { ?>
            <div class="card" data-aos="fade-left" data-aos-duration="1000">
                <img src="admin1/assets/uploads/<?= $row['blog_image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars(mb_strimwidth($row['content'], 0, 35, "...")) ?></p>
                    <a href="blog-details/<?= ($row['title']); ?>" class="btn read-more-btn">Read More</a>
                </div>
            </div>
            <?php }
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
</div>

