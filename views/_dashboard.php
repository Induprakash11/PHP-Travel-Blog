<div class="dashboard" style="display: flex;">
    <div class="div1" style="position: fixed; width: 40%; height: 50%; padding: 20px;" data-aos="fade-right" data-aos-duration="1000">
        <div class="profile-card" style="min-height: 300px; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border: 2px solid #90caf9;">
            <h3 style="color:#fd5d5d;">Welcome to Travel Blog</h3>
            <p><strong><i class="fa fa-user" style="color: #DB504A;"></i> Name :</strong> <?php echo Utils::sanitize($_SESSION['user_name']); ?></p>
            <p><strong><i class="fa fa-envelope" style="color: #DB504A;"></i> Email :</strong> <?php echo Utils::sanitize($_SESSION['user_email']); ?></p>
            <p><strong><i class="fa fa-calendar" style="color: #DB504A;"></i> Member Since :</strong> <?php echo Utils::sanitize($_SESSION['user_created']); ?></p>
            <a href="logout" style="color: #ffffff; background:var(--red); padding: 10px 15px; border-radius: 5px; text-decoration: none;">Logout</a>
        </div>
    </div>
    <div class="div2" style="margin-left: 50%; overflow:auto ;width: 30%; padding: 20px;" data-aos="fade-left" data-aos-dura    tion="1000">
        <h3 style="color:var(--red);">My Travel Blogs</h3>
        <?php
        // Fetch all blogs
        $id = $_SESSION['user_id'];
        $blogs = Blogs::getBlogByUserId($id);

        if (isset($blogs)) {
            // Loop through each blog and display it
            foreach ($blogs as $row) { ?>
            <div class="card" style="margin-bottom: 20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <img src="admin1/assets/uploads/<?= $row['blog_image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']) ?>" style="border-top-left-radius: 10px; border-top-right-radius: 10px; max-height: 200px; object-fit: cover;">
                <div class="card-body" style="padding: 15px;">
                    <h5 class="card-title" style="color: #DB504A;"><?= htmlspecialchars($row['title']) ?></h5>
                    <p class="card-text" style="color: #555;"><?= htmlspecialchars(mb_strimwidth($row['content'], 0, 35, "...")) ?></p>
                    <a href="blog-details/<?= ($row['title']); ?>" class="btn btn-primary" style="background-color: #DB504A; border: none;">Read More</a>
                </div>
            </div>
            <?php }
        } else { ?>
            <p class="text-center" style="color: #555;">No blogs found</p>
        <?php }; ?>
    </div>
</div>
