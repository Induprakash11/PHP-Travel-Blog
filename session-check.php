<!-- < ?php require_once __DIR__ . '/controllers/load.php';

// Check if the user is logged in
if (Session::has('user_id')) {
    echo "logged_in";
} 
?> -->

<!-- <script>
        // This function is used to check if the user is logged in or not to Redirect to home.php
function checkLoginStatus() {
    fetch("session-check.php")
        .then(response => response.text())
        .then(data => {
            if (data === "logged_in") {
                window.location.href = "home"; // Redirect to home.php
            }
        });
    }
    
    checkLoginStatus([],1); // Run on page ViewTemp::view    
</script> -->

<tr>
								<td>
									<img src="../admin/assets/images/people.png">
									<p><?= $users[1]['name'] ?></p>
								</td>
								<td><?= date('Y-m-d', strtotime($users[1]['created_at'])) ?></td>
								<td><span class="status process"><?= $users[1]['role'] ?></span></td>
							</tr>
							<tr>
								<td>
									<img src="../admin/assets/images/people.png">
									<p><?= $users[0]['name'] ?></p>
								</td>
								<td><?= date('Y-m-d', strtotime($users[0]['created_at'])) ?></td>
								<td><span class="status completed"><?= $users[0]['role'] ?></span></td>
							</tr>
							<tr>
								<td>
									<img src="../admin/assets/images/people.png">
									<p><?= $users[1]['name'] ?></p>
								</td>
								<td><?= date('Y-m-d', strtotime($users[1]['created_at'])) ?></td>
								<td><span class="status process"><?= $users[1]['role'] ?></span></td>
							</tr>
							<tr>
								<td>
									<img src="../admin/assets/images/people.png">
									<p><?= $users[0]['name'] ?></p>
								</td>
								<td><?= date('Y-m-d', strtotime($users[0]['created_at'])) ?></td>
								<td><span class="status completed"><?= $users[0]['role'] ?></span></td>
							</tr>


							// Form validation for adding user
            $('#addUserModal form').on('submit', function(e) {
                e.preventDefault();
            
                // Validation logic
                const username = $('#username').val().trim();
                const email = $('#email').val().trim();
                const password = $('#password').val().trim();
            
                if (!username) {
                    alert('Username is required.');
                    return;
                }
            
                if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    alert('A valid email is required.');
                    return;
                }
            
                if (!password || password.length < 6) {
                    alert('Password must be at least 6 characters long.');
                    return;
                }
            
                // Show success message
                alert('User added successfully!');
            
                // Close modal
                $('#addUserModal').modal('hide');
            });

            // Form validation for editing user
            $('#editUserModal form').on('submit', function(e) {
                e.preventDefault();

                // Validation logic would go here

                // Show success message
                alert('User updated successfully!');

                // Close modal
                $('#editUserModal').modal('hide');
            });

            // Form validation for adding blog post
            $('#addBlogModal form').on('submit', function(e) {
                e.preventDefault();

                // Validation logic would go here

                // Show success message
                alert('Blog post created successfully!');

                // Close modal
                $('#addBlogModal').modal('hide');
            });

            // Form validation for editing blog post
            $('#editBlogModal form').on('submit', function(e) {
                e.preventDefault();

                // Validation logic would go here

                // Show success message
                alert('Blog post updated successfully!');

                // Close modal
                $('#editBlogModal').modal('hide');
            });

            // Form validation for adding category
            $('#addCategoryModal form').on('submit', function(e) {
                e.preventDefault();

                // Validation logic would go here

                // Show success message
                alert('Category added successfully!');

                // Close modal
                $('#addCategoryModal').modal('hide');
            });

            // Auto-generate slug from category name
            $('#categoryName').on('input', function() {
                const name = $(this).val();
                const slug = name.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                $('#categorySlug').val(slug);
            });

            // Toggle maintenance mode switch label
            $('#maintenanceMode').on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).next().text('Disable Maintenance Mode');
                } else {
                    $(this).next().text('Enable Maintenance Mode');
                }
            });

            // Test email settings button
            $('.btn-info').on('click', function() {
                alert('This is a prototype. Connection to mail server will be added in the final version.');
            });