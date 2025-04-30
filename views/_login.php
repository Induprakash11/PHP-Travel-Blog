<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card my-5 shadow">
                <div class="card-header text-center">
                    <h2>Login</h2>
                </div>
                <div class="card-body p-lg-5">
                    <?php  ?>
                    <form method="POST">
                        <div>
                            <?php echo Utils::displayFlash('field error', 'danger'); ?>
                            <?php echo Utils::displayFlash('Invalid email error', 'danger'); ?>
                            <?php echo Utils::displayFlash('login error', 'danger'); ?>
                            <?php echo Utils::displayFlash('invalid login error', 'danger'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <div class="mt-3">
                            <p>Create an account here <a href="register">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>