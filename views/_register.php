<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card my-5 shadow">
                <div class="card-header">
                    <h2>Register</h2>
                </div>
                <div class="card-body">
                    <?php echo Utils::displayFlash('password match error', 'danger'); ?>
                    <?php echo Utils::displayFlash('register password error', 'danger'); ?>
                    <?php echo Utils::displayFlash('register email error', 'danger'); ?>
                    <?php echo Utils::displayFlash('register error', 'danger'); ?>
                    <?php echo Utils::displayFlash('register field error', 'danger'); ?>
                    <?php echo Utils::displayFlash('register sendotp error', 'danger'); ?>
                    <?php echo Utils::displayFlash('register already error', 'danger'); ?>
                <form method="POST" class="card-body p-2">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input
                            type="text"
                            class="form-control"
                            id="username"
                            name="username"
                            placeholder="Enter your name"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="confirmPassword"
                            name="confirmPassword"
                            placeholder="Enter confirm password"
                            required />
                    </div>
                    <div class="">
                        <button type="submit" name="register" class="btn btn-block">Register</button>
                    </div>
                    <div class="mt-3">
                        <p>Already have an account ?  <a href="login">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>