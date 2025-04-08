<div class="container" style="min-height: 600px; display: flex; align-items: center; justify-content: center;">
        <div class="profile-card" style="padding: 60px;">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
            <p><strong><i class="fa fa-envelope"></i> Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            <p><strong><i class="fa fa-since"></i> Member Since:</strong> <?php echo htmlspecialchars($_SESSION['created_at']); ?></p>
            <a href="logout.php">Logout</a>
        </div>
</div>