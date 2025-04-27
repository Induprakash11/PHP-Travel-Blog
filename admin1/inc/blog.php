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
				<div class="col-md-6">
					<h5 class="m-0 font-weight-bold text-danger">All Blog Posts</h5>
				</div>
				<div class="col-md-6">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search posts...">
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
							<th>Blog</th>
							<th>Title</th>
							<th>User</th>
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
											<img height="40px" width="40px" src="assets/uploads/<?= $blog['blog_image'] ?>" alt="Blog Image">
										</td>
										<td>
											<p><?= htmlspecialchars($blog['title']) ?></p>
										</td>
										<td>
											<?php
												$userName = array_filter($users, function($user) use ($blog) {
													return $user['id'] === $blog['user_id'];
												});
												echo htmlspecialchars(reset($userName)['name'] ?? 'Unknown');
											?>
										</td>
										<td><?= htmlspecialchars(mb_strimwidth($blog['content'], 0, 40, "...")) ?></td>
										<td><?= \Carbon\Carbon::parse($blog['created_at'])->diffForHumans() ?></td>
										<td>
											<span class="status-pill <?= $blog['status'] === 'published' ? 'active' : 'pending' ?>">
												<?= ucfirst($blog['status']) ?>
											</span>
										</td>
										<td>
											<button class="btn btn-sm btn-prim me-1" 
												data-bs-toggle="modal" data-bs-target="#editBlogModal"
												data-id="<?= $blog['id'] ?>"
												data-title="<?= htmlspecialchars($blog['title']) ?>"
												data-content="<?= htmlspecialchars($blog['content']) ?>"
												data-userId="<?= htmlspecialchars($blog['user_id']) ?>"
												data-status="<?= $blog['status'] ?>"
												data-image="<?= $blog['blog_image'] ?>">
												<i class="fas fa-edit"></i>
											</button>
											<button class="btn btn-sm btn-red">
												<i class="fas fa-trash"></i>
											</button>
										</td>
									</tr>
								<?php }
							}
						 else { ?>
							<tr>
								<td colspan="7">No Published Blogs Found</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
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
	</div>

	<!-- Blog Categories Card -->
	<div class="card shadow mb-4" data-aos="fade-left" data-aos-duration="1500">
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h5 class="m-0 font-weight-bold text-danger">Categories</h5>
			<button class="btn btn-sm btn-prim" style="border:white solid 2px" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
				<i class="fas fa-plus fa-sm"></i> Add Category
			</button>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-6">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Category Name</th>
									<th>Posts</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>PHP</td>
									<td>12</td>
									<td>
										<button class="btn btn-sm btn-prim me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-red">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>Laravel</td>
									<td>8</td>
									<td>
										<button class="btn btn-sm btn-prim me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-red">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>MySQL</td>
									<td>5</td>
									<td>
										<button class="btn btn-sm btn-prim me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-red">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>Web Development</td>
									<td>15</td>
									<td>
										<button class="btn btn-sm btn-prim me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-red">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Category Name</th>
									<th>Posts</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Security</td>
									<td>6</td>
									<td>
										<button class="btn btn-sm btn-prim me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-red">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>JavaScript</td>
									<td>10</td>
									<td>
										<button class="btn btn-sm btn-prim me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-red">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>API Development</td>
									<td>7</td>
									<td>
										<button class="btn btn-sm btn-prim me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-red">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>Database</td>
									<td>5</td>
									<td>
										<button class="btn btn-sm btn-prim me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-red">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Blog Comments Card -->
	<!-- <div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Recent Comments</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Author</th>
							<th>Comment</th>
							<th>Post</th>
							<th>Date</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>User123</td>
							<td>Great article! Very helpful information.</td>
							<td>How to optimize your PHP application</td>
							<td>2023-11-20</td>
							<td><span class="status-pill active">Approved</span></td>
							<td>
								<button class="btn btn-sm btn-prim me-1">
									<i class="fas fa-edit"></i>
								</button>
								<button class="btn btn-sm btn-red">
									<i class="fas fa-trash"></i>
								</button>
								<button class="btn btn-sm btn-warning">
									<i class="fas fa-ban"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td>TechGuru</td>
							<td>I disagree with point #3. In my experience...</td>
							<td>Top 10 web development trends in 2025</td>
							<td>2023-11-19</td>
							<td><span class="status-pill active">Approved</span></td>
							<td>
								<button class="btn btn-sm btn-prim me-1">
									<i class="fas fa-edit"></i>
								</button>
								<button class="btn btn-sm btn-red">
									<i class="fas fa-trash"></i>
								</button>
								<button class="btn btn-sm btn-warning">
									<i class="fas fa-ban"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td>NewDeveloper</td>
							<td>Thank you for this tutorial! It helped me understand the basics.</td>
							<td>Building secure PHP applications</td>
							<td>2023-11-18</td>
							<td><span class="status-pill pending">Pending</span></td>
							<td>
								<button class="btn btn-sm btn-success me-1">
									<i class="fas fa-check"></i>
								</button>
								<button class="btn btn-sm btn-red">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td>CodeMaster</td>
							<td>Have you considered adding information about X? It would make this even more comprehensive.</td>
							<td>Mastering MySQL performance optimization</td>
							<td>2023-11-17</td>
							<td><span class="status-pill active">Approved</span></td>
							<td>
								<button class="btn btn-sm btn-prim me-1">
									<i class="fas fa-edit"></i>
								</button>
								<button class="btn btn-sm btn-red">
									<i class="fas fa-trash"></i>
								</button>
								<button class="btn btn-sm btn-warning">
									<i class="fas fa-ban"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td>Anonymous</td>
							<td>This is spam content with lots of links...</td>
							<td>Top 10 web development trends in 2025</td>
							<td>2023-11-16</td>
							<td><span class="status-pill inactive">Spam</span></td>
							<td>
								<button class="btn btn-sm btn-red">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div> -->
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

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
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
</div>