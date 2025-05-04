<?php include_once __DIR__ . '/../model/dashboard.php';
?>
<div class="dashboard-section">
    <div class="row">
    <div data-aos="fade-left" data-aos-duration="1000" class="dashboard-header col-6">
        <h1 class="h3 mb-4 text-danger">Dashboard</h1>
    </div>
    
    </div>

    <!-- Dashboard Cards -->
    <div class="row" data-aos="fade-down"
        data-aos-duration="1000">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card">
                <div class="card-body dashboard-card success">
                    <h5>Total Users</h5>
                    <h2><?= count($users) ?></h2>
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card">
                <div class="card-body dashboard-card success">
                    <h5>Blog Posts</h5>
                    <h2><?= count($blogs) ?></h2>
                    <div class="card-icon">
                        <i class="fas fa-blog"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="col-xl-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-body dashboard-card success">
                    <h5>Comments</h5>
                    <h2>156</h2>
                    <div class="card-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body dashboard-card danger">
                    <h5>Page Views</h5>
                    <h2>10,241</h2>
                    <div class="card-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

        <!-- Analytics Charts -->
        <!-- <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Blog Traffic Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="javascript:void(0)">Last 7 Days</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Last 30 Days</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Last Year</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="min-height: 300px">
                        <canvas id="trafficChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Traffic Sources</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="javascript:void(0)">Last 7 Days</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Last 30 Days</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Last Year</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-pie" style="min-height: 300px;">
                        <canvas id="sourcesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

        <!-- Recent Activities -->
        <div class="row">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="2000">
                <div class="card shadow mb-4" style="min-height: 400px; overflow-y: scroll; scrollbar-width:none;">
                    <div class="row card-header py-3">
                        <div class="col-lg-6 col-sm-12">
                            <h6 class="m-0 font-weight-bold">Recent User Activities</h6>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <form method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control border-danger" name="userSearch" placeholder="Search Users..." value="<?= htmlspecialchars($_GET['userSearch'] ?? '') ?>">
                                    <button class="btn btn-outline-danger" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>UserName</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($users) && count($users) > 0) {
                                        foreach ($users as $user) { ?>
                                            <tr>
                                                <td>
                                                    <p><?= $user['name'] ?></p>
                                                </td>
                                                <td><?= $user['email'] ?></td>
                                                <td><?= \Carbon\Carbon::parse($user['created_at'])->diffForHumans() ?></td>
                                                <!-- <td><span class="status-pill active">Published</span></td> -->
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="3">No Users Found</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="2000">
                <div class="card shadow mb-4" style="min-height: 400px; overflow-y: scroll; scrollbar-width:none;">
                    <div class="row card-header py-3">
                        <div class="col-lg-6 col-sm-12">
                            <h6 class="m-0 font-weight-bold">Recent Blog Posts</h6>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <form method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control border-danger" name="blogSearch" placeholder="Search Blogs..." value="<?= htmlspecialchars($_GET['blogSearch'] ?? '') ?>">
                                    <button class="btn btn-outline-danger" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>User</th>
                                        <th>Posted At</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($blogs) && count($blogs) > 0) {
                                        foreach ($blogs as $blog) { ?>
                                            <tr>
                                                <td>
                                                    <img height="20px" width="20px" src="assets/uploads/<?= $blog['blog_image'] ?>">
                                                </td>
                                                <td>
                                                    <p><?= $blog['title'] ?></p>
                                                </td>
                                                <td><?php
                                                    $userName = array_filter($users, function ($user) use ($blog) {
                                                        return $user['id'] === $blog['user_id'];
                                                    });
                                                    echo htmlspecialchars(reset($userName)['name'] ?? 'Unknown');
                                                    ?>
                                                </td>
                                                <td><?= \Carbon\Carbon::parse($blog['created_at'])->diffForHumans() ?></td>
                                                <td>
                                                    <span class="status-pill <?= $blog['status'] === 'published' ? 'active' : 'pending' ?>">
                                                        <?= ucfirst($blog['status']) ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="3">No Blogs Found</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>