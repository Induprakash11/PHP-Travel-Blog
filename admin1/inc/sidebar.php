<?php
$current_page = basename($_SERVER['REQUEST_URI'], ".php");
?>

<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Admin Panel</h3>
    </div>

    <ul class="list-unstyled components">
        <li class="<?= ($current_page == 'home') ? 'active' : '' ?>">
            <a href="home">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="<?= ($current_page == 'users') ? 'active' : '' ?>">
            <a href="users">
                <i class="fas fa-users"></i>
                <span>User Management</span>
            </a>
        </li>
        <li class="<?= ($current_page == 'blogs') ? 'active' : '' ?>">
            <a href="blogs">
                <i class="fas fa-blog"></i>
                <span>Blog Management</span>
            </a>
        </li>
        <li class="<?= ($current_page == 'settings') ? 'active' : '' ?>">
            <a href="settings">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
        </li>
        <li class="<?= ($current_page == 'logout') ? 'active' : '' ?>">
            <a href="/../Travel Blog/logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</nav>