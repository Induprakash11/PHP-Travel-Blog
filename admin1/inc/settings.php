<div class="settings-section">
	<h1 class="h3 mb-4 text-danger">Settings</h1>

	<div class="row">
		<div class="col-lg-6"  data-aos="fade-up" data-aos-duration="1500">
			<!-- General Settings Card -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-danger">General Settings</h6>
				</div>
				<div class="card-body">
					<form>
						<div class="mb-3">
							<label for="siteName" class="form-label">Site Name</label>
							<input type="text" class="form-control" id="siteName" value="PHP Admin Panel">
						</div>
						<div class="mb-3">
							<label for="siteUrl" class="form-label">Site URL</label>
							<input type="text" class="form-control" id="siteUrl" value="https://example.com">
						</div>
						<div class="mb-3">
							<label for="adminEmail" class="form-label">Admin Email</label>
							<input type="email" class="form-control" id="adminEmail" value="admin@example.com">
						</div>
						<div class="mb-3">
							<label for="timezone" class="form-label">Timezone</label>
							<select class="form-select" id="timezone">
								<option value="UTC" selected>UTC</option>
								<option value="America/New_York">America/New_York</option>
								<option value="America/Chicago">America/Chicago</option>
								<option value="America/Denver">America/Denver</option>
								<option value="America/Los_Angeles">America/Los_Angeles</option>
								<option value="Europe/London">Europe/London</option>
								<option value="Europe/Berlin">Europe/Berlin</option>
								<option value="Asia/Tokyo">Asia/Tokyo</option>
								<option value="Australia/Sydney">Australia/Sydney</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="dateFormat" class="form-label">Date Format</label>
							<select class="form-select" id="dateFormat">
								<option value="Y-m-d" selected>2023-11-20</option>
								<option value="m/d/Y">11/20/2023</option>
								<option value="d/m/Y">20/11/2023</option>
								<option value="F j, Y">November 20, 2023</option>
							</select>
						</div>
						<button type="submit" class="btn btn-prim">Save Changes</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-6" data-aos="fade-down" data-aos-duration="1500">
			<!-- Blog Settings Card -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-danger">Blog Settings</h6>
				</div>
				<div class="card-body">
					<form>
						<div class="mb-3">
							<label for="postsPerPage" class="form-label">Posts Per Page</label>
							<input type="number" class="form-control" id="postsPerPage" value="10">
						</div>
						<div class="mb-3">
							<label for="defaultCategory" class="form-label">Default Category</label>
							<select class="form-select" id="defaultCategory">
								<option value="1">Uncategorized</option>
								<option value="2">PHP</option>
								<option value="3">Web Development</option>
								<option value="4">Laravel</option>
							</select>
						</div>
						<div class="mb-3 form-check">
							<input type="checkbox" class="form-check-input" checked>
							<label class="form-check-label" for="allowComments">Allow Comments</label>
						</div>
						<div class="mb-3 form-check">
							<input type="checkbox" class="form-check-input" id="moderateComments" checked>
							<label class="form-check-label" for="moderateComments">Moderate Comments</label>
						</div>
						<div class="mb-3">
							<label for="commentModeration" class="form-label">Comment Moderation</label>
							<select class="form-select" id="commentModeration">
								<option value="all">Moderate All Comments</option>
								<option value="first" selected>Moderate First Comment</option>
								<option value="none">No Moderation</option>
							</select>
						</div>
						<div class="mb-3 form-check">
							<input type="checkbox" class="form-check-input" id="allowTrackbacks" checked>
							<label class="form-check-label" for="allowTrackbacks">Allow Trackbacks and Pingbacks</label>
						</div>
						<button type="submit" class="btn btn-prim">Save Changes</button>
					</form>
				</div>
			</div>
		</div>
	</div>