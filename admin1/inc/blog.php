<?php require_once __DIR__ . '/../model/blog.php'; ?>
<div class="blogs-section">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-danger">Blog Management</h1>
		<button class="btn btn-prim" data-bs-toggle="modal" data-bs-target="#addBlogModal">
			<i class="fa fa-plus fa-sm me-2"></i> New Post
		</button>
	</div>
	<div class="displayflash" data-aos="zoom-out">
	<?php Utils::displayFlash('Blog added', 'success'); ?>
	<?php Utils::displayFlash('File size error', 'danger'); ?>
    <?php Utils::displayFlash('File type error', 'danger'); ?>
    <?php Utils::displayFlash('Fill all fields', 'danger'); ?>
    <?php Utils::displayFlash('Upload error', 'danger'); ?>
	<?php Utils::displayFlash('Blog updated', 'success'); ?>
	<?php Utils::displayFlash('Blog deleted', 'success'); ?>
	<?php Utils::displayFlash('Blog not found', 'danger'); ?>
	<?php Utils::displayFlash('Upload error', 'danger'); ?>
	</div>

	<div class="card shadow mb-4" data-aos="fade-right" data-aos-duration="1000">
	<div class="card-header py-3">
            <div class="row align-items-center">
            <div class="col-lg-6 col-sm-12 mb-2 mb-lg-0">
                <h6 class="font-weight-bold text-danger">All Blogs</h6>
            </div>
			<div class="col-lg-6 col-sm-12">
				<form method="get">
					<div class="input-group">
						<input type="text" class="form-control border-danger"  name="blogSearch" placeholder="Search blogs..." value="<?= htmlspecialchars($_GET['blogSearch'] ?? '') ?>">
						<button class="btn btn-outline-danger" type="submit">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</form>
			</div>
            </div>
        </div>
		<div class="card-body">
			<div class="table-responsive" style="max-height: 600px; overflow: auto;">
				<table class="table table-hover align-middle table-bordered table-striped text-center">
					<thead class="table-danger">
						<tr>
							<th>Blog</th>
							<th>Title</th>
							<th>User</th>
							<th><i class="fa fa-heart text-danger"></i></th>
							<th>Content</th>
							<th>Posted At</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php if (isset($blogs) && count($blogs) > 0) {
							foreach ($blogs as $blog) { ?>
									<tr>
										<td>
											<img height="40px" width="40px" class="rounded-circle" src="assets/uploads/<?= $blog['blog_image'] ?>" alt="Blog Image">
										</td>
										<td>
											<p class="fw-bold"><?= htmlspecialchars($blog['title']) ?></p>
										</td>
										<td>
											<?php
												$userName = array_filter($users, function($user) use ($blog) {
													return $user['id'] === $blog['user_id'];
												});
												echo htmlspecialchars(reset($userName)['name'] ?? 'Unknown');
											?>
										</td>
										<td>
											<span class="badge bg-danger"><?= htmlspecialchars(Blogs::getLikesCount($blog['id'])) ?></span>
										</td>
										<td><?= htmlspecialchars(mb_strimwidth($blog['content'], 0, 40, "...")) ?></td>
										<td class="badge bg-primary text-dark self-center"><?= \Carbon\Carbon::parse($blog['created_at'])->diffForHumans() ?></td>
										<td>
											<span class="badge <?= $blog['status'] === 'published' ? 'bg-success' : 'bg-warning' ?>">
												<?= ucfirst($blog['status']) ?>
											</span>
										</td>
										<td>
											<button class="btn btn-sm btn-outline-primary me-1" 
												data-bs-toggle="modal" data-bs-target="#editBlogModal"
												data-id="<?= $blog['id'] ?>"
												data-title="<?= htmlspecialchars($blog['title']) ?>"
												data-content="<?= htmlspecialchars($blog['content']) ?>"
												data-userId="<?= htmlspecialchars($blog['user_id']) ?>"
												data-status="<?= $blog['status'] ?>"
												data-image="<?= $blog['blog_image'] ?>">
												<i class="fas fa-edit"></i>
											</button>
											<button class="btn btn-sm btn-outline-danger delete-blog-btn" data-id="<?= $blog['id'] ?>">
												<i class="fas fa-trash"></i>
											</button>
										</td>
									</tr>
								<?php }
							}
						 else { ?>
							<tr>
								<td colspan="8" class="text-center text-muted">No Published Blogs Found</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Add Blog Post Modal -->
<div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-l">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addBlogModalLabel">Create New Blog</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="postTitle" class="form-label">Title</label>
						<input type="text" class="form-control" name="title" required>
					</div>
					<div class="mb-3">
						<label for="postContent" class="form-label">Content</label>
						<textarea class="form-control" name="content" rows="5" required></textarea>
					</div>
					<div class="row mb-3">
							<label for="postUser" class="form-label">User</label>
							<select class="form-select" name="userId" required>
								<option value="">Select User</option>
								<?php if ($users) {
									foreach ($users as $user) { ?>
										<option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
									<?php }
								} ?>
							</select>
					</div>
					<div class="row mb-3">
							<label for="postStatus" class="form-label">Status</label>
							<select class="form-select" name="status" required>
								<option value="">Select Status</option>
								<option value="published">Published</option>
								<option value="draft">Draft</option>
							</select>
					</div>
					<div class="mb-3">
						<label for="featuredImage" class="form-label">Upload Image</label>
						<input class="form-control" type="file" name="file" required>
					</div>
					<button type="button" class="btn btn-red" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" name="addBlog" class="btn btn-prim">Publish</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Edit Blog Post Modal -->
<div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editBlogModalLabel">Edit Blog Post</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			<form method="post" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="editId" class="form-label">Blog ID</label>
						<input type="text" class="form-control" name="editId" id="blogInputId" readonly>
					</div>
					<div class="mb-3">
						<label for="editTitle" class="form-label">Title</label>
						<input type="text" class="form-control" name="editTitle" id="blogInputTitle" required>
					</div>
					<div class="mb-3">
						<label for="editContent" class="form-label">Content</label>
						<textarea class="form-control" name="editContent" id="blogInputContent" rows="5" required></textarea>
					</div>
					<div class="row mb-3">
							<label for="editUser" class="form-label">User</label>
							<select class="form-select" name="editUser" id="blogInputUser" required>
								<option value="">Select User</option>
								<?php if ($users) {
									foreach ($users as $user) { ?>
										<option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
									<?php }
								} ?>
							</select>
					</div>
					<div class="row mb-3">
							<label for="editStatus" class="form-label">Status</label>
							<select class="form-select" name="editStatus" id="blogInputStatus" required>
								<option value="">Select Status</option>
								<option value="published">Published</option>
								<option value="draft">Draft</option>
							</select>
					</div>
					<div class="mb-3">
						<label for="featuredImage" class="form-label">Upload Image</label>
						<input class="form-control" type="file" name="editFile" id="blogInputImage">
					</div>
					<button type="button" class="btn btn-red" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" name="editBlog" class="btn btn-prim">Publish</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
var exampleModal = document.getElementById('editBlogModal');
exampleModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;
  var blogId = button.getAttribute('data-id');
  var blogTitle = button.getAttribute('data-title');
  var blogContent = button.getAttribute('data-content');
  var blogUserId = button.getAttribute('data-userId');
  var blogStatus = button.getAttribute('data-status');
  var blogImage = button.getAttribute('data-image');

  console.log(blogUserId);
  // Update the modal's content.
  document.getElementById('blogInputId').value = blogId;
  document.getElementById('blogInputTitle').value = blogTitle;
  document.getElementById('blogInputContent').value = blogContent;
  document.getElementById('blogInputUser').value = blogUserId;
  document.getElementById('blogInputStatus').value = blogStatus;
  // Removed setting value for blogInputImage for security reasons.
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-blog-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const blogId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this blog?')) {
                const form = document.getElementById('deleteBlogForm');
                form.blogId.value = blogId;
                form.submit();
            }
        });
    });
});
</script>

<form id="deleteBlogForm" method="post" style="display:none;">
    <input type="hidden" name="blogId" value="">
    <input type="hidden" name="deleteBlog" value="1">
</form>

<!-- Add Category Modal -->
<!-- <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form>
					<div class="mb-3">
						<label for="categoryName" class="form-label">Category Name</label>
						<input type="text" class="form-control" id="categoryName" required>
					</div>
					<div class="mb-3">
						<label for="categorySlug" class="form-label">Slug</label>
						<input type="text" class="form-control" id="categorySlug">
						<small class="text-muted">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
					</div>
					<div class="mb-3">
						<label for="categoryParent" class="form-label">Parent Category</label>
						<select class="form-select" id="categoryParent">
							<option value="0" selected>None</option>
							<option value="1">PHP</option>
							<option value="4">Web Development</option>
							<option value="8">Database</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="categoryDescription" class="form-label">Description</label>
						<textarea class="form-control" id="categoryDescription" rows="3"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-red" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-prim">Add Category</button>
			</div>
		</div>
	</div>
</div> -->