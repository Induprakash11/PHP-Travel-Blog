<?php include_once __DIR__ . '/../model/user.php' ?>
<div class="users-section">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Management</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-user-plus fa-sm text-white-50 me-2"></i>Add New User
        </button>
    </div>
    <?php Utils::displayFlash('User added', 'success'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search users...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="max-height: 300px; overflow-y: scroll; scrollbar-width:none;">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created Date</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($users) && count($users) > 0) {
                            foreach ($users as $user) { ?>
                                <tr>
                                    <td>
                                        <p><?= $user['id'] ?></p>
                                    </td>
                                    <td>
                                        <p><?= $user['name'] ?></p>
                                    </td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= \Carbon\Carbon::parse($user['created_at'])->diffForHumans() ?></td>
                                    <td>
                                        <span class="status-pill <?= $user['role'] === 'admin' ? 'active' : 'pending' ?>">
                                            <?= $user['role'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="3">No Users Found</td>
                            </tr>
                        <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- User Roles & Permissions Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Roles & Permissions</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Dashboard</th>
                            <th>User Management</th>
                            <th>Blog Management</th>
                            <th>Settings</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Administrator</td>
                            <td><i class="fas fa-check text-success"></i></td>
                            <td><i class="fas fa-check text-success"></i></td>
                            <td><i class="fas fa-check text-success"></i></td>
                            <td><i class="fas fa-check text-success"></i></td>
                            <td>
                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#editRoleModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>User</td>
                            <td><i class="fas fa-times text-danger"></i></td>
                            <td><i class="fas fa-times text-danger"></i></td>
                            <td><i class="fas fa-times text-danger"></i></td>
                            <td><i class="fas fa-times text-danger"></i></td>
                            <td>
                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#editRoleModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">

                    <div class="col-md-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>


                    <div class="col-md-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="col-md-12">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmPassword" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" name="role" required>
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <!-- <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="sendCredentials">
                        <label class="form-check-label" for="sendCredentials">Send user credentials by email</label>
                    </div> -->
                    <button type="submit" name="addUser" class="btn btn-primary">Add User</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editUsername" value="john_doe" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" value="john@example.com" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editFirstName" value="John">
                        </div>
                        <div class="col-md-6">
                            <label for="editLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="editLastName" value="Doe">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="editPassword">
                            <small class="text-muted">Leave blank to keep current password</small>
                        </div>
                        <div class="col-md-6">
                            <label for="editConfirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="editConfirmPassword">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role</label>
                        <select class="form-select" id="editRole" required>
                            <option value="administrator" selected>Administrator</option>
                            <option value="editor">Editor</option>
                            <option value="author">Author</option>
                            <option value="contributor">Contributor</option>
                            <option value="subscriber">Subscriber</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="userStatus" checked>
                            <label class="form-check-label" for="userStatus">Active</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoleModalLabel">Edit Role: Administrator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="roleName" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="roleName" value="Administrator" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="card mb-2">
                            <div class="card-header">Dashboard</div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="viewDashboard" checked>
                                    <label class="form-check-label" for="viewDashboard">View Dashboard</label>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">User Management</div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="viewUsers" checked>
                                    <label class="form-check-label" for="viewUsers">View Users</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="addUsers" checked>
                                    <label class="form-check-label" for="addUsers">Add Users</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="editUsers" checked>
                                    <label class="form-check-label" for="editUsers">Edit Users</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="deleteUsers" checked>
                                    <label class="form-check-label" for="deleteUsers">Delete Users</label>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">Blog Management</div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="viewPosts" checked>
                                    <label class="form-check-label" for="viewPosts">View Posts</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="addPosts" checked>
                                    <label class="form-check-label" for="addPosts">Add Posts</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="editPosts" checked>
                                    <label class="form-check-label" for="editPosts">Edit Posts</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="deletePosts" checked>
                                    <label class="form-check-label" for="deletePosts">Delete Posts</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="manageCategories" checked>
                                    <label class="form-check-label" for="manageCategories">Manage Categories</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="manageComments" checked>
                                    <label class="form-check-label" for="manageComments">Manage Comments</label>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">Settings</div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="manageSettings" checked>
                                    <label class="form-check-label" for="manageSettings">Manage Settings</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>