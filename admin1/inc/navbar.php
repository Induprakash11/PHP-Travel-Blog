<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <button class="btn btn-outline-primary" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <div class="ms-auto d-flex align-items-center">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <h6 class="dropdown-header">Notifications</h6>
                    </li>
                    <li><a class="dropdown-item" href="javascript:void(0)">New user registered</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)">New blog post published</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)">System update completed</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="javascript:void(0)">Show All Notifications</a></li>
                </ul>
            </div>

            <div class="dropdown ms-3">
                <a class="navbar-user d-flex align-items-center" href="javascript:void(0)" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../admin/assets/images/people.png" alt="User" class="img-profile rounded-circle">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="javascript:void(0)"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i> Settings</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i> Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="/../Travel Blog/logout"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>