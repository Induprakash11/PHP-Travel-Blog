<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/Travel Blog">
            <img src="/Travel Blog/assets/images/favicon.png" width="30" height="30" class="rounded me-2" alt="Logo" title="TraveLog">
            Travel Blog
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" onclick="toggleIcon(this)">
            <span class="navbar-toggler-ico"><i class="fa fa-bars"></i></span>
            <span class="navbar-toggler-text"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <input type="checkbox" id="switch-mode" hidden>
                    <label for="switch-mode" class="switch-mode"></label>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == '/' ? 'active' : ''; ?>" href="/Travel Blog/">
                        <i class="fa fa-home me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'blog' ? 'active' : ''; ?>" href="/Travel Blog/blog">
                        <i class="fa fa-blog me-1"></i> Blogs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'contact' ? 'active' : ''; ?>" href="/Travel Blog/contact">
                        <i class="fa fa-address-book me-1"></i> Contact
                    </a>
                </li>
                <?php if (Session::has('user_id')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/Travel Blog/dashboard">
                            <i class="fa fa-user me-1"></i> <?= Session::get("user_name") ?>
                        </a>
                    </li>
                    <?php if (Session::get('user_role') === "admin"): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/Travel Blog/admin1/home">
                                <i class="fa fa-cogs me-1"></i> Admin
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'login' ? 'active' : ''; ?>" href="login">
                            <i class="fa fa-user  me-1"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'register' ? 'active' : ''; ?>" href="register">
                            <i class="fa fa-user-plus me-1"></i> Register
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>