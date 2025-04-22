<?php require_once __DIR__ . '/../model/blog.php'; ?>
<div class="blogs-section">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Blog Management</h1>
		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBlogModal">
			<i class="fas fa-plus fa-sm text-white-50 me-2"></i>Create New Post
		</button>
	</div>
	<?php Utils::displayFlash('Blog added', 'success'); ?>
	<?php Utils::displayFlash('File size error', 'danger'); ?>
    <?php Utils::displayFlash('File type error', 'danger'); ?>
    <?php Utils::displayFlash('Fill all fields', 'danger'); ?>
    <?php Utils::displayFlash('Upload error', 'danger'); ?>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row align-items-center">
				<div class="col-md-6">
					<h6 class="m-0 font-weight-bold text-primary">All Blog Posts</h6>
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
							foreach ($blogs as $blog) {
								if ($blog['status'] === 'published') { ?>
									<tr>
										<td>
											<img height="40px" width="40px" src="assets/uploads/<?= $blog['blog_image'] ?>" alt="Blog Image">
										</td>
										<td>
											<p><?= htmlspecialchars($blog['title']) ?></p>
										</td>
										<td><?= htmlspecialchars($blog['user_name']) ?></td>
										<td><?= htmlspecialchars(mb_strimwidth($blog['content'], 0, 40, "...")) ?></td>
										<td><?= htmlspecialchars($blog['created_at']) ?></td>
										<td><span class="status-pill active">Published</span></td>
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
							}
						} else { ?>
							<tr>
								<td colspan="7">No Published Blogs Found</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
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
	</div>

	<!-- Blog Categories Card -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Categories</h6>
			<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
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
										<button class="btn btn-sm btn-primary me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-danger">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>Laravel</td>
									<td>8</td>
									<td>
										<button class="btn btn-sm btn-primary me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-danger">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>MySQL</td>
									<td>5</td>
									<td>
										<button class="btn btn-sm btn-primary me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-danger">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>Web Development</td>
									<td>15</td>
									<td>
										<button class="btn btn-sm btn-primary me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-danger">
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
										<button class="btn btn-sm btn-primary me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-danger">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>JavaScript</td>
									<td>10</td>
									<td>
										<button class="btn btn-sm btn-primary me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-danger">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>API Development</td>
									<td>7</td>
									<td>
										<button class="btn btn-sm btn-primary me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-danger">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>Database</td>
									<td>5</td>
									<td>
										<button class="btn btn-sm btn-primary me-1">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-danger">
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
								<button class="btn btn-sm btn-primary me-1">
									<i class="fas fa-edit"></i>
								</button>
								<button class="btn btn-sm btn-danger">
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
								<button class="btn btn-sm btn-primary me-1">
									<i class="fas fa-edit"></i>
								</button>
								<button class="btn btn-sm btn-danger">
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
								<button class="btn btn-sm btn-danger">
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
								<button class="btn btn-sm btn-primary me-1">
									<i class="fas fa-edit"></i>
								</button>
								<button class="btn btn-sm btn-danger">
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
								<button class="btn btn-sm btn-danger">
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
				<h5 class="modal-title" id="addBlogModalLabel">Create New Blog Post</h5>
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
							<select class="form-select" name="user" required>
								<option value="">Select User</option>
								<?php if ($users) {
									foreach ($users as $user) { ?>
										<option value="<?= $user['name'] ?>"><?= $user['name'] ?></option>
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
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" name="addBlog" class="btn btn-primary">Publish</button>
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
				<form>
					<div class="mb-3">
						<label for="editPostTitle" class="form-label">Title</label>
						<input type="text" class="form-control" id="editPostTitle" value="How to optimize your PHP application" required>
					</div>
					<div class="mb-3">
						<label for="editPostContent" class="form-label">Content</label>
						<textarea class="form-control" id="editPostContent" rows="10" required>
# How to optimize your PHP application

PHP applications can slow down for various reasons. In this post, we'll explore the most common performance bottlenecks and how to address them.

## 1. Database Optimization

Most performance issues stem from inefficient database queries. Here are some tips:

- Index your database properly
- Use query caching
- Optimize SQL queries
- Consider using stored procedures

## 2. Code Optimization

- Use opcode caching (OPcache)
- Minimize file includes
- Avoid unnecessary function calls
- Use efficient algorithms

## 3. Server Configuration

- Configure PHP-FPM properly
- Adjust memory limits
- Enable compression
- Use a CDN for static assets

Following these tips will help you build faster, more responsive PHP applications.
                            </textarea>
					</div>
					<div class="row mb-3">
						<div class="col-md-6">
							<label for="editPostCategory" class="form-label">Category</label>
							<select class="form-select" id="editPostCategory" required>
								<option value="">Select Category</option>
								<option value="1" selected>PHP</option>
								<option value="2">Laravel</option>
								<option value="3">MySQL</option>
								<option value="4">Web Development</option>
								<option value="5">Security</option>
								<option value="6">JavaScript</option>
								<option value="7">API Development</option>
								<option value="8">Database</option>
							</select>
						</div>
						<div class="col-md-6">
							<label for="editPostTags" class="form-label">Tags</label>
							<input type="text" class="form-control" id="editPostTags" value="php, performance, optimization, web development">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-md-6">
							<label for="editPostStatus" class="form-label">Status</label>
							<select class="form-select" id="editPostStatus" required>
								<option value="published" selected>Published</option>
								<option value="draft">Draft</option>
								<option value="pending">Pending Review</option>
							</select>
						</div>
						<div class="col-md-6">
							<label for="editPostDate" class="form-label">Publish Date</label>
							<input type="datetime-local" class="form-control" id="editPostDate" value="2023-11-20T10:30">
						</div>
					</div>
					<div class="mb-3">
						<label for="editFeaturedImage" class="form-label">Featured Image</label>
						<div class="mb-2">
							<img src="https://via.placeholder.com/300x150?text=PHP+Optimization" alt="Current featured image" class="img-thumbnail" style="max-width: 300px;">
						</div>
						<input class="form-control" type="file" id="editFeaturedImage">
					</div>
					<div class="mb-3">
						<label for="editPostExcerpt" class="form-label">Excerpt</label>
						<textarea class="form-control" id="editPostExcerpt" rows="3">Learn how to optimize your PHP applications for better performance. This guide covers database optimization, code improvements, and server configurations.</textarea>
					</div>
					<div class="mb-3 form-check">
						<input type="checkbox" class="form-check-input" id="editAllowComments" checked>
						<label class="form-check-label" for="editAllowComments">Allow Comments</label>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-success">Save Draft</button>
				<button type="button" class="btn btn-primary">Update</button>
			</div>
		</div>
	</div>
</div>

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
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary">Add Category</button>
			</div>
		</div>
	</div>
</div>