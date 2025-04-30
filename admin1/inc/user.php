<?php include_once __DIR__ . '/../model/user.php' ?>
<div class="users-section container">
    <div class="row mb-4 d-flex justify-content-between" data-aos="fade-down">
        <h1 class="col-lg-6 h3 text-danger">User Management</h1>
        <button class="col-lg-6 w-25 btn btn-prim"  data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fa fa-user-plus fa-sm me-2"></i>Add New User
        </button>
    </div>
    <div class="displayflash" data-aos="zoom-out">
        <?php Utils::displayFlash('User added', 'success'); ?>
        <?php Utils::displayFlash('User error', 'danger'); ?>
        <?php Utils::displayFlash('User Updated', 'success'); ?>
        <?php Utils::displayFlash('Fields error', 'danger'); ?>
        <?php Utils::displayFlash('Email error', 'danger'); ?>
        <?php Utils::displayFlash('Password error', 'danger'); ?>
        <?php Utils::displayFlash('Password input error', 'danger'); ?>
        <?php Utils::displayFlash('UserID error', 'danger'); ?>
        <?php Utils::displayFlash('User deleted', 'success'); ?>
        <?php Utils::displayFlash('User error', 'danger'); ?>
    </div>

    <div class="card shadow mb-4" data-aos="fade-right" data-aos-duration="2000">
        <div class="card-header py-3">
            <div class="row align-items-center">
            <div class="col-lg-6 col-sm-12 mb-2 mb-lg-0">
                <h6 class="font-weight-bold text-danger">All Users</h6>
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
        </div>
        <div class="card-body">
            <div class="table-responsive" style="max-height: 300px; overflow-x: scroll; overflow-y:hidden;">
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
                                        <button class="btn btn-sm btn-prim me-1" data-id="<?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-name="<?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-email="<?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-role="<?= htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-bs-toggle="modal" data-bs-target="#editUserModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-red" onclick="deleteUser(<?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>)">
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
        <!-- <nav aria-label="Page navigation">
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
        </nav> -->
    </div>

    <!-- User Roles & Permissions Card -->
    <!-- <div class="card shadow mb-4" data-aos="fade-left" data-aos-duration="1000">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">User Roles & Permissions</h6>
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
                                <button class="btn btn-sm btn-prim me-1" data-bs-toggle="modal" data-bs-target="#editRoleModal">
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
                                <button class="btn btn-sm btn-prim me-1" data-bs-toggle="modal" data-bs-target="#editRoleModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> -->
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
                    <button type="submit" name="addUser" class="btn btn-prim">Add User</button>
                    <button type="button" class="btn btn-red" data-bs-dismiss="modal">Cancel</button>
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
                <form method="post">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="editUserId" class="form-label">User ID</label>
                            <input type="text" class="form-control" name="editId" id="userIdInput" readonly>
                            <small class="text-muted">User Id is permenant can't Edit</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="editUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" name="editName" id="userNameInput" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="editEmail" id="userEmailInput" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="editPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" name="editPassword">
                            <small class="text-muted">Leave blank to keep current password</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role</label>
                        <select class="form-select" name="editRole" id="userRoleInput" required>
                            <option value="">Select Role</option>
                            <option value="admin" selected>Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-red" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="editUser" class="btn btn-prim">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var exampleModal = document.getElementById('editUserModal');
    exampleModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-id');
        var userName = button.getAttribute('data-name');
        var userEmail = button.getAttribute('data-email');
        var userRole = button.getAttribute('data-role');

        // Pass data to modal
        // Set values into input fields
        document.getElementById('userIdInput').value = userId;
        document.getElementById('userNameInput').value = userName;
        document.getElementById('userEmailInput').value = userEmail;
        document.getElementById('userRoleInput').value = userRole;
    });

    // Function to delete user
    function deleteUser(userId) {
        if (confirm("Are you sure you want to delete this user?")) {
            window.location.href = "user_delete?id=" + userId;
        } else {
            // User clicked "Cancel", do nothing
            return false;
        }
    }
</script>

<!-- Edit Role Modal -->
<!-- <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-prim">Save Changes</button>
            </div>
        </div>
    </div>
</div> -->