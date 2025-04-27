<section id="blogs" class="container my-5" data-aos="fade-up" data-aos-ancher-placement="top-bottom">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" data-aos="fade-left" data-aos-duration="1500">
        <ol class="breadcrumb p-3 rounded d-flex justify-content-" style="background: linear-gradient(to right, var(--red), var(--secondary-color));">
            <li class="breadcrumb-item">
                <a href="/Travel Blog/home" style="text-decoration: none; color:var(--secondary-color)">Home</a>
            </li>
            <li class="breadcrumb-item <?= str_contains($_SERVER['REQUEST_URI'], '/Travel Blog/blog') ? 'active' : '' ?>" aria-current="page">
                <a href="/Travel Blog/blog" style="text-decoration: none; color:var(--secondary-color);">Blogs</a>
            </li>
        </ol>
    </nav>

    <h2 class="text-center mb-4">Latest Travel Blogs</h2>
    <p class="text-center mb-4">Explore our latest travel blogs and get inspired for your next adventure!</p>


    <div class="row">
        <?php

        // Fetch all blogs
        $blogs = Blogs::getAllBlogs();

        if (isset($blogs)) {
            // Loop through each blog and display it
            foreach ($blogs as $row) {
                if ($row['status'] === "published") { ?>
                <div class="col-md-4 p-lg-3">
                    <div class="card" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="<?= 1000 + ($loopIndex * 200) ?>">
                        <!-- Display blog image -->
                        <img src="admin1/assets/uploads/<?= $row['blog_image'] ?>"
                            class="card-img-top"
                            alt="<?= htmlspecialchars($row['title']) ?>">
                        <div class="card-body">
                            <!-- Display blog title -->
                            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                            <!-- Display truncated blog content -->
                            <p class="card-text"><?= htmlspecialchars(mb_strimwidth($row['content'], 0, 35, "...")) ?></p>
                            <!-- Link to blog details -->
                            <a href="blog-details/<?= ($row['title']); ?>" class="btn btn-danger">Read More</a>
                        </div>
                    </div>
                </div>
            <?php } }
        } else { ?>
            <!-- Display message if no blogs are found -->
            <p class="text-center">No blogs found</p>
        <?php }; ?>
    </div>
</section>