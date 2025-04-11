<section id="blogs" class="container my-5">
    <h2 class="text-center mb-4">Latest Travel Blogs</h2>

    <div class="row">
        <?php

        // Fetch all blogs
        $blogs = Blogs::getAllBlogs();
        
        if (isset($blogs)) {
            // Loop through each blog and display it
            foreach ($blogs as $row) { ?>
                <div class="col-md-4 p-lg-3">
                    <div class="card">
                        <!-- Display blog image -->
                        <img src="<?= htmlspecialchars($row['blog_image']) ?>"
                            class="card-img-top"
                            alt="<?= htmlspecialchars($row['title']) ?>">
                        <div class="card-body">
                            <!-- Display blog title -->
                            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                            <!-- Display truncated blog content -->
                            <p class="card-text"><?= htmlspecialchars(mb_strimwidth($row['content'], 0, 35, "...")) ?></p>
                            <!-- Link to blog details -->
                            <a href="blog-details/<?= ($row['title']); ?>" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            <?php }
        } else { ?>
            <!-- Display message if no blogs are found -->
            <p class="text-center">No blogs found</p>
        <?php }; ?>
    </div>
</section>